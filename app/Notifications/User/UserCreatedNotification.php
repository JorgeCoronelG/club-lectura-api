<?php

namespace App\Notifications\User;

use App\Helpers\Enum\Message;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCreatedNotification extends Notification
{
    use Queueable;

    public function __construct(
        public User $user
    ) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $url = env('APP_URL').'/auth/verificar/'.$this->user->verification_token;
        return (new MailMessage())
            ->subject(Message::CONFIRM_EMAIL)
            ->markdown('mail.user.created', [
                'name' => $this->user->complete_name,
                'url' => $url
            ]);
    }
}
