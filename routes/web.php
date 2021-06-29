<?php

use App\Http\Controllers\InvoicesController;
use App\Models\Invoices;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\ConfirmablePasswordController;
use Laravel\Fortify\Http\Controllers\ConfirmedPasswordStatusController;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\PasswordController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\ProfileInformationController;
use Laravel\Fortify\Http\Controllers\RecoveryCodeController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController;
use Laravel\Fortify\Http\Controllers\TwoFactorQrCodeController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
}
);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('pages/dashboard');
})->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('/order', function () {
    $products = \App\Models\Products::where('type', 'webhosting')->get();
    return view('pages/order', ["products" => $products]);
})->name('order');


Route::middleware(['auth:sanctum', 'verified'])->post(('/order/{products}'), 'App\Http\Controllers\Order@index');


Route::middleware(['auth:sanctum', 'verified'])->get('/services', function () {
    $user = Auth::user();


    $services = \App\Models\Services::where('customer_id', $user->id)->get();
    $servicescount = \App\Models\Services::where([['customer_id', '=', $user->id], ['status', '=', 'active']])->count();


    return view('pages/services', ["services" => $services, "servicescount" => $servicescount]);
})->name('services');



Route::middleware(['auth:sanctum', 'verified'])->get('/admin/services', function () {
    $user = Auth::user();

    if($user->group != "admin"){
        abort('404');
    }


    $services = \App\Models\Services::all();
    $servicescount = \App\Models\Services::where([['status', '=', 'active']])->count();


    return view('admin/services', ["services" => $services, "servicescount" => $servicescount]);
})->name('admin.services');


Route::middleware(['auth:sanctum', 'verified'])->get(('/admin/services/{services}'), function (App\Models\Services $services) {
    $user = Auth::user();

    if($user->group != "admin"){
        abort('404');
    }

    return view('admin.service-solo', ["service" => $services]);



});


Route::middleware(['auth:sanctum', 'verified'])->post(('/admin/suspend/{service}'), function (App\Models\Services $service) {
    $user = Auth::user();
    if($user->group != "admin"){
        abort(404);
    }






    if ($service->status == "unpaid") {
        $service->status = "active";
        $service->save();
        (new App\Http\Controllers\PleskAPI)->unsuspendDomain($service->hostname);
    }

    Session::put('success', 'Le paiement a bien été effectué');
    return Redirect::to('/services/' . $service->id);


});



Route::middleware(['auth:sanctum', 'verified'])->get(('/services/{services}'), function (App\Models\Services $services) {
    $user = Auth::user();
    if ($user->id != $services->customer_id ) {
        abort(404);

    }

    return view('pages.service-solo', ["service" => $services]);


})->name('invoice');

Route::middleware(['auth:sanctum', 'verified'])->get('/add-balance', function () {
    return view('pages/add-balance');
})->name('add-balance');


Route::middleware(['auth:sanctum', 'verified'])->get('/discount-code', function () {
    return view('pages/discount-code');
})->name('discount-code');
Route::post('discount', 'App\Http\Controllers\DiscountCodeController@apply');


Route::middleware(['auth:sanctum', 'verified'])->get('/invoices', function () {
    $user = Auth::user();


    $invoices = Invoices::where('customer_id', $user->id)->orderBy('id', 'desc')->get();

    return view('pages/invoices', ["invoices" => $invoices]);
})->name('invoices');


Route::middleware(['auth:sanctum', 'verified'])->get(('/invoice/{invoices}'), function (App\Models\Invoices $invoices) {
    $user = Auth::user();
    if ($user->id != $invoices->customer_id) {
        abort(404);

    }

    return view('pages.invoice-solo', ["invoice" => $invoices]);


})->name('invoice');


Route::post('profile', 'App\Http\Controllers\ChangePasswordController@store')->name('change.password');


Route::middleware(['auth:sanctum', 'verified'])->post(('/renew/{service}'), function (App\Models\Services $service) {
    $user = Auth::user();
    if ($user->id != $service->customer_id) {
        abort(404);

    }
    if ($service->status == "suspend") {
        Session::put('error', "Action interdite.");
        return Redirect::to('/services/' . $service->id);
    }

    if ($service->product->price == 0) {
        Session::put('error', "Action interdite.");
        return Redirect::to('/services/' . $service->id);
    }

    if ($user->balance < $service->product->price) {
        Session::put('error', "Il vous manque " . ($service->product->price - $user->balance) . '€');
        return Redirect::to('/services/' . $service->id);
    }


    $user->balance -= $service->product->price;

    $user->save();

    $date = Carbon::parse($service->end_date);

    $service->end_date = $date->addMonth();
    $service->save();

    $invoices = InvoicesController::make($user, $service->product->price, "paid", "Renouvellement de " . $service->hostname . " (" . $service->id . "-" . $service->id . ")");


    if ($service->status == "unpaid") {
        $service->status = "active";
        $service->save();
        (new App\Http\Controllers\PleskAPI)->unsuspendDomain($service->hostname);
    }

    Session::put('success', 'Le paiement a bien été effectué');
    return Redirect::to('/services/' . $service->id);


});

