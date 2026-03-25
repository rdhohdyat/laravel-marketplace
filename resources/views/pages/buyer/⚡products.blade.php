<?php

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Title;

new class extends Component
{
    #[Url(as: 'q')]
    public string $searchQuery = '';

    public array $products = [
        [
            'id' => 1,
            'name' => 'iPhone 14 Pro Max 128GB - Deep Purple',
            'price' => 20000000,
            'original_price' => 22000000,
            'rating' => 4.9,
            'sold' => 1250,
            'image' => 'https://images.unsplash.com/photo-1695048133142-1a20484d2569?w=400&q=80',
            'store' => 'iBox Official',
            'location' => 'Jakarta Pusat',
            'is_official' => true
        ],
        [
            'id' => 2,
            'name' => 'Apple AirPods Pro (2nd generation)',
            'price' => 3500000,
            'rating' => 4.8,
            'sold' => 840,
            'image' => 'https://images.unsplash.com/photo-1603351154351-5e2d0600bb77?w=400&q=80',
            'store' => 'iBox Official',
            'location' => 'Jakarta Pusat',
            'is_official' => true
        ],
        [
            'id' => 3,
            'name' => 'Apple Watch Series 8 Midnight Aluminum',
            'price' => 6500000,
            'rating' => 4.7,
            'sold' => 520,
            'image' => 'https://images.unsplash.com/photo-1546868871-7041f2a55e12?w=400&q=80',
            'store' => 'Erafone',
            'location' => 'Surabaya',
            'is_official' => false
        ],
        [
            'id' => 4,
            'name' => 'Sony WH-1000XM5 Wireless Headphones',
            'price' => 4800000,
            'original_price' => 5500000,
            'rating' => 4.9,
            'sold' => 210,
            'image' => 'https://images.unsplash.com/photo-1618366712010-f4ae9c647dcb?w=400&q=80',
            'store' => 'Sony Audio Official',
            'location' => 'Jakarta Barat',
            'is_official' => true
        ],
        [
            'id' => 5,
            'name' => 'MacBook Air M2 8GB/256GB - Starlight',
            'price' => 18500000,
            'rating' => 5.0,
            'sold' => 345,
            'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=400&q=80',
            'store' => 'Studio Ponsel',
            'location' => 'Jakarta Selatan',
            'is_official' => false
        ]
    ];

    public function getFilteredProductsProperty()
    {
        if (empty($this->searchQuery)) {
            return $this->products;
        }

        return array_filter($this->products, function($product) {
            return stripos($product['name'], $this->searchQuery) !== false;
        });
    }
};
?>

