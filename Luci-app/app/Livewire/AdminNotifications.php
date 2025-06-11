<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AdminNotifications extends Component
{

    public $showModal = false;
    public $notifications = [];

    public function markAllAsRead()
    {
        Auth::guard('admin')->user()->unreadNotifications->markAsRead();
    }


    public function openModal()
    {
        $this->showModal = !$this->showModal;
    }




    public function render()
    {
        return view('livewire.admin-notifications', [
            'notifications' => Auth::guard('admin')->user()->unreadNotifications,
        ]);
    }
}