Route::middleware(['auth:sanctum', 'verified'])->get('/profile', function () {
    return view('pages/profile');
})->name('profile');

Route::middleware(['auth:sanctum', 'verified'])->get('/account', function () {
    return view('pages/account');
})->name('account');

Route::get('status', 'App\Http\Controllers\PaymentController@getPaymentStatus');

Route::post('paypal', 'App\Http\Controllers\PaymentController@payWithpaypal');


Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');


Route::group(['middleware' => config('fortify.middleware', ['web'])], function () {
    // Authentication...
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->middleware(['guest'])
        ->name('login');

    $limiter = config('fortify.limiters.login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware(array_filter([
            'guest',
            $limiter ? 'throttle:' . $limiter : null,
        ]));

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    // Password Reset...
    if (Features::enabled(Features::resetPasswords())) {
        Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
            ->middleware(['guest'])
            ->name('password.request');

        Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
            ->middleware(['guest'])
            ->name('password.email');

        Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
            ->middleware(['guest'])
            ->name('password.reset');

        Route::post('/reset-password', [NewPasswordController::class, 'store'])
            ->middleware(['guest'])
            ->name('password.update');
    }

    // Registration...
    if (Features::enabled(Features::registration())) {
        Route::get('/register', [RegisteredUserController:: class, 'create'])
            ->middleware(['guest'])
            ->name('register');

        Route::post('/register', [RegisteredUserController::class, 'store'])
            ->middleware(['guest']);
    }

    // Email Verification...
    if (Features::enabled(Features::emailVerification())) {
        Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])
            ->middleware(['auth'])
            ->name('verification.notice');

        Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
            ->middleware(['auth', 'signed', 'throttle:6,1'])
            ->name('verification.verify');

        Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware(['auth', 'throttle:6,1'])
            ->name('verification.send');
    }

    // Profile Information...
    if (Features::enabled(Features::updateProfileInformation())) {
        Route::put('/user/profile-information', [ProfileInformationController::class, 'update'])
            ->middleware(['auth'])
            ->name('user-profile-information.update');
    }


    // Passwords...
    if (Features::enabled(Features::updatePasswords())) {
        Route::put('/user/password', [PasswordController::class, 'update'])
            ->middleware(['auth'])
            ->name('user-password.update');
    }

    // Password Confirmation...
    Route::get('/user/confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->middleware(['auth'])
        ->name('password.confirm');

    Route::post('/user/confirm-password', [ConfirmablePasswordController::class, 'store'])
        ->middleware(['auth']);

    Route::get('/user/confirmed-password-status', [ConfirmedPasswordStatusController::class, 'show'])
        ->middleware(['auth'])
        ->name('password.confirmation');

    // Two Factor Authentication...
    if (Features::enabled(Features::twoFactorAuthentication())) {
        Route::get('/two-factor-challenge', [TwoFactorAuthenticatedSessionController::class, 'create'])
            ->middleware(['guest'])
            ->name('two-factor.login');

        Route::post('/two-factor-challenge', [TwoFactorAuthenticatedSessionController::class, 'store'])
            ->middleware(['guest']);

        $twoFactorMiddleware = Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword')
            ? ['auth', 'password.confirm']
            : ['auth'];

        Route::post('/user/two-factor-authentication', [TwoFactorAuthenticationController::class, 'store'])
            ->middleware($twoFactorMiddleware);

        Route::delete('/user/two-factor-authentication', [TwoFactorAuthenticationController::class, 'destroy'])
            ->middleware($twoFactorMiddleware);

        Route::get('/user/two-factor-qr-code', [TwoFactorQrCodeController::class, 'show'])
            ->middleware($twoFactorMiddleware);

        Route::get('/user/two-factor-recovery-codes', [RecoveryCodeController::class, 'index'])
            ->middleware($twoFactorMiddleware);

        Route::post('/user/two-factor-recovery-codes', [RecoveryCodeController::class, 'store'])
            ->middleware($twoFactorMiddleware);
    }
});

