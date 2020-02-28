<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
class typingchat implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $touserid,$myid,$fromuserphoto;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($touserid ,$myid,$fromuserphoto)
    {
        //
        $this->touserid=$touserid;
        $this->myid=$myid;
        $this->fromuserphoto=$fromuserphoto;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('typing.'.$this->touserid);
    }
}
