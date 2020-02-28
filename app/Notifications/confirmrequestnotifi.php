<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class confirmrequestnotifi extends Notification implements ShouldQueue
{
    use Queueable;
    public $photo,$name;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($photo,$name)
    {
        //
        $this->photo=$photo;
        $this->name=$name;
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
            //
            'confirmuserphoto'=>  $this->photo,
            'confirmusername'=>  $this->name,
        ];
    }

    
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'confirmuserphoto'=>  $this->photo,
            'confirmusername'=>   $this->name,
        ]);
    } 

}
