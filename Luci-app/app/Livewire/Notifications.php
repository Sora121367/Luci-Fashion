<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notifications extends Component
{
    public $showModal = false;
    public $title = 'Notification';

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function removeNotification($index)
{
    if (Auth::check()) {
        $user = Auth::user();
        $notification = $user->notifications
            ->where('type', 'App\Notifications\UserNotification')
            ->values()
            ->get($index);

        if ($notification) {
            $notification->delete();
        }

        // 🔄 Force Livewire to refresh component data
        $this->dispatch('$refresh');
    }
}


    public function getUserNotifications()
    {
        if (Auth::check()) {
            $userNotifications = Auth::user()->notifications;

            return $userNotifications
                ->where('type', 'App\Notifications\UserNotification')
                ->map(function ($notification) {
                    return [
                        'id' => $notification->id,
                        'title' => $notification->data['title'] ?? 'No Title',
                        'message' => $notification->data['message'] ?? '',
                        'order_id' => $notification->data['order_id'] ?? '',
                        'status' => $notification->data['status'] ?? '',
                        'createdat' => $notification->created_at->format('Y/m/d'),
                    ];
                })->values()->toArray();
        }

        return [];
    }

    public function render()
    {
        $notifications = $this->getUserNotifications();
        $number_notifications = count($notifications);

        return view('livewire.notifications', [
            'notifications' => $notifications,
            'number_notifications' => $number_notifications,
        ]);
    }
}
