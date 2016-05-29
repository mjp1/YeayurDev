<?php

namespace Yeayurdev\Listeners;

use Yeayurdev\Events\UserNotificationFollow;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ShowNotificationFollow
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
     * @param  UserNotificationFollow  $event
     * @return void
     */
    public function handle(UserNotificationFollow $event)
    {
        $event->message;
    }
}
