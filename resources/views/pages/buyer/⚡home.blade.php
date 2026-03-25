<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new class extends Component {
    public int $flashSaleHours = 10;
    public int $flashSaleMinutes = 11;
    public int $flashSaleSecs = 1;

    public array $categories = [
        ['name' => 'All', 'icon' => 'solar:widget-5-bold', 'active' => true],
        ['name' => 'iPhone', 'icon' => 'solar:phone-bold', 'active' => false],
        ['name' => 'iPad', 'icon' => 'solar:tablet-bold', 'active' => false],
        ['name' => 'Mac', 'icon' => 'solar:laptop-bold', 'active' => false],
    ];

    public string $activeCategory = 'All';

    public array $flashSaleProducts = [
        [
            'id' => 1,
            'name' => 'iPhone 13 Mini 128 GB',
            'price' => 10000000,
            'image' => 'https://images.unsplash.com/photo-1632661674596-df8be070a5c5?w=300&q=80',
            'rating' => 5.0,
            'sold' => 666,
            'badge' => 'Cashback 15%',
            'badge_class' => 'bg-blue-100 text-blue-700',
        ],
        [
            'id' => 2,
            'name' => 'Apple Watch S8',
            'price' => 3500000,
            'image' => 'https://images.unsplash.com/photo-1546868871-7041f2a55e12?w=300&q=80',
            'rating' => 4.8,
            'sold' => 600,
            'badge' => 'Discount 20%',
            'badge_class' => 'bg-red-100 text-red-600',
        ],
        [
            'id' => 3,
            'name' => 'AirPods Pro 2',
            'price' => 2800000,
            'image' => 'https://images.unsplash.com/photo-1603351154351-5e2d0600bb77?w=300&q=80',
            'rating' => 4.9,
            'sold' => 432,
            'badge' => 'Sale 10%',
            'badge_class' => 'bg-green-100 text-green-700',
        ],
    ];

    public array $recommendedProducts = [
        [
            'id' => 4,
            'name' => 'MacBook Pro M3',
            'price' => 25000000,
            'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=300&q=80',
            'rating' => 5.0,
            'sold' => 120,
        ],
        [
            'id' => 5,
            'name' => 'Samsung Galaxy S24',
            'price' => 13000000,
            'image' => 'https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?w=300&q=80',
            'rating' => 4.7,
            'sold' => 890,
        ],
        [
            'id' => 6,
            'name' => 'Sony WH-1000XM5',
            'price' => 4500000,
            'image' => 'https://images.unsplash.com/photo-1618366712010-f4ae9c647dcb?w=300&q=80',
            'rating' => 4.8,
            'sold' => 310,
        ],
        [
            'id' => 7,
            'name' => 'iPad Air M2',
            'price' => 9500000,
            'image' => 'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?w=300&q=80',
            'rating' => 4.9,
            'sold' => 218,
        ],
    ];

    public function setCategory(string $category): void
    {
        $this->activeCategory = $category;
        foreach ($this->categories as &$cat) {
            $cat['active'] = $cat['name'] === $category;
        }
    }
};
?>

<div class="min-h-dvh bg-white flex flex-col">

    {{-- Navbar --}}
    <livewire:navbar />

    {{-- Scrollable Content --}}
    <div class="flex-1 pb-28 max-w-4xl mx-auto w-full">

        {{-- Hero Banner --}}
        <div
            class="mx-4 mt-4 rounded-2xl overflow-hidden bg-linear-to-br from-blue-900 via-blue-700 to-blue-400 flex items-end justify-between min-h-[130px] px-5 pt-5">
            <div class="pb-5 z-10">
                <p class="text-white/70 text-[13px] m-0">iPhone 14 Pro</p>
                <p class="text-white text-xl font-semibold mt-0.5 mb-3.5">Pro. Beyond.</p>
                <a href="#"
                    class="inline-block bg-white text-blue-700 text-[13px] font-semibold px-5 py-1.5 rounded-full hover:-translate-y-0.5 hover:shadow-lg transition-all">
                    Get Now
                </a>
            </div>
            <img src="https://images.unsplash.com/photo-1695048133142-1a20484d2569?w=400&q=80" alt="iPhone 14 Pro"
                class="w-36 object-contain object-bottom -mr-2 self-end" />
        </div>

        {{-- Category Tabs --}}
        <div class="flex gap-2 px-4 mt-4 overflow-x-auto scrollbar-none pb-1">
            @foreach($categories as $cat)
                    <button wire:click="setCategory('{{ $cat['name'] }}')" class="flex items-center gap-1.5 px-4 py-1.5 rounded-full border text-[13px] font-medium whitespace-nowrap shrink-0 cursor-pointer transition-all
                                   {{ $cat['active']
                ? 'bg-blue-900 border-blue-900 text-white'
                : 'bg-white border-gray-200 text-gray-500 hover:border-blue-300 hover:text-blue-600' }}">
                        <iconify-icon icon="{{ $cat['icon'] }}" width="16"></iconify-icon>
                        {{ $cat['name'] }}
                    </button>
            @endforeach
        </div>

        {{-- Flash Sale Section --}}
        <div class="mt-4">
            <div class="flex items-center justify-between px-4 mb-3">
                <h2 class="text-[17px] font-semibold text-gray-900">Ramadhan Sales</h2>
                <div class="flex items-center gap-0.5">
                    <span
                        class="bg-blue-900 text-white text-[13px] font-semibold px-2 py-0.5 rounded-md min-w-[26px] text-center">
                        {{ str_pad($flashSaleHours, 2, '0', STR_PAD_LEFT) }}
                    </span>
                    <span class="text-blue-900 font-bold text-sm">:</span>
                    <span
                        class="bg-blue-900 text-white text-[13px] font-semibold px-2 py-0.5 rounded-md min-w-[26px] text-center">
                        {{ str_pad($flashSaleMinutes, 2, '0', STR_PAD_LEFT) }}
                    </span>
                    <span class="text-blue-900 font-bold text-sm">:</span>
                    <span
                        class="bg-blue-900 text-white text-[13px] font-semibold px-2 py-0.5 rounded-md min-w-[26px] text-center">
                        {{ str_pad($flashSaleSecs, 2, '0', STR_PAD_LEFT) }}
                    </span>
                </div>
            </div>

            <div class="flex gap-3 px-4 overflow-x-auto scrollbar-none pb-1">
                @foreach($flashSaleProducts as $product)
                    <a wire:navigate href="{{ route('product.detail', $product['id']) }}">
                        <div
                            class="bg-white rounded-2xl border border-gray-100 overflow-hidden relative shrink-0 w-40 cursor-pointer hover:-translate-y-0.5 hover:shadow-lg transition-all">
                            <span
                                class="absolute top-2 left-2 z-10 text-[10px] font-semibold px-2 py-0.5 rounded-full {{ $product['badge_class'] }}">
                                {{ $product['badge'] }}
                            </span>
                            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}"
                                class="w-full h-32 object-cover bg-gray-50" />
                            <div class="p-2.5 pb-3">
                                <p class="text-[13px] font-medium text-gray-700 mb-1 leading-snug line-clamp-2">
                                    {{ $product['name'] }}</p>
                                <p class="text-sm font-bold text-gray-900 mb-1.5">IDR
                                    {{ number_format($product['price'], 0, ',', '.') }}</p>
                                <div class="flex items-center gap-1.5 text-[11px] text-gray-500">
                                    <span class="flex items-center gap-0.5 text-amber-800">
                                        <iconify-icon icon="solar:star-bold" style="color:#f59e0b"
                                            width="12"></iconify-icon>
                                        {{ $product['rating'] }}
                                    </span>
                                    <span>{{ number_format($product['sold']) }} Terjual</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Recommended Section --}}
        <div class="mt-4">
            <div class="flex items-center justify-between px-4 mb-3">
                <h2 class="text-[17px] font-semibold text-gray-900">Rekomendasi untuk kamu</h2>
            </div>

            <div class="grid grid-cols-2 gap-3 px-4">
                @foreach($recommendedProducts as $product)
                    <div
                        class="bg-white rounded-2xl border border-gray-100 overflow-hidden cursor-pointer hover:-translate-y-0.5 hover:shadow-lg transition-all">
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}"
                            class="w-full h-32 object-cover bg-gray-50" />
                        <div class="p-2.5 pb-3">
                            <p class="text-[13px] font-medium text-gray-700 mb-1 leading-snug line-clamp-2">
                                {{ $product['name'] }}</p>
                            <p class="text-sm font-bold text-gray-900 mb-1.5">IDR
                                {{ number_format($product['price'], 0, ',', '.') }}</p>
                            <div class="flex items-center gap-1.5 text-[11px] text-gray-500">
                                <span class="flex items-center gap-0.5 text-amber-800">
                                    <iconify-icon icon="solar:star-bold" style="color:#f59e0b" width="12"></iconify-icon>
                                    {{ $product['rating'] }}
                                </span>
                                <span>{{ number_format($product['sold']) }} Terjual</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

    {{-- Bottom Navigation --}}
    <livewire:bottom-navigation :active="'home'" />

</div>