<div>
    <!-- Trigger Button -->
    <button type="button" wire:click="openModal" class="text-2xl">
        <i class="bi bi-filter-left si">
        </i>
    </button>

    <!-- Right Side Modal Panel -->
    @if ($showModal)
        <div class="fixed inset-y-0 right-0 z-50 w-full max-w-md" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <!-- Side panel -->
            <div
                class="h-full bg-white shadow-2xl border-l border-gray-200 transform transition-transform duration-300 ease-in-out">
                <div class="flex flex-col h-full">
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between p-6 border-b border-gray-200 flex-shrink-0">
                        <h3 class="text-xl font-semibold text-gray-900">Filter</h3>
                        <button type="button" wire:click="closeModal"
                            class="text-gray-400 hover:text-gray-600 focus:outline-none transition-colors duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="flex-1 p-6 space-y-6 overflow-y-auto">

                        <!-- Sort by Section -->
                        <div>
                            <h4 class="text-lg font-medium text-gray-900 mb-3">Sort by</h4>
                            <div class="space-y-3">
                                @foreach ($sortOptions as $value => $label)
                                    <label
                                        class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition-colors duration-200">
                                        <input type="radio" wire:model.live="sortBy" value="{{ $value }}"
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                        <span class="ml-3 text-gray-700">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Price Range Section -->
                        <div>
                            <h4 class="text-lg font-medium text-gray-900 mb-3">Price Range</h4>
                            <div class="text-center text-gray-600 mb-4 font-medium">
                                ${{ number_format($priceMin, 2) }} - ${{ number_format($priceMax, 2) }}
                            </div>

                            <!-- Price Range Controls -->
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Minimum Price:
                                        ${{ number_format($priceMin, 2) }}</label>
                                    <input type="range" wire:model.defer="priceMin" min="{{ $minPrice }}"
                                        max="{{ $priceMax - 1 }}" step="0.01"
                                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer slider-thumb">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Maximum Price:
                                        ${{ number_format($priceMax, 2) }}</label>
                                    <input type="range" wire:model.defer="priceMax" min="{{ $priceMin + 0.01 }}"
                                        max="{{ $maxPrice }}" step="0.01"
                                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer slider-thumb">
                                </div>
                                <div class="flex justify-between text-sm text-gray-500">
                                    <span>${{ number_format($minPrice, 2) }}</span>
                                    <span>${{ number_format($maxPrice, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Category Section -->
                        <div>
                            <h4 class="text-lg font-medium text-gray-900 mb-3">Categories</h4>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach ($categories as $categoryId => $categoryName)
                                    <button type="button" wire:key="category-{{ $categoryId }}"
                                        wire:click="toggleCategory('{{ $categoryId }}')"
                                        class="px-4 py-2 text-sm font-medium rounded-lg border transition-all duration-200 hover:scale-105 text-left
                                            {{ in_array($categoryId, $selectedCategories)
                                                ? 'bg-gray-900 text-white border-gray-900 shadow-md'
                                                : 'bg-gray-100 text-gray-700 border-gray-300 hover:bg-gray-200 hover:border-gray-400' }}">
                                        {{ $categoryName }}
                                    </button>
                                @endforeach
                            </div>
                            @if (empty($categories))
                                <p class="text-sm text-gray-500 italic">No categories available</p>
                            @endif
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex space-x-3 p-6 border-t border-gray-200 flex-shrink-0">
                        <button type="button" wire:click="resetFilters"
                            class="flex-1 bg-gray-200 text-gray-800 py-3 px-4 rounded-lg font-medium hover:bg-gray-300 transition-all duration-200 hover:scale-105">
                            Cancel
                        </button>
                        <button type="button" wire:click="applyFilters"
                            class="flex-1 bg-gray-900 text-white py-3 px-4 rounded-lg font-medium hover:bg-gray-800 transition-all duration-200 hover:scale-105 shadow-lg">
                            Apply
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Custom Slider Styling -->
    <style>
        .slider-thumb::-webkit-slider-thumb {
            appearance: none;
            height: 20px;
            width: 20px;
            border-radius: 50%;
            background: #1f2937;
            cursor: pointer;
            border: 2px solid #ffffff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            transition: all 0.2s ease;
        }

        .slider-thumb::-webkit-slider-thumb:hover {
            transform: scale(1.1);
            background: #111827;
        }

        .slider-thumb::-moz-range-thumb {
            height: 20px;
            width: 20px;
            border-radius: 50%;
            background: #1f2937;
            cursor: pointer;
            border: 2px solid #ffffff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            transition: all 0.2s ease;
        }

        .slider-thumb::-moz-range-thumb:hover {
            transform: scale(1.1);
            background: #111827;
        }

        .slider-thumb::-webkit-slider-track {
            height: 8px;
            border-radius: 4px;
            background: #e5e7eb;
        }

        .slider-thumb::-moz-range-track {
            height: 8px;
            border-radius: 4px;
            background: #e5e7eb;
        }
    </style>
</div>
