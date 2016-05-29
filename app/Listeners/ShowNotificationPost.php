<?php

namespace Yeayurdev\Listeners;

use Yeayurdev\Events\UserNotificationPost;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ShowNotificationPost
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserNotificationPost  $event
     * @return void
     */
    public function handle(UserNotificationPost $event)
    {
        $event->message;
    }
}
