<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CheckmateOccurred implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Color of the player that was checkmated.
     * 
     * @var string $userCheckmatedColor
     */
    public string $userCheckmatedColor;

    /**
     * Create a new event instance.
     *
     * @param string $userCheckmatedColor Color of the side that has been checkmated.
     */
    public function __construct(string $userCheckmatedColor)
    {
        $this->userCheckmatedColor = $userCheckmatedColor;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * Here we’re using a public channel called "chess".
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('chess');
    }

    /**
     * Optionally define a custom event name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'game.checkmate';
    }

    /**
     * Customize the broadcast data.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'userCheckmatedColor' => $this->userCheckmatedColor,
            'timestamp' => now()->toDateTimeString(),
        ];
    }
}