<div class="min-h-dvh bg-gray-50 flex flex-col">

    {{-- Page Header --}}
    <div class="sticky top-0 z-50 bg-white border-b border-gray-100">
        <div class="max-w-4xl mx-auto w-full px-4 h-14 flex items-center gap-3">
            <a wire:navigate href="{{ route('home') }}" class="w-9 h-9 flex items-center justify-center rounded-xl text-gray-700 hover:bg-gray-100 transition-colors shrink-0">
                <iconify-icon icon="solar:alt-arrow-left-linear" width="22"></iconify-icon>
            </a>
            
            <div class="flex-1 relative">
                <div class="flex items-center gap-2 bg-gray-100 rounded-xl px-3 py-2 border border-transparent focus-within:border-blue-500 focus-within:bg-white transition-colors">
                    <iconify-icon icon="solar:magnifer-linear" class="text-gray-400 text-base shrink-0"></iconify-icon>
                    <input
                        wire:model.live.debounce.300ms="searchQuery"
                        type="text"
                        placeholder="Cari produk..."
                        class="flex-1 bg-transparent text-sm text-gray-900 outline-none placeholder-gray-400 font-sans w-full"
                    />
                    @if($searchQuery)
                        <button wire:click="$set('searchQuery', '')" class="text-gray-400 hover:text-gray-600 transition-colors">
                            <iconify-icon icon="solar:close-circle-bold" width="16"></iconify-icon>
                        </button>
                    @endif
                </div>
            </div>

            <a wire:navigate href="{{ route('cart') }}" class="w-9 h-9 flex items-center justify-center rounded-xl text-gray-700 hover:bg-gray-100 transition-colors shrink-0 relative">
                <iconify-icon icon="solar:cart-large-minimalistic-linear" width="22"></iconify-icon>
                <span class="absolute top-1 right-1 bg-red-500 text-white text-[9px] font-semibold min-w-[15px] h-[15px] rounded-full flex items-center justify-center px-0.5">3</span>
            </a>
        </div>
        
        {{-- Quick Filters --}}
        <div class="max-w-4xl mx-auto w-full px-4 py-2 flex items-center gap-2 overflow-x-auto hide-scrollbar">
            <button class="px-4 py-1.5 bg-blue-600 text-white text-[12px] font-semibold rounded-full shrink-0">Terkait</button>
            <button class="px-4 py-1.5 bg-white border border-gray-200 text-gray-700 text-[12px] font-semibold rounded-full shrink-0 hover:bg-gray-50">Terbaru</button>
            <button class="px-4 py-1.5 bg-white border border-gray-200 text-gray-700 text-[12px] font-semibold rounded-full shrink-0 hover:bg-gray-50">Terlaris</button>
            <button class="px-4 py-1.5 bg-white border border-gray-200 text-gray-700 text-[12px] font-semibold rounded-full shrink-0 hover:bg-gray-50 flex items-center gap-1">
                Harga <iconify-icon icon="solar:alt-arrow-down-linear"></iconify-icon>
            </button>
        </div>
    </div>

    <div class="flex-1 pb-10 max-w-4xl mx-auto w-full px-4 pt-4">
        
        @if($searchQuery)
            <div class="mb-4">
                <p class="text-sm text-gray-600">Hasil pencarian untuk <strong class="text-gray-900">"{{ $searchQuery }}"</strong></p>
            </div>
        @endif

        @if(count($this->filteredProducts) > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
                @foreach($this->filteredProducts as $product)
                    <a wire:navigate href="{{ route('product.detail', $product['id']) }}" class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 group flex flex-col">
                        <div class="relative pt-[100%] bg-gray-100 shrink-0">
                            <img
                                src="{{ $product['image'] }}"
                                alt="{{ $product['name'] }}"
                                class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            />
                            @if(isset($product['original_price']))
                                <div class="absolute top-2 left-2 bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">
                                    Diskon
                                </div>
                            @endif
                        </div>
                        
                        <div class="p-3 flex-1 flex flex-col">
                            <h3 class="text-[13px] font-medium text-gray-800 leading-snug line-clamp-2 mb-1 group-hover:text-blue-600 transition-colors">
                                {{ $product['name'] }}
                            </h3>
                            
                            <div class="mt-auto">
                                <div class="flex items-center gap-1.5 mb-1.5">
                                    <span class="text-[15px] font-bold text-gray-900">IDR {{ number_format($product['price'], 0, ',', '.') }}</span>
                                </div>
                                @if(isset($product['original_price']))
                                    <div class="flex items-center gap-1 mb-1.5">
                                        <span class="text-[10px] bg-red-50 text-red-500 font-bold px-1 rounded">-{{ round((($product['original_price'] - $product['price']) / $product['original_price']) * 100) }}%</span>
                                        <span class="text-[11px] text-gray-400 line-through">IDR {{ number_format($product['original_price'], 0, ',', '.') }}</span>
                                    </div>
                                @endif
                                
                                <div class="flex items-center gap-1">
                                    <iconify-icon icon="solar:map-point-linear" class="text-gray-400" width="12"></iconify-icon>
                                    <span class="text-[11px] text-gray-500 truncate">{{ $product['location'] }}</span>
                                </div>

                                <div class="flex items-center gap-2 mt-2 pt-2 border-t border-gray-50">
                                    <div class="flex items-center gap-0.5">
                                        <iconify-icon icon="solar:star-bold" class="text-orange-400 text-[10px]"></iconify-icon>
                                        <span class="text-[11px] font-semibold text-gray-700">{{ $product['rating'] }}</span>
                                    </div>
                                    <div class="w-1 h-1 bg-gray-300 rounded-full"></div>
                                    <span class="text-[11px] text-gray-500">Terjual {{ $product['sold'] }}+</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="py-20 flex flex-col items-center justify-center text-center">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4 text-gray-400">
                    <iconify-icon icon="solar:magnifer-linear" class="text-4xl"></iconify-icon>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-1">Produk tidak ditemukan</h3>
                <p class="text-sm text-gray-500 max-w-[250px]">Coba gunakan kata kunci lain yang lebih umum atau periksa ejaan Anda.</p>
                <button wire:click="$set('searchQuery', '')" class="mt-6 font-semibold text-blue-600 bg-blue-50 px-5 py-2 rounded-full text-[13px] hover:bg-blue-100 transition-colors">
                    Hapus Pencarian
                </button>
            </div>
        @endif
        
    </div>
</div>