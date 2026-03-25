<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;

new class extends Component
{
    public int $id = 1;
    public int $selectedImageIndex = 0;
    public string $selectedMemory = '128 GB';
    public string $selectedColor = 'Black';
    public int $quantity = 1;
    public bool $inWishlist = false;

    public array $product = [
        'id'          => 1,
        'name'        => 'iPhone 14 Pro Max iBox',
        'price'       => 20000000,
        'rating'      => 5.0,
        'sold'        => 2400,
        'reviews'     => 2300,
        'badge'       => 'Cashback 20%',
        'description' => 'As part of our efforts to reach carbon neutrality by 2030, iPhone 14 Pro and iPhone 14 Pro Max do not include a power adapter or EarPods.',
        'images'      => [
            'https://images.unsplash.com/photo-1695048133142-1a20484d2569?w=400&q=80',
            'https://images.unsplash.com/photo-1678685888221-cda773a3dcdb?w=400&q=80',
            'https://images.unsplash.com/photo-1632661674596-df8be070a5c5?w=400&q=80',
            'https://images.unsplash.com/photo-1574755393849-623942496936?w=400&q=80',
        ],
        'memory_options' => ['128 GB', '256 GB', '512 GB', '1 TB'],
        'color_options'  => ['Black', 'Gold', 'Purple', 'Silver'],
    ];

    public function mount(int $id = 1): void
    {
        $this->id = $id;
    }

    public function selectImage(int $index): void
    {
        $this->selectedImageIndex = $index;
    }

    public function selectMemory(string $memory): void
    {
        $this->selectedMemory = $memory;
    }

    public function selectColor(string $color): void
    {
        $this->selectedColor = $color;
    }

    public function toggleWishlist(): void
    {
        $this->inWishlist = !$this->inWishlist;
    }

    public function addToCart(): void
    {
        // TODO: implement cart logic
    }

    public function buyNow(): void
    {
        // TODO: redirect to checkout
        $this->redirect(route('cart'));
    }
};
?>

<div class="min-h-dvh bg-gray-50 flex flex-col">

    {{-- Page Header --}}
    <livewire:page-header :title="'Product Detail'" :backUrl="route('home')" />

    <div class="flex-1 pb-32">

        {{-- Image Gallery --}}
        <div class="bg-white px-4 pt-4 pb-2">
            <div class="flex gap-3">
                {{-- Thumbnails --}}
                <div class="flex flex-col gap-2">
                    @foreach($product['images'] as $i => $img)
                        <button
                            wire:click="selectImage({{ $i }})"
                            class="w-14 h-14 rounded-xl overflow-hidden border-2 transition-colors {{ $selectedImageIndex === $i ? 'border-blue-600' : 'border-gray-100' }}"
                        >
                            <img src="{{ $img }}" class="w-full h-full object-cover" />
                        </button>
                    @endforeach
                </div>

                {{-- Main Image --}}
                <div class="flex-1 rounded-2xl overflow-hidden bg-gray-50 min-h-[280px]">
                    <img
                        src="{{ $product['images'][$selectedImageIndex] }}"
                        alt="{{ $product['name'] }}"
                        class="w-full h-[280px] object-cover"
                    />
                </div>
            </div>
        </div>

        {{-- Info Section --}}
        <div class="bg-white mt-2 px-4 py-4">
            {{-- Badge + Wishlist --}}
            <div class="flex items-center justify-between mb-3">
                <span class="text-[12px] font-semibold bg-blue-100 text-blue-700 px-3 py-1 rounded-full">
                    {{ $product['badge'] }}
                </span>
                <button
                    wire:click="toggleWishlist"
                    class="w-9 h-9 flex items-center justify-center rounded-full border border-gray-200 transition-colors
                           {{ $inWishlist ? 'bg-red-50 border-red-200 text-red-500' : 'text-gray-400 hover:text-red-400' }}"
                >
                    <iconify-icon icon="{{ $inWishlist ? 'solar:heart-bold' : 'solar:heart-linear' }}" width="18"></iconify-icon>
                </button>
            </div>

            {{-- Name --}}
            <h1 class="text-[17px] font-semibold text-gray-900 mb-1">{{ $product['name'] }}</h1>

            {{-- Price --}}
            <p class="text-2xl font-bold text-gray-900 mb-2">IDR {{ number_format($product['price'], 0, ',', '.') }}</p>

            {{-- Rating & Stats --}}
            <div class="flex items-center gap-3 text-sm text-gray-500 mb-3">
                <span class="flex items-center gap-1 text-amber-500 font-medium">
                    <iconify-icon icon="solar:star-bold" width="14"></iconify-icon>
                    {{ $product['rating'] }} Ratings
                </span>
                <span>{{ number_format($product['sold'] / 1000, 1) }}k Sold</span>
                <span>{{ number_format($product['reviews'] / 1000, 1) }}k Reviews</span>
            </div>

            {{-- Description --}}
            <p class="text-[13px] text-gray-500 leading-relaxed mb-1">
                {{ $product['description'] }}
                <button class="text-blue-600 font-medium">See More</button>
            </p>
        </div>

        {{-- Select Memory --}}
        <div class="bg-white mt-2 px-4 py-4">
            <p class="text-[13px] font-semibold text-gray-700 mb-2.5">Select Memory</p>
            <div class="flex gap-2 flex-wrap">
                @foreach($product['memory_options'] as $mem)
                    <button
                        wire:click="selectMemory('{{ $mem }}')"
                        class="px-4 py-1.5 rounded-full border text-[13px] font-medium transition-all
                               {{ $selectedMemory === $mem
                                  ? 'bg-blue-900 border-blue-900 text-white'
                                  : 'border-gray-200 text-gray-600 hover:border-blue-300' }}"
                    >
                        {{ $mem }}
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Select Color --}}
        <div class="bg-white mt-2 px-4 py-4 pb-8">
            <p class="text-[13px] font-semibold text-gray-700 mb-2.5">Select Color</p>
            <div class="flex gap-2 flex-wrap">
                @foreach($product['color_options'] as $color)
                    <button
                        wire:click="selectColor('{{ $color }}')"
                        class="px-4 py-1.5 rounded-full border text-[13px] font-medium transition-all
                               {{ $selectedColor === $color
                                  ? 'bg-blue-900 border-blue-900 text-white'
                                  : 'border-gray-200 text-gray-600 hover:border-blue-300' }}"
                    >
                        {{ $color }}
                    </button>
                @endforeach
            </div>
        </div>

    </div>

    {{-- Bottom Action Bar --}}
    <div class="fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-gray-100">
        <div class="max-w-4xl mx-auto flex items-center gap-4 px-4 py-3">
            <div>
                <p class="text-[11px] text-gray-400">Price</p>
                <p class="text-[17px] font-bold text-gray-900">IDR {{ number_format($product['price'], 0, ',', '.') }}</p>
            </div>
            <div class="flex gap-2 flex-1">
                <button
                    wire:click="addToCart"
                    class="flex-1 py-3 rounded-2xl border-2 border-blue-900 text-blue-900 font-semibold text-[14px] hover:bg-blue-50 transition-colors"
                >
                    + Keranjang
                </button>
                <button
                    wire:click="buyNow"
                    class="flex-1 py-3 rounded-2xl bg-blue-600 text-white font-semibold text-[14px] hover:bg-blue-700 transition-colors"
                >
                    Buy Now
                </button>
            </div>
        </div>
    </div>

</div>