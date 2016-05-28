<?php

namespace Yeayurdev\Events;

use Yeayurdev\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserNotificationFollow extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $message;

    public $followId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $followId)
    {
        $this->message = $message;

        $this->followId = $followId;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['notification.'.$this->followId];
    }
}
