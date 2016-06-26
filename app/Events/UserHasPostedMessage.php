<?php

namespace Yeayurdev\Events;

use Yeayurdev\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserHasPostedMessage extends Event implements ShouldBroadcast
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
        return ['newMessage.'.$this->profileId];
    }
}
