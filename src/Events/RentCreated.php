<?php

namespace Library\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Library\Models\RentModel;

class RentCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public RentModel $rent;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(RentModel $rent)
    {
        $this->rent = $rent;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
