<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via(object $notifiable): array
{
    // Only send email if order is Accepted or Completed
    if (in_array($this->order->status, ['Accepted', 'Completed'])) {
        return ['mail', 'database'];
    }

    // For Rejected or Pending, only save in database (no email)
    return ['database'];
}

 public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your Order #' . $this->order->id . ' is ' . $this->order->status)
            ->greeting('Hello ' . $notifiable->Firstname . ',')
            ->line("Your order has been {$this->order->status}.")
            ->line('Order ID: ' . $this->order->id)
            ->line('Total Price: $' . number_format($this->order->total_price, 2))
            ->action('View Your Order', url('/orders/' . $this->order->id))
            ->line('Thank you for shopping with us!');
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => "Hello, {$this->order->user->name}",
            'message' => "Your order #{$this->order->id} has been {$this->order->status}.",
            'order_id' => $this->order->id,
            'status' => $this->order->status,
        ];
    }
}
