<?php

namespace App\Notifications\Frontend\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use DB;

/**
 * Class UserNeedsPasswordReset.
 */
class UserNeedsPasswordReset extends Notification
{
    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * UserNeedsPasswordReset constructor.
     *
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param mixed $notifiable
     *
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $locale = DB::table('pro_configuration')->select('configuration_name', 'configuration_val')
            ->where('configuration_name', 'language_pro')->first();
        app()->setLocale($locale->configuration_val);
        $url = ('http://' . request()->getHttpHost() . '/pro#/reset/' . $this->token);
        return (new MailMessage())
            ->subject(app_name() . ': ' . __('strings.emails.auth.password_reset_subject'))
            ->line(__('strings.emails.auth.password_cause_of_email'))
            ->action(__('buttons.emails.auth.reset_password'), $url)
            ->line(__('strings.emails.auth.password_if_not_requested'));
    }
}
