<?php

namespace Yeayurdev\Listeners;

use Yeayurdev\Events\FanNotificationPost;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ShowFanNotificationPost
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
     * @param  FanNotificationPost  $event
     * @return void
     */
    public function handle(FanNotificationPost $event)
    {
        $event->message;
    }
}
