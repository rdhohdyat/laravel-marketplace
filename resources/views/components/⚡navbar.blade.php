<?php

use Livewire\Component;

new class extends Component
{
    public string $search = '';
    
    public string $activeLocation = 'Plemahan, Surabaya';
    
    public array $locations = [
        ['id' => 1, 'name' => 'Plemahan, Surabaya', 'label' => 'Rumah', 'detail' => 'Jl. Pahlawan No. 45, Komplek Permai'],
        ['id' => 2, 'name' => 'Kebayoran, Jakarta', 'label' => 'Kantor', 'detail' => 'Gedung Karya Lt. 12, Sudirman'],
        ['id' => 3, 'name' => 'Gubeng, Surabaya', 'label' => 'Rumah Nenek', 'detail' => 'Jl. Gubeng Kertajaya No. 8'],
    ];

    public array $suggestions = [];
    public array $allProducts = [
        ['name' => 'iPhone 14 Pro Max', 'category' => 'Smartphone'],
        ['name' => 'MacBook Air M2', 'category' => 'Laptop'],
        ['name' => 'Apple Watch Series 8', 'category' => 'Smartwatch'],
        ['name' => 'AirPods Pro 2nd Gen', 'category' => 'Audio'],
        ['name' => 'Sony WH-1000XM5', 'category' => 'Audio'],
        ['name' => 'Samsung Galaxy S23 Ultra', 'category' => 'Smartphone'],
        ['name' => 'TWS Bluetooth Earbuds', 'category' => 'Audio'],
        ['name' => 'Mechanical Keyboard Wireless', 'category' => 'Accessories']
    ];

    public function updatedSearch(): void
    {
        if (strlen($this->search) > 0) {
            $this->suggestions = array_filter($this->allProducts, function($product) {
                return stripos($product['name'], $this->search) !== false;
            });
        } else {
            $this->suggestions = [];
        }
        $this->dispatch('search-updated', query: $this->search);
    }

    public function setLocation(string $locName): void
    {
        $this->activeLocation = $locName;
    }
};
?>

