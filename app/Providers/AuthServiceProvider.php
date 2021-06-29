<?php

namespace App\Providers;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        VerifyEmail::toMailUsing(function (User $user, string $verificationUrl) {
            return (new MailMessage)
                ->subject("Vérification de l'addresse email")
                ->line("Veuillez cliquer sur le bouton ci-dessous pour vérifier votre adresse e-mail.")
                ->action("Vérifier mon addresse email", $verificationUrl)
                ->line("Si vous n'avez pas créé de compte, aucune autre action n'est requise.");
        });

        //
    }



}
