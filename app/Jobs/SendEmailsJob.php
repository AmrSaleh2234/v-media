<?php

namespace App\Jobs;

use App\Mail\NewsEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

//    public $tries = 4;
    public $retryAfter = 30;

    public $data, $recipients;

    /**
     * Create a new job instance.
     */
    public function __construct($data, $recipients)
    {
        $this->data = $data;
        $this->recipients = $recipients;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $mail = new NewsEmail($this->data);
        foreach ($this->recipients as $recipient) {
            Mail::to($recipient)->send($mail);
        }
    }

    public function retryUntil()
    {
        return now()->addMinutes(5);
    }

}
