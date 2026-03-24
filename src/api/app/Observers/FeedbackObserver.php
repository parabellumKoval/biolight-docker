<?php

namespace App\Observers;

use App\Models\Feedback;

use App\Mail\FeedbackCreated;
use Illuminate\Support\Facades\Mail;

class FeedbackObserver
{
    /**
     * Handle the Feedback "created" event.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return void
     */
    public function created(Feedback $feedback)
    {
        // Queue email sending so the API request isn't blocked by SMTP latency.
        Mail::to(config('mail.feedback_notification_email'))->queue(new FeedbackCreated($feedback));
//  	    Mail::to('parabellum.koval@gmail.com')->send(new FeedbackCreated($feedback));
    }

    /**
     * Handle the Feedback "updated" event.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return void
     */
    public function updated(Feedback $feedback)
    {
        //
    }

    /**
     * Handle the Feedback "deleted" event.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return void
     */
    public function deleted(Feedback $feedback)
    {
        //
    }

    /**
     * Handle the Feedback "restored" event.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return void
     */
    public function restored(Feedback $feedback)
    {
        //
    }

    /**
     * Handle the Feedback "force deleted" event.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return void
     */
    public function forceDeleted(Feedback $feedback)
    {
        //
    }
}
