<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $verificationUrl = url('/verify-email/'.$notifiable->id.'/'.$notifiable->verification_token);        
        return (new MailMessage)
                    ->subject('Vérification de votre adresse e-mail')
                    ->greeting('Bonjour '.$notifiable->name.',')
                    ->line('Merci de vous être inscrit sur notre site de cuisine!')
                    ->line('Veuillez cliquer sur le bouton ci-dessous pour vérifier votre adresse e-mail.')
                    ->action('Vérifier mon adresse e-mail', $verificationUrl)
                    ->line('Si vous n\'avez pas créé de compte, aucune action n\'est requise.');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}