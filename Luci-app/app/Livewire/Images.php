<?php

namespace App\Livewire;

use Livewire\Component;

class Images extends Component
{
    public $images = [];
    public $mainImage;

    public function mount($images, $mainImage)
    {
        $this->images = is_string($images) ? json_decode($images, true) : $images;
        $this->mainImage = $mainImage;
    }

    public function changeMainImage($clickedImage)
    {
        // Swap clicked image with the current main image
        foreach ($this->images as $index => $img) {
            if ($img === $clickedImage) {
                $this->images[$index] = $this->mainImage;
                $this->mainImage = $clickedImage;
                break;
            }
        }
    }

    public function render()
    {
        return view('livewire.images');
    }
}
