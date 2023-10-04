<?php

namespace App\Jobs;

use App\Mail\VerificationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

//    public $tries = 4;
    public $retryAfter = 30;

    protected $data ;
    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
       $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $email = new VerificationMail($this->data);
        Mail::to($this->data['email'])->send($email);
    }

    public function retryUntil()
    {
        return now()->addMinutes(5);
    }
}
