<?php

namespace Yeayurdev\Events;

use Auth;
use Yeayurdev\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserNotificationPost extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $message;

    public $profileId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $profileId)
    {
        $this->message = $message;

        $this->profileId = $profileId;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['notification.'.$this->profileId];
    }
}
