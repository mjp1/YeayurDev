<?php

namespace Yeayurdev\Listeners;

use Yeayurdev\Events\UserHasPostedMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class showUserMessage
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
     * @param  UserHasPostedMessage  $event
     * @return void
     */
    public function handle(UserHasPostedMessage $event)
    {
       
        $event->message;
    }
}
