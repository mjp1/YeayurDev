<?php

namespace Yeayurdev\Listeners;

use Yeayurdev\Events\UserNotificationLike;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ShowNotificationLike
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
     * @param  UserNotificationLike  $event
     * @return void
     */
    public function handle(UserNotificationLike $event)
    {
        $event->message;
    }
}
