<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use App\chat;
class message_notification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(chat $chat)
    {
        //
        $this->chat=$chat;
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
            'fromuserphoto'=>$this->chat->chatuser1->photo,
            'fromusername'=>$this->chat->chatuser1->name,
            'fromuserid'=>$this->chat->chatuser1->id,
            'message'=>$this->chat->message
        ];
    }


    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            //

            'fromuserphoto'=>$this->chat->chatuser1->photo,
            'fromusername'=>$this->chat->chatuser1->name,
            'fromuserid'=>$this->chat->chatuser1->id,
            'message'=>$this->chat->message,
            'created_at'=>$this->chat->created_at,
        ]);
      
    }
}
