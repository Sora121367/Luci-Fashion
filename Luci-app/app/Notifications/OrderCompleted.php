<?php

namespace App\Notifications;

use App\Events\AdminNotification;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OrderCompleted extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;

    /**
     * Create a new notification instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
 
    /**
     * Store in database.
     */
   public function toDatabase(object $notifiable): array
{
    $order = $this->order;
    $user = $order->user;


    return [
        'order_id' => $order->id,
        'Firstname' => $user->Firstname ?? 'A user',
        'message' => 'New order placed by ' . ($user->name ?? 'a user'),
        'total_price' => $order->total_price,
    ];
}

}
