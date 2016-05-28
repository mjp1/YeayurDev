<?php

namespace Yeayurdev\Listeners;

use Yeayurdev\Events\UserNotificationStream;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ShowNotificationStream
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
     * @param  UserNotificationStream  $event
     * @return void
     */
    public function handle(UserNotificationStream $event)
    {
        $event->message;
    }
}
