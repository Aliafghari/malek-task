<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\DB;

class ResetPasswordNotification extends ResetPassword
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;
    public $random_num;

    /**
     * Create a new notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
        $this->random_num = rand(100000, 999999);
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $resetUrl = url(config('app.url') . route('password.reset', ['token' => $this->token], false));



        //session(['reset_password_random_num' => $this->random_num]);
        DB::table('users')->update([
            'random_num' => $this->random_num,
        ]);


        return (new MailMessage)
            ->line('your code :' . $this->random_num)
            ->action('Reset Password', $resetUrl)
            ->line('The code will expire after 60 seconds.')
            ->line('If you did not request a password reset, no further action is required.');
    }
}
