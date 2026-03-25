<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new class extends Component
{
    public array $stores = [
        [
            'id' => 1,
            'name' => 'iBox Official',
            'is_official' => true,
            'selected' => true,
            'items' => [
                [
                    'id'       => 1,
                    'name'     => 'iPhone 14 Pro Max',
                    'variant'  => 'Black, 128 GB',
                    'price'    => 20000000,
                    'qty'      => 1,
                    'image'    => 'https://images.unsplash.com/photo-1695048133142-1a20484d2569?w=200&q=80',
                    'selected' => true,
                ],
                [
                    'id'       => 2,
                    'name'     => 'AirPods 3rd Generation',
                    'variant'  => 'White',
                    'price'    => 5000000,
                    'qty'      => 2,
                    'image'    => 'https://images.unsplash.com/photo-1603351154351-5e2d0600bb77?w=200&q=80',
                    'selected' => true,
                ]
            ]
        ],
        [
            'id' => 2,
            'name' => 'Sony Center',
            'is_official' => true,
            'selected' => false,
            'items' => [
                [
                    'id'       => 3,
                    'name'     => 'Sony WH-1000XM5',
                    'variant'  => 'Black',
                    'price'    => 4500000,
                    'qty'      => 1,
                    'image'    => 'https://images.unsplash.com/photo-1618366712010-f4ae9c647dcb?w=200&q=80',
                    'selected' => false,
                ]
            ]
        ]
    ];

    public bool $selectAll = false;

    public function mount()
    {
        $this->checkSelectAllStatus();
    }

    public function toggleSelectAll()
    {
        $this->selectAll = !$this->selectAll;
        
        foreach ($this->stores as &$store) {
            $store['selected'] = $this->selectAll;
            foreach ($store['items'] as &$item) {
                $item['selected'] = $this->selectAll;
            }
        }
    }

    public function toggleStore(int $storeIndex)
    {
        $this->stores[$storeIndex]['selected'] = !$this->stores[$storeIndex]['selected'];
        $newStatus = $this->stores[$storeIndex]['selected'];
        
        foreach ($this->stores[$storeIndex]['items'] as &$item) {
            $item['selected'] = $newStatus;
        }

        $this->checkSelectAllStatus();
    }

    public function toggleItem(int $storeIndex, int $itemIndex)
    {
        $this->stores[$storeIndex]['items'][$itemIndex]['selected'] = !$this->stores[$storeIndex]['items'][$itemIndex]['selected'];
        
        // Update store checkbox status based on its items
        $allStoreItemsSelected = true;
        foreach ($this->stores[$storeIndex]['items'] as $item) {
            if (!$item['selected']) {
                $allStoreItemsSelected = false;
                break;
            }
        }
        $this->stores[$storeIndex]['selected'] = $allStoreItemsSelected;

        $this->checkSelectAllStatus();
    }

    public function checkSelectAllStatus()
    {
        $allStoresSelected = true;
        foreach ($this->stores as $store) {
            if (!$store['selected']) {
                $allStoresSelected = false;
                break;
            }
        }
        $this->selectAll = $allStoresSelected;
    }

    public function increaseQty(int $storeIndex, int $itemIndex): void
    {
        $this->stores[$storeIndex]['items'][$itemIndex]['qty']++;
    }

    public function decreaseQty(int $storeIndex, int $itemIndex): void
    {
        if ($this->stores[$storeIndex]['items'][$itemIndex]['qty'] > 1) {
            $this->stores[$storeIndex]['items'][$itemIndex]['qty']--;
        } else {
            // Remove item
            array_splice($this->stores[$storeIndex]['items'], $itemIndex, 1);
            
            // Remove store if empty
            if (count($this->stores[$storeIndex]['items']) === 0) {
                array_splice($this->stores, $storeIndex, 1);
            }
        }
    }

    public function removeItem(int $storeIndex, int $itemIndex): void
    {
        array_splice($this->stores[$storeIndex]['items'], $itemIndex, 1);
        if (count($this->stores[$storeIndex]['items']) === 0) {
            array_splice($this->stores, $storeIndex, 1);
        }
    }

    public function getSelectedItemsCountProperty(): int
    {
        $count = 0;
        foreach ($this->stores as $store) {
            foreach ($store['items'] as $item) {
                if ($item['selected']) {
                    $count++;
                }
            }
        }
        return $count;
    }

    public function getSubTotalProperty(): int
    {
        $total = 0;
        foreach ($this->stores as $store) {
            foreach ($store['items'] as $item) {
                if ($item['selected']) {
                    $total += $item['price'] * $item['qty'];
                }
            }
        }
        return $total;
    }
};
?>

