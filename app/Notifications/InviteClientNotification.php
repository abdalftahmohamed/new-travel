<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InviteClientNotification extends Notification
{
    use Queueable;

    private $invitation;

    public function __construct($invitation)
    {
        $this->invitation = $invitation;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)->view(
            'emails.myTestMail', ['invitation' => $this->invitation]
        );
    }



    public function toDatabase($notifiable)
    {
        return [
//            'invitation_id' => $this->invitation_id,
//            'user_create' => $this->user_create,
//            'title' => $this->title,
        ];
    }
}
