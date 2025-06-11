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
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your Order #' . $this->order->id . ' is Complete')
            ->greeting('Hello ' . $notifiable->Firstname . ',')
            ->line('Thank you for your order! Your order has been completed successfully.')
            ->line('Order Details:')
            ->line('Order ID: ' . $this->order->id)
            ->line('Total Price: $' . number_format($this->order->total_price, 2))
            ->action('View Your Order', url('/orders/' . $this->order->id))
            ->line('We appreciate your business!');
    }


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
