<?php

namespace Yeayurdev\Events;

use Yeayurdev\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserNotificationLike extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $message;

    public $likedId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $likedId)
    {
        $this->message = $message;

        $this->likedId = $likedId;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['notification.'.$this->likedId];
    }
}
