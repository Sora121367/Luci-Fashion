<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;

class Filter extends Component
{
    public $showModal = false;

    // Filter properties
    public $sortBy = '';
    public $priceMin;
    public $priceMax;
    public $minPrice; // Database min price
    public $maxPrice; // Database max price
    public $selectedSizes = [];
    public $selectedCategories = [];
    public $mainCategory;

    // Available options (loaded from database)
    public $sizes = ['S', 'M', 'L', 'XL', 'XXL'];
    public $categories = [];
    public $sortOptions = [
        'new' => 'New Items',
        'price_high' => 'Price (High First)',
        'price_low' => 'Price (Low First)',
        'name_asc' => 'Name (A-Z)',
        'name_desc' => 'Name (Z-A)'
    ];

    public function mount()
    {
        $this->loadDynamicData();

        $this->priceMin ??= $this->minPrice;
        $this->priceMax ??= $this->maxPrice;

        // If not loaded from query string
        $this->selectedSizes ??= [];
        $this->selectedCategories ??= [];

        $this->loadFiltersFromUrl();
    }



    private function loadDynamicData()
    {
        // Get price range from products
        $priceRange = Product::selectRaw('MIN(price) as min_price, MAX(price) as max_price')->first();
        $this->minPrice = floor($priceRange->min_price ?? 0);
        $this->maxPrice = ceil($priceRange->max_price ?? 100);

        $this->priceMin = $this->minPrice;
        $this->priceMax = $this->maxPrice;

        // Load subcategories based on the main category
        $mainCategory = Category::where('name', $this->mainCategory)->firstOrFail();

        $this->categories = $mainCategory->children()
            ->orderBy('name')
            ->pluck('name', 'id')
            ->toArray();
    }


    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }


    public function toggleCategory($categoryId)
    {
        if (in_array($categoryId, $this->selectedCategories)) {
            $this->selectedCategories = array_filter($this->selectedCategories, fn($id) => $id != $categoryId);
        } else {
            $this->selectedCategories[] = $categoryId;
        }
        $this->selectedCategories = array_values($this->selectedCategories);
    }

    public function applyFilters()
    {
        // dd($this->priceMin, $this->priceMax, $this->selectedCategories);
        $filters = [
            'sortBy' => $this->sortBy,
            'priceRange' => [$this->priceMin, $this->priceMax],
            'categories' => $this->selectedCategories,
        ];

        $this->dispatch('filtersApplied', $filters);

        // ✅ DO NOT redirect manually
        $this->closeModal();
    }


    public function resetFilters()
    {
        $this->sortBy = null;
        $this->priceMin = $this->minPrice;
        $this->priceMax = $this->maxPrice;
        $this->selectedCategories = [];

        // Emit empty filters
        $this->dispatch('filtersApplied', []);

        $this->closeModal(); // optional
    }



    public function loadFiltersFromUrl()
    {
        $request = request();

        // Load sort
        if ($request->has('sort')) {
            $this->sortBy = $request->get('sort');
        }

        // Load price range
        if ($request->has('price_min')) {
            $this->priceMin = max($request->get('price_min'), $this->minPrice);
        }
        if ($request->has('price_max')) {
            $this->priceMax = min($request->get('price_max'), $this->maxPrice);
        }

        // Load sizes
        if ($request->has('sizes')) {
            $this->selectedSizes = explode(',', $request->get('sizes'));
        }

        // Load categories
        if ($request->has('categories')) {
            $this->selectedCategories = array_map('intval', explode(',', $request->get('categories')));
        }
    }

    public function getFilteredProductsProperty()
    {
        $query = Product::query()->with('category');

        // Apply price filter
        if ($this->priceMin != $this->minPrice || $this->priceMax != $this->maxPrice) {
            $query->whereBetween('price', [$this->priceMin, $this->priceMax]);
        }

        // Apply size filter
        if (!empty($this->selectedSizes)) {
            $query->whereIn('size', $this->selectedSizes);
        }

        // Apply category filter
        if (!empty($this->selectedCategories)) {
            $query->whereIn('category_id', $this->selectedCategories);
        }

        // Apply sorting
        switch ($this->sortBy) {
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
        return view('livewire.filter');
    }
}
