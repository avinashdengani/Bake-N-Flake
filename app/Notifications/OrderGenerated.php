<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderGenerated extends Notification
{
    use Queueable;
    private $user;
    private $order_id;

    public function __construct($user, $order_id)
    {
        $this->user = $user;
        $this->order_id = $order_id;
    }


    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line( $this->user->name . ' you have a new order. Order ID: ' . $this->order_id )
                    ->action('View Order', url('/orders'));
    }


    public function toArray($notifiable)
    {
        return [
            'order' => $this->order_id
        ];
    }
}
