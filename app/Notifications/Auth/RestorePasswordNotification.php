<?php

namespace App\Notifications\Auth;

use App\Helpers\Enum\Message;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RestorePasswordNotification extends Notification
{
    use Queueable;

    public function __construct(
        public User $user,
        public string $newPassword
    )
    {}

    public function via(mixed $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(mixed $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(Message::RESTORE_PASSWORD)
            ->markdown('mail.auth.restore-password', [
                'name' => $this->user->complete_name,
                'newPassword' => $this->newPassword
            ]);
    }
}
