<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new class extends Component
{
    public string $activeTab = 'Semua';

    public array $tabs = ['Semua', 'Dikemas', 'Dikirim', 'Selesai'];

    public array $orders = [
        [
            'id' => 'INV-20260325-001',
            'status' => 'Dikemas',
            'status_color' => 'text-amber-600 bg-amber-50',
            'date' => '25 Mar 2026',
            'store' => 'iBox Official',
            'items' => [
                [
                    'name' => 'iPhone 14 Pro Max',
                    'variant' => 'Black, 128 GB',
                    'price' => 20000000,
                    'qty' => 1,
                    'image' => 'https://images.unsplash.com/photo-1695048133142-1a20484d2569?w=200&q=80',
                ]
            ],
            'total' => 20050000,
            'action' => 'Lacak Pesanan',
            'action_color' => 'border border-gray-200 text-gray-700',
        ],
        [
            'id' => 'INV-20260320-089',
            'status' => 'Dikirim',
            'status_color' => 'text-blue-600 bg-blue-50',
            'date' => '20 Mar 2026',
            'store' => 'Sony Center',
            'items' => [
                [
                    'name' => 'Sony WH-1000XM5',
                    'variant' => 'Black',
                    'price' => 4500000,
                    'qty' => 1,
                    'image' => 'https://images.unsplash.com/photo-1618366712010-f4ae9c647dcb?w=200&q=80',
                ]
            ],
            'total' => 4520000,
            'action' => 'Lacak Pesanan',
            'action_color' => 'border border-gray-200 text-gray-700',
        ],
        [
            'id' => 'INV-20260310-214',
            'status' => 'Selesai',
            'status_color' => 'text-green-600 bg-green-50',
            'date' => '10 Mar 2026',
            'store' => 'Samsung Official',
            'items' => [
                [
                    'name' => 'Samsung Galaxy S24',
                    'variant' => 'Phantom Black, 256 GB',
                    'price' => 13000000,
                    'qty' => 1,
                    'image' => 'https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?w=200&q=80',
                ],
                [
                    'name' => 'Galaxy Buds 2 Pro',
                    'variant' => 'Graphite',
                    'price' => 2500000,
                    'qty' => 1,
                    'image' => 'https://images.unsplash.com/photo-1603351154351-5e2d0600bb77?w=200&q=80', // using airpods image placeholder
                ]
            ],
            'total' => 15550000,
            'action' => 'Beli Lagi',
            'action_color' => 'border border-blue-600 text-blue-600',
        ],
    ];

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function getFilteredOrdersProperty(): array
    {
        if ($this->activeTab === 'Semua') {
            return $this->orders;
        }

        return array_filter($this->orders, fn($order) => $order['status'] === $this->activeTab);
    }
};
?>

<div class="min-h-dvh bg-gray-50 flex flex-col">

    {{-- Page Header --}}
    <livewire:page-header :title="'Pesanan Saya'" :backUrl="route('home')" />

    {{-- Tabs --}}
    <div class="bg-white sticky top-0 z-40 border-b border-gray-100">
        <div class="max-w-4xl mx-auto px-4">
            <div class="flex gap-4 overflow-x-auto scrollbar-none pb-[2px]">
                @foreach($tabs as $tab)
                    <button
                        wire:click="setTab('{{ $tab }}')"
                        class="whitespace-nowrap py-3.5 text-[14px] w-full font-semibold transition-colors border-b-2 relative -mb-[2px]
                               {{ $activeTab === $tab
                                  ? 'text-blue-600 border-blue-600'
                                  : 'text-gray-400 border-transparent hover:text-gray-600' }}"
                    >
                        {{ $tab }}
                    </button>
                @endforeach
            </div>
        </div>  
    </div>

    {{-- Page Content --}}
    <div class="flex-1 pb-28 max-w-4xl mx-auto w-full px-4 pt-4 space-y-4">

        @if(count($this->filteredOrders) === 0)
            {{-- Empty State --}}
            <div class="flex flex-col items-center justify-center py-20 text-center">
                <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                    <iconify-icon icon="solar:box-minimalistic-linear" class="text-gray-300 text-4xl"></iconify-icon>
                </div>
                <p class="text-gray-600 font-medium mb-1">Belum ada pesanan</p>
                <p class="text-sm text-gray-400">Pesanan dengan status ini tidak ditemukan.</p>
            </div>
        @else
            {{-- Order List --}}
            @foreach($this->filteredOrders as $order)
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                    {{-- Order Header --}}
                    <div class="px-4 py-3 flex items-center justify-between border-b border-gray-50">
                        <div class="flex items-center gap-2">
                            <iconify-icon icon="solar:shop-linear" class="text-gray-400"></iconify-icon>
                            <span class="text-[13px] font-bold text-gray-900">{{ $order['store'] }}</span>
                            <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                            <span class="text-[12px] text-gray-500">{{ $order['date'] }}</span>
                        </div>
                        <span class="text-[11px] font-semibold px-2.5 py-1 rounded-full {{ $order['status_color'] }}">
                            {{ $order['status'] }}
                        </span>
                    </div>

                    {{-- Order Items --}}
                    <div class="px-4 py-4 space-y-3">
                        @foreach($order['items'] as $item)
                            <div class="flex gap-3 items-start">
                                <img src="{{ $item['image'] }}" class="w-14 h-14 rounded-xl object-cover bg-gray-50 shrink-0" />
                                <div class="flex-1 min-w-0">
                                    <p class="text-[13px] font-semibold text-gray-900 leading-snug line-clamp-1">{{ $item['name'] }}</p>
                                    <p class="text-[11px] text-gray-400 mb-1.5">{{ $item['variant'] }}</p>
                                    <div class="flex items-center justify-between">
                                        <p class="text-[13px] font-bold text-gray-900">IDR {{ number_format($item['price'], 0, ',', '.') }}</p>
                                        <p class="text-[12px] text-gray-500">x{{ $item['qty'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Order Footer --}}
                    <div class="px-4 py-3 border-t border-gray-50 flex items-center justify-between bg-gray-50/50">
                        <div>
                            <p class="text-[11px] text-gray-500 mb-0.5">Total Belanja</p>
                            <p class="text-[14px] font-bold text-gray-900">IDR {{ number_format($order['total'], 0, ',', '.') }}</p>
                        </div>
                        <button class="px-5 py-2 rounded-full text-[13px] font-semibold transition-colors {{ $order['action_color'] }}">
                            {{ $order['action'] }}
                        </button>
                    </div>
                </div>
            @endforeach
        @endif

    </div>

    {{-- Bottom Navigation --}}
    <livewire:bottom-navigation :active="'orders'" />

</div>