<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword;

class CustomResetPassword extends ResetPassword
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
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
     * 通知：パスワードリセット
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('パスワード再設定 | '.config('app.name'))
                    ->line('パスワード再設定のご連絡です。以下のボタンからお手続きを進めてください。')
                    ->action('パスワード再設定', url(route('password.reset', $this->token, false)))
                    ->line('※有効期限は'.config('auth.passwords.users.expire').'分です。')
                    ->line('※有効期限が切れた場合はもう一度はじめからからお手続きを行ってください。');
    }

}
