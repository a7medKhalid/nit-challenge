<?php

namespace App\Services\Mailers;

use App\Contracts\MailerInterface;
use App\Jobs\SendRawEmailJob;

class SendgridMailer implements MailerInterface
{
    public function raw(string $text, string $email, string $subject): void
    {
        SendRawEmailJob::dispatch($text, $email, $subject);
    }
}
