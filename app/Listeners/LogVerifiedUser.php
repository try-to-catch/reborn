<?php

namespace App\Listeners;

use App\Notifications\ThanksUserForVerificationNotification;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogVerifiedUser implements ShouldQueue
{

    /**
     * Handle the event.
     */
    public function handle(Verified $event): void
    {
        $event->user->notify(new ThanksUserForVerificationNotification($event->user));
    }
}
