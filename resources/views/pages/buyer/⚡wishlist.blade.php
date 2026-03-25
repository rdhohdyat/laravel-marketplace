<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new class extends Component
{
    public array $wishlistItems = [
        [
            'id' => 1,
            'name' => 'iPhone 13 Mini 128 GB',
            'price' => 10000000,
            'original_price' => 12000000,
            'image' => 'https://images.unsplash.com/photo-1632661674596-df8be070a5c5?w=300&q=80',
            'rating' => 5.0,
            'sold' => 666,
            'in_stock' => true,
            'discount' => 17,
        ],
        [
            'id' => 2,
            'name' => 'Apple Watch Series 8',
            'price' => 3500000,
            'original_price' => 4200000,
            'image' => 'https://images.unsplash.com/photo-1546868871-7041f2a55e12?w=300&q=80',
            'rating' => 4.8,
            'sold' => 600,
            'in_stock' => true,
            'discount' => 17,
        ],
        [
            'id' => 3,
            'name' => 'AirPods Pro 2nd Gen',
            'price' => 2800000,
            'original_price' => 3500000,
            'image' => 'https://images.unsplash.com/photo-1603351154351-5e2d0600bb77?w=300&q=80',
            'rating' => 4.9,
            'sold' => 432,
            'in_stock' => false,
            'discount' => 20,
        ],
        [
            'id' => 4,
            'name' => 'MacBook Pro M3 14"',
            'price' => 25000000,
            'original_price' => 28000000,
            'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=300&q=80',
            'rating' => 5.0,
            'sold' => 120,
            'in_stock' => true,
            'discount' => 11,
        ],
    ];

    public function removeItem(int $id): void
    {
        $this->wishlistItems = array_values(
            array_filter($this->wishlistItems, fn($item) => $item['id'] !== $id)
        );
    }

    public function addToCart(int $id): void
    {
        // TODO: implement add to cart logic
        session()->flash('cart_added', $id);
    }
};
?>

<div class="min-h-dvh bg-gray-50 flex flex-col">

    {{-- Page Header --}}
    <livewire:page-header :title="'Wishlist'" :backUrl="route('home')" />

    {{-- Page Content --}}
    <div class="flex-1 pb-28 max-w-4xl mx-auto w-full pt-4">

        @if(count($wishlistItems) === 0)
            {{-- Empty State --}}
            <div class="flex flex-col items-center justify-center px-6 py-24 text-center">
                <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                    <iconify-icon icon="solar:heart-linear" class="text-gray-300 text-4xl"></iconify-icon>
                </div>
                <p class="text-gray-500 font-medium mb-1">Wishlist masih kosong</p>
                <p class="text-sm text-gray-400 mb-6">Simpan produk favoritmu di sini</p>
                <a wire:navigate href="{{ route('home') }}"
                   class="inline-flex items-center gap-2 bg-blue-900 text-white text-sm font-semibold px-6 py-2.5 rounded-full hover:bg-blue-800 transition-colors">
                    <iconify-icon icon="solar:home-2-linear" width="16"></iconify-icon>
                    Jelajahi Produk
                </a>
            </div>
        @else
            {{-- Wishlist Items --}}
            <div class="flex flex-col gap-3 px-4">
                @foreach($wishlistItems as $item)
                    <div class="bg-white rounded-2xl border border-gray-100 p-3 flex gap-3 hover:border-gray-300 transition-colors">

                        {{-- Product Image --}}
                        <div class="relative shrink-0 w-24 h-24">
                            <img
                                src="{{ $item['image'] }}"
                                alt="{{ $item['name'] }}"
                                class="w-full h-full object-cover rounded-xl bg-gray-50 border border-gray-100"
                            />
                            @if(!$item['in_stock'])
                                <div class="absolute inset-0 bg-white/60 backdrop-blur-[2px] rounded-xl flex items-center justify-center">
                                    <span class="text-white text-[10px] font-bold bg-gray-800 px-2.5 py-1 rounded-full">Habis</span>
                                </div>
                            @endif
                        </div>

                        {{-- Product Info --}}
                        <div class="flex-1 flex flex-col justify-between min-w-0">
                            <div>
                                <p class="text-[13px] font-medium text-gray-800 leading-snug line-clamp-2 mb-1.5">
                                    {{ $item['name'] }}
                                </p>
                                <div class="flex items-center gap-1.5 flex-wrap">
                                    <span class="text-[15px] font-bold text-gray-900">
                                        IDR {{ number_format($item['price'], 0, ',', '.') }}
                                    </span>
                                    <span class="text-[11px] text-gray-400 line-through">
                                        IDR {{ number_format($item['original_price'], 0, ',', '.') }}
                                    </span>
                                    <span class="text-[10px] font-semibold text-red-600 bg-red-50 px-1.5 py-0.5 rounded">
                                        -{{ $item['discount'] }}%
                                    </span>
                                </div>
                                <div class="flex items-center gap-1.5 mt-1.5 text-[11px] text-gray-400">
                                    <iconify-icon icon="solar:star-bold" style="color:#f59e0b" width="11"></iconify-icon>
                                    <span>{{ $item['rating'] }}</span>
                                    <span>·</span>
                                    <span>{{ number_format($item['sold']) }} Terjual</span>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="flex items-center gap-2 mt-2.5">
                                <button
                                    wire:click="addToCart({{ $item['id'] }})"
                                    @disabled(!$item['in_stock'])
                                    class="flex-1 flex items-center justify-center gap-1.5 py-1.5 rounded-lg text-[12px] font-semibold transition-colors
                                           {{ $item['in_stock']
                                              ? 'bg-blue-900 text-white hover:bg-blue-800'
                                              : 'bg-gray-100 text-gray-400 cursor-not-allowed' }}"
                                >
                                    <iconify-icon icon="solar:cart-large-minimalistic-linear" width="14"></iconify-icon>
                                    {{ $item['in_stock'] ? 'Tambah ke Keranjang' : 'Stok Habis' }}
                                </button>
                                <button
                                    wire:click="removeItem({{ $item['id'] }})"
                                    class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 transition-colors"
                                >
                                    <iconify-icon icon="solar:trash-bin-minimalistic-linear" width="16"></iconify-icon>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>

    {{-- Bottom Navigation --}}
    <livewire:bottom-navigation :active="'wishlist'" />

</div>