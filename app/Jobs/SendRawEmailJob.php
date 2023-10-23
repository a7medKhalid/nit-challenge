<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendRawEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $text;
    protected $email;
    protected $subject;

    public function __construct(string $text, string $email, string $subject)
    {
        $this->text = $text;
        $this->email = $email;
        $this->subject = $subject;
    }

    public function handle()
    {
        Mail::raw($this->text, function ($message) {
            $message->to($this->email)->subject($this->subject);
        });
    }
}
