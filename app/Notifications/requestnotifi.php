<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

use App\requests;
class requestnotifi extends Notification  
{
    use Queueable;
    public $req;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(requests $req)
    {
        //
        $this->req=$req;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

 
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'user_id1'=>$this->req->user_id1,
            'user_id2'=>$this->req->user_id2,
            
            'userphoto'=>$this->req->userid1->photo,
            'username'=>$this->req->userid1->name,
        ];
    }


    
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            
            'user_id1'=>$this->req->user_id1,
            'user_id2'=>$this->req->user_id2,
            
            'userphoto'=>$this->req->userid1->photo,
            'username'=>$this->req->userid1->name,
            
        ]);
    } 

}
