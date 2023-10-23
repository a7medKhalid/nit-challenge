<?php
namespace App\Enums;
enum MailProviders: string
{
    case mailgun = 'Mailgun';
    case sendgrid = 'Sendgrid';
    case postmark = 'Postmark';
}
