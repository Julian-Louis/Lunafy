<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ServiceSuspend extends Notification
{
    use Queueable;

    private $service;
    private $product;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($service,$product)
    {
        //
        $this->service =$service;
        $this->product =$product;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("Service suspendu")
                    ->line('Votre service '.$this->product->name." (".$this->service->hostname.") vient d'être suspendu pour cause de non paiement, pour régler ce problème, merci de vous rendre sur la page du service, et de renouveller le service.")
                    ->action('Renouveller', url('https://my.lunafy.fr/services/'.$this->service->id))
                    ->line("Vos données existent encore, mais si d'ici une semaine, il sera supprimé!");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
