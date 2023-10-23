<?php

namespace App\Providers;

use App\Contracts\MailerInterface;
use App\Enums\MailProviders;
use App\Services\Mailers\MailGunMailer;
use App\Services\Mailers\PostmarkMailer;
use App\Services\Mailers\SendgridMailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(MailerInterface::class, function ($app) {
            $user = Auth::user();

            // If there's no authenticated user or the mail_provider column is not set, default to CustomMailer
            if (!$user || !$user->mail_provider) {
                return new MailGunMailer();
            }

            // Choose the mailer service based on the user's mail_provider value
            switch ($user->mail_provider) {
                case MailProviders::sendgrid;
                    return new SendgridMailer();
                case MailProviders::postmark;
                    return new PostmarkMailer();
                default:
                    return new MailGunMailer();
            }
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }
}