<div class="sticky top-0 z-60 bg-white border-b border-gray-100" x-data="{ openLocationModal: false }">
    <div class="max-w-4xl mx-auto w-full px-4 pt-3 pb-2">
        {{-- Row 1: Search + Icons --}}
        <div class="flex items-center gap-2.5 mb-2 relative">
            
            <div class="flex-1 relative" x-data="{ showDropdown: false }" @click.away="showDropdown = false">
                <div class="flex items-center gap-2 bg-gray-100 rounded-xl px-3 py-2 border border-transparent focus-within:border-blue-500 focus-within:bg-white transition-colors">
                    <iconify-icon icon="solar:magnifer-linear" class="text-gray-400 text-base shrink-0"></iconify-icon>
                    <input
                        wire:model.live.debounce.300ms="search"
                        @focus="showDropdown = true"
                        type="text"
                        placeholder="Cari produk..."
                        class="flex-1 bg-transparent text-sm text-gray-900 outline-none placeholder-gray-400 font-sans w-full"
                    />
                </div>

                {{-- Autocomplete Dropdown --}}
                @if(strlen($search) > 0)
                <div x-show="showDropdown" x-transition.opacity class="absolute top-full left-0 right-0 mt-2 bg-white rounded-2xl shadow-xl lg:shadow-md border border-gray-100 overflow-hidden z-100 py-2 max-h-60 overflow-y-auto">
                    @forelse($suggestions as $item)
                        <a wire:navigate href="{{ route('products') }}?q={{ urlencode($item['name']) }}" class="flex flex-col px-4 py-2 hover:bg-gray-50 transition-colors border-b border-gray-50 last:border-none">
                            <div class="flex items-center justify-between">
                                <p class="text-[13px] font-semibold text-gray-900 truncate pr-3">{{ $item['name'] }}</p>
                                <iconify-icon icon="solar:arrow-right-up-linear" class="text-gray-400 shrink-0"></iconify-icon>
                            </div>
                            <span class="text-[11px] font-medium text-gray-400">{{ $item['category'] }}</span>
                        </a>
                    @empty
                        <div class="px-4 py-4 flex flex-col items-center justify-center text-center">
                            <iconify-icon icon="solar:ghost-smile-linear" class="text-gray-300 text-3xl mb-1"></iconify-icon>
                            <p class="text-[12px] font-medium text-gray-500">Pencarian "<strong class="text-gray-900">{{ $search }}</strong>" tidak ditemukan.</p>
                        </div>
                    @endforelse
                </div>
                @endif
            </div>

            <div class="flex items-center gap-1 shrink-0">
                <a wire:navigate href="{{ route('cart') }}" class="relative flex items-center justify-center w-10 h-10 rounded-xl text-gray-800 hover:bg-gray-100 transition-colors">
                    <iconify-icon icon="solar:cart-large-minimalistic-linear" width="22"></iconify-icon>
                    <span class="absolute top-1 right-1 bg-red-500 text-white text-[9px] font-semibold min-w-[15px] h-[15px] rounded-full flex items-center justify-center px-0.5">3</span>
                </a>
                <a wire:navigate href="{{ route('message') }}" class="relative flex items-center justify-center w-10 h-10 rounded-xl text-gray-800 hover:bg-gray-100 transition-colors">
                    <iconify-icon icon="solar:bell-linear" width="22"></iconify-icon>
                    <span class="absolute top-1 right-1 bg-red-500 text-white text-[9px] font-semibold min-w-[15px] h-[15px] rounded-full flex items-center justify-center px-0.5">5</span>
                </a>
            </div>
        </div>

        {{-- Row 2: Location --}}
        <button @click="openLocationModal = true" class="flex items-center gap-1 text-sm text-gray-500 hover:text-gray-700 transition-colors w-full text-left">
            <iconify-icon icon="solar:map-point-bold" class="text-blue-600 text-sm shrink-0"></iconify-icon>
            <span class="truncate">Dikirim ke <strong class="text-gray-900 font-semibold">{{ $activeLocation }}</strong></span>
            <iconify-icon icon="solar:alt-arrow-down-linear" class="text-gray-400 text-sm shrink-0"></iconify-icon>
        </button>
    </div>

    {{-- Location Modal --}}
    <div x-show="openLocationModal" x-cloak class="relative z-100" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
        <div x-show="openLocationModal" 
             x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" 
             x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" 
             class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center text-center sm:items-center sm:p-0">
                <div x-show="openLocationModal" @click.away="openLocationModal = false"
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-full sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-full sm:translate-y-0 sm:scale-95" 
                     class="relative transform overflow-hidden bg-white text-left shadow-xl transition-all w-full max-w-4xl mx-auto rounded-t-3xl sm:rounded-2xl sm:my-8 flex flex-col max-h-[85vh]">
                    
                    {{-- Modal Header --}}
                    <div class="px-4 py-4 border-b border-gray-100 flex items-center justify-between bg-white shrink-0">
                        <h3 class="text-[16px] font-bold text-gray-900" id="modal-title">Pilih Lokasi Pengiriman</h3>
                        <button @click="openLocationModal = false" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors">
                            <iconify-icon icon="solar:close-circle-bold" width="22"></iconify-icon>
                        </button>
                    </div>

                    {{-- Modal Body --}}
                    <div class="p-4 overflow-y-auto flex-1 bg-gray-50/50">
                        <div class="space-y-3">
                            <button class="w-full bg-blue-50/50 border border-blue-200 border-dashed rounded-xl px-4 py-3 text-blue-600 font-semibold text-[13px] hover:bg-blue-50 hover:border-blue-400 transition-colors flex items-center justify-center gap-2">
                                <iconify-icon icon="solar:add-circle-bold" width="18"></iconify-icon> Tambah Alamat Baru
                            </button>

                            @foreach($locations as $loc)
                                <button 
                                    wire:click="setLocation('{{ $loc['name'] }}'); openLocationModal = false"
                                    class="w-full text-left bg-white rounded-xl border {{ $activeLocation === $loc['name'] ? 'border-blue-500 ring-1 ring-blue-500' : 'border-gray-100' }} p-3.5 hover:border-gray-300 transition-all flex items-start gap-3"
                                >
                                    <div class="mt-0.5 text-{{ $activeLocation === $loc['name'] ? 'blue-600' : 'gray-400' }}">
                                        <iconify-icon icon="solar:map-point-bold" width="22"></iconify-icon>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 mb-0.5">
                                            <span class="text-[13px] font-bold text-gray-900">{{ $loc['label'] }}</span>
                                            @if($loop->first)
                                                <span class="text-[10px] bg-gray-100 text-gray-600 font-bold px-1.5 py-0.5 rounded">Utama</span>
                                            @endif
                                        </div>
                                        <h4 class="text-[14px] font-semibold text-gray-800">{{ $loc['name'] }}</h4>
                                        <p class="text-[12px] text-gray-500 leading-snug mt-1">{{ $loc['detail'] }}</p>
                                    </div>
                                    @if($activeLocation === $loc['name'])
                                        <iconify-icon icon="solar:check-circle-bold" class="text-blue-600 shrink-0" width="20"></iconify-icon>
                                    @endif
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>