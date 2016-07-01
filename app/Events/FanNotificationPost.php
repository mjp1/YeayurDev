<?php

namespace Yeayurdev\Events;

use Yeayurdev\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class FanNotificationPost extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $message;

    public $fanPageId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $fanPageId)
    {
        $this->message = $message;

        $this->fanPageId = $fanPageId;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['fanPage.'.$this->fanPageId];
    }
}
