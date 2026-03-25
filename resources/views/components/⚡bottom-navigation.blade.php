<?php

use Livewire\Component;

new class extends Component
{
    public string $active = 'home';

    public function mount(string $active = 'home'): void
    {
        $this->active = $active;
    }
};
?>

<div class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 flex items-center gap-2 bg-zinc-900 rounded-full px-3.5 py-2.5 shadow-2xl">
    <a wire:navigate href="{{ route('home') }}"
        class="flex items-center justify-center w-11 h-11 rounded-full transition-all duration-150
               {{ $active === 'home' ? 'bg-white text-zinc-900' : 'text-white/45 hover:text-white/80 hover:bg-white/10' }}">
        <iconify-icon icon="{{ $active === 'home' ? 'solar:home-2-bold' : 'solar:home-2-linear' }}" width="22"></iconify-icon>
    </a>
    <a wire:navigate href="{{ route('orders') }}"
        class="flex items-center justify-center w-11 h-11 rounded-full transition-all duration-150
               {{ $active === 'orders' ? 'bg-white text-zinc-900' : 'text-white/45 hover:text-white/80 hover:bg-white/10' }}">
        <iconify-icon icon="{{ $active === 'orders' ? 'solar:bookmark-bold' : 'solar:bookmark-linear' }}" width="22"></iconify-icon>
    </a>
    <a wire:navigate href="{{ route('wishlist') }}"
        class="flex items-center justify-center w-11 h-11 rounded-full transition-all duration-150
               {{ $active === 'wishlist' ? 'bg-white text-zinc-900' : 'text-white/45 hover:text-white/80 hover:bg-white/10' }}">
        <iconify-icon icon="{{ $active === 'wishlist' ? 'solar:heart-bold' : 'solar:heart-linear' }}" width="22"></iconify-icon>
    </a>
    <a wire:navigate href="{{ route('profile') }}"
        class="flex items-center justify-center w-11 h-11 rounded-full transition-all duration-150
               {{ $active === 'profile' ? 'bg-white text-zinc-900' : 'text-white/45 hover:text-white/80 hover:bg-white/10' }}">
        <iconify-icon icon="{{ $active === 'profile' ? 'solar:user-bold' : 'solar:user-linear' }}" width="22"></iconify-icon>
    </a>
</div>