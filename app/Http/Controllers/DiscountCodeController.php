<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\DiscountUses;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

class DiscountCodeController extends Controller
{
    //


    public function __construct()
    {
        $this->middleware('auth');

    }


    public function apply(Request $request)
    {
        $user = Auth::user();

        $code = $request->get('code');


        if ($code == null || strlen($code) == 0 || strlen($code) > 16) {
            Session::put('error', 'Le code promo est incorrect');
            return Redirect::to('/discount-code');
        }


        $codeResult = Discount::whereRaw("BINARY code  = '$code' ")->first();

        if ($codeResult == null) {
            Session::put('error', 'Le code promo est incorrect.');
            return Redirect::to('/discount-code');
        }

        if ($codeResult->count() == 0) {
            Session::put('error', 'Le code promo est incorrect.');
            return Redirect::to('/discount-code');
        }

        if ($codeResult->uses >= $codeResult->max_uses) {
            Session::put('error', 'Ah mince, tu es arrivé trop tard, le code à été utilisé trop de fois, peut être une prochaine fois ?');
            return Redirect::to('/discount-code');
        }

        $use = DiscountUses::whereRaw("BINARY code  = '$code' AND user_id = '$user->id' ")->first();

        if ($use == !null && $use->count() == 1) {
            Session::put('error', 'Vous avez déjà utilisé ce code promo.');
            return Redirect::to('/discount-code');
        }

        $result = $codeResult->credits_earn;
        $codeResult->uses = $codeResult->uses + 1;
        $codeResult->save();

        $user->balance = +$user->balance + $result;
        $user->save();

        DiscountUses::create([

            'code' => $code,
            'user_id' => $user->id

        ]);


        Session::put('success', 'Bravo, vous avez reçu ' . $result . '€ !');

        return Redirect::to('/discount-code');


    }
}
