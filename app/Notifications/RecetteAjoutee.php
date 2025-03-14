<?php

namespace App\Notifications;

use App\Models\Recette;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RecetteAjoutee extends Notification
{
    use Queueable;


    protected $recette;
    /**
     * Create a new notification instance.
     */
    public function __construct(Recette $recette)
    {
        $this->recette = $recette;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
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

        $url = url('/recettes/'.$this->recette->slug);
        
        return (new MailMessage)
        ->subject('Votre recette a été ajoutée avec succès')
        ->greeting('Bonjour '.$notifiable->name.',')
        ->line('Votre recette "'.$this->recette->titre.'" a été ajoutée avec succès!')
        ->line('Temps de préparation: '.$this->recette->temps_preparation.' minutes')
        ->line('Difficulté: '.$this->recette->difficulte)
        ->action('Voir ma recette', $url)
        ->line('Merci d\'utiliser notre plateforme!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
