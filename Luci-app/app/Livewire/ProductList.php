<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public $mainCategory;
    public $filters = [];

    protected $listeners = ['filtersApplied' => 'applyFilters'];

    public function mount($mainCategory)
    {
        $this->mainCategory = $mainCategory;
    }

    public function applyFilters($filters)
    {
        $this->filters = $filters ?? [];
        $this->resetPage(); // reset to page 1 when filters change
    }

    public function getFilteredProductsProperty()
    {
        $query = Product::query()->with('category');

        // Only products under main category's subcategories
        $mainCategory = Category::where('name', $this->mainCategory)->first();
        if ($mainCategory) {
            $subCategoryIds = $mainCategory->children()->pluck('id')->toArray();
            $query->whereIn('category_id', $subCategoryIds);
        }

        // Apply filters
        if (!empty($this->filters['categories'])) {
            $query->whereIn('category_id', $this->filters['categories']);
        }

        if (!empty($this->filters['sizes'])) {
            $query->whereIn('size', $this->filters['sizes']);
        }

        if (!empty($this->filters['priceRange'])) {
            $query->whereBetween('price', $this->filters['priceRange']);
        }

        switch ($this->filters['sortBy'] ?? '') {
            case 'new':
                $query->orderBy('created_at', 'desc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            default:
                $query->orderBy('id', 'desc');
        }

        return $query->paginate(12);
    }

    public function render()
    {
        return view('livewire.product-list', [
            'products' => $this->filteredProducts,
        ]);
    }
}
