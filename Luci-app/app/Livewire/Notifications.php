<?php

namespace App\Livewire;

use Livewire\Component;

class Notifications extends Component
{
    public $showModal = false;
    public $title = 'Notification';
    public $number_notifications = 1;

    public $notifications = [];

    public function mount()
    {
        // Initialize product list with default values
        $this->notifications = [
            [
                "id" => "1",
                "message" => "Hello From Admin",
                "createdat" => "2025/04/15",
            ],
            [
                "id" => "2",
                "message" => "Hello From Admin",
                "createdat" => "2025/04/15",
            ],
            [
                "id" => "3",
                "message" => "Hello From Admin",
                "createdat" => "2025/04/15",
            ],
        ];
    }

    public function getProductQuantityProperty()
    {
        // Live calculation of product quantity
        return count($this->products);
    }

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
        // Remove product at given index
        unset($this->notifications[$index]);

        // Reindex array to prevent Livewire reactivity issues
        $this->notifications = array_values($this->notifications);
    }
    public function render()
    {
        return view('livewire.notifications');
    }
}
