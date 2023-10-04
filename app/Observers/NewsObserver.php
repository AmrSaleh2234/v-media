<?php

namespace App\Observers;

use App\Jobs\SendEmailsJob;
use App\Mail\NewsEmail;
use App\Models\CMS\News;
use App\Models\CMS\Subscriber;
use Illuminate\Support\Facades\Mail;

class NewsObserver
{
    /**
     * Handle the News "created" event.
     */
    public function created(News $news): void
    {
        $recipients = Subscriber::active()->where('channel','the-news')->pluck('email')->toArray();
        foreach ($recipients as $recipient) {
            Mail::to($recipient)->send(new NewsEmail($news));
        }
//        dispatch(new SendEmailsJob($news,$recipients));
    }

    /**
     * Handle the News "updated" event.
     */
    public function updated(News $news): void
    {
//        $recipients = Subscriber::active()->where('channel','the-news')->pluck('email')->toArray();
//        foreach ($recipients as $recipient) {
//            Mail::to($recipient)->send(new NewsEmail($news));
//        }
//        dispatch(new SendEmailsJob($news,$recipients));
    }

    /**
     * Handle the News "deleted" event.
     */
    public function deleted(News $news): void
    {
        //
    }

    /**
     * Handle the News "restored" event.
     */
    public function restored(News $news): void
    {
        //
    }

    /**
     * Handle the News "force deleted" event.
     */
    public function forceDeleted(News $news): void
    {
        //
    }
}
