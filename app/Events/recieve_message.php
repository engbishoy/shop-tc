<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class recieve_message implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $toid,$fromid,$photo,$recievemessage,$recievephoto;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($toid ,$fromid , $photo , $recievemessage,$recievephoto)
    {
        //

        // user photo 
        $this->toid=$toid;
        $this->fromid=$fromid;
        $this->photo=$photo;
       //end
       
       //send message or photo
       $this->recievemessage=$recievemessage;
        $this->recievephoto=$recievephoto;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('recieve.'. $this->toid);
    }
}
