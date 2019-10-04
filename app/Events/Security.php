<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Security
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $visitor; //lo guarda como propiedad publica

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($visitor) //recibe lo q se semuestra en index
    {
        $this->visitor->$visitor;     //guarda la información que se transmitirá junto al evento
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