<div class="min-h-dvh bg-gray-50 flex flex-col">

    {{-- Page Header --}}
    <livewire:page-header :title="'Keranjang Saya'" :backUrl="route('home')" />

    <div class="flex-1 pb-32 max-w-4xl mx-auto w-full px-4 pt-4 space-y-4">

        {{-- Select All Bar --}}
        @if(count($stores) > 0)
        <div class="bg-white rounded-2xl border border-gray-100 flex items-center justify-between px-4 py-3.5">
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" wire:model="selectAll" wire:change="toggleSelectAll" class="w-[14px] h-[14px] rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <span class="text-[14px] font-semibold text-gray-900">Pilih Semua</span>
            </label>
        </div>
        @endif

        @if(count($stores) === 0)
            <div class="flex flex-col items-center justify-center py-20 text-center">
                <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                    <iconify-icon icon="solar:cart-large-linear" class="text-gray-300 text-4xl"></iconify-icon>
                </div>
                <p class="text-gray-600 font-medium mb-1">Keranjang masih kosong</p>
                <p class="text-sm text-gray-400">Pilih produk favorit Anda terlebih dahulu.</p>
                <a wire:navigate href="{{ route('home') }}" class="mt-5 bg-blue-600 text-white font-semibold text-[13px] px-6 py-2.5 rounded-full hover:bg-blue-700 transition">
                    Mulai Belanja
                </a>
            </div>
        @else
            {{-- Stores --}}
            @foreach($stores as $storeIndex => $store)
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                
                {{-- Store Header --}}
                <div class="px-4 py-3.5 border-b border-gray-50 flex items-center gap-3 bg-gray-50/50">
                    <input type="checkbox" wire:click="toggleStore({{ $storeIndex }})" @checked($store['selected']) class="w-[14px] h-[14px] rounded border-gray-300 text-blue-600 focus:ring-blue-500 shrink-0">
                    <div class="flex items-center gap-2">
                        <iconify-icon icon="solar:shop-linear" class="text-gray-500"></iconify-icon>
                        <h3 class="text-[14px] font-bold text-gray-900">{{ $store['name'] }}</h3>
                        @if($store['is_official'])
                            <iconify-icon icon="solar:verified-check-bold" class="text-blue-500" width="14"></iconify-icon>
                        @endif
                    </div>
                </div>

                {{-- Cart Items --}}
                <div class="divide-y divide-gray-50">
                    @foreach($store['items'] as $itemIndex => $item)
                        <div class="p-4 flex gap-3">
                            {{-- Checkbox --}}
                            <div class="pt-5 shrink-0">
                                <input type="checkbox" wire:click="toggleItem({{ $storeIndex }}, {{ $itemIndex }})" @checked($item['selected']) class="w-[14px] h-[14px] rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            </div>

                            {{-- Image --}}
                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-16 h-16 rounded-xl object-cover border border-gray-100 shrink-0 bg-gray-50" />

                            {{-- Info --}}
                            <div class="flex-1 min-w-0 flex flex-col justify-between">
                                <div class="pr-6 relative">
                                    <p class="text-[13px] text-gray-900 leading-snug line-clamp-2 {{ $item['selected'] ? 'font-semibold' : 'font-medium' }}">{{ $item['name'] }}</p>
                                    @if($item['variant'])
                                        <p class="text-[11px] text-gray-500 mt-1 bg-gray-50 inline-block px-2 py-0.5 rounded">{{ $item['variant'] }}</p>
                                    @endif
                                </div>
                                <div class="flex items-end justify-between mt-2">
                                    <span class="text-[14px] font-bold text-gray-900">IDR {{ number_format($item['price'], 0, ',', '.') }}</span>
                                    
                                    {{-- Actions --}}
                                    <div class="flex items-center gap-2">
                                        <button wire:click="removeItem({{ $storeIndex }}, {{ $itemIndex }})" class="w-7 h-7 flex items-center justify-center text-gray-300 hover:text-red-500 transition-colors">
                                            <iconify-icon icon="solar:trash-bin-minimalistic-linear" width="16"></iconify-icon>
                                        </button>
                                        
                                        <div class="flex items-center gap-1.5">
                                            <button wire:click="decreaseQty({{ $storeIndex }}, {{ $itemIndex }})" class="w-7 h-7 flex items-center justify-center rounded-full border border-gray-200 text-blue-600 hover:bg-blue-50 transition-colors">
                                                <iconify-icon icon="solar:minus-circle-linear" width="18"></iconify-icon>
                                            </button>
                                            <span class="text-[13px] font-semibold text-gray-900 min-w-[20px] text-center">{{ $item['qty'] }}</span>
                                            <button wire:click="increaseQty({{ $storeIndex }}, {{ $itemIndex }})" class="w-7 h-7 flex items-center justify-center rounded-full bg-blue-600 text-white hover:bg-blue-700 transition-colors">
                                                <iconify-icon icon="solar:add-circle-linear" width="18"></iconify-icon>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endforeach

        @endif
    </div>

    {{-- Bottom Checkout Bar --}}
    @if(count($stores) > 0)
    <div class="fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-gray-200 pb-safe">
        <div class="max-w-4xl mx-auto px-4 py-3 flex items-center justify-between">
            <div>
                <p class="text-[11px] text-gray-500 font-medium">Total Harga</p>
                <p class="text-[17px] font-bold text-gray-900 tracking-tight">IDR {{ number_format($this->subTotal, 0, ',', '.') }}</p>
            </div>
            
            <a 
                href="{{ $this->selectedItemsCount > 0 ? route('checkout') : '#' }}" 
                class="bg-blue-600 text-white font-semibold py-3 px-6 rounded-2xl hover:bg-blue-700 transition-colors flex items-center justify-center gap-2 text-[14px] {{ $this->selectedItemsCount === 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
            >
                Checkout ({{ $this->selectedItemsCount }})
            </a>
        </div>
    </div>
    @endif

</div>