<?php

use Livewire\Component;

new class extends Component
{
    public string $search = '';

    public function updatedSearch(): void
    {
        $this->dispatch('search-updated', query: $this->search);
    }
};
?>

<div class="sticky top-0 z-50 bg-white border-b border-gray-100">
    <div class="max-w-4xl mx-auto w-full px-4 pt-3 pb-2">
        {{-- Row 1: Search + Icons --}}
        <div class="flex items-center gap-2.5 mb-2">
            <div class="flex-1 flex items-center gap-2 bg-gray-100 rounded-xl px-3 py-2">
                <iconify-icon icon="solar:magnifer-linear" class="text-gray-400 text-base shrink-0"></iconify-icon>
                <input
                    wire:model.live.debounce.400ms="search"
                    type="text"
                    placeholder="Cari produk..."
                    class="flex-1 bg-transparent text-sm text-gray-900 outline-none placeholder-gray-400 font-sans"
                />
            </div>
            <div class="flex items-center gap-1">
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
        <div class="flex items-center gap-1 text-sm text-gray-500">
            <iconify-icon icon="solar:map-point-bold" class="text-blue-600 text-sm"></iconify-icon>
            <span>Dikirim ke <strong class="text-gray-900 font-semibold">Plemahan, Surabaya</strong></span>
            <iconify-icon icon="solar:alt-arrow-down-linear" class="text-gray-400 text-sm"></iconify-icon>
        </div>
    </div>
</div>