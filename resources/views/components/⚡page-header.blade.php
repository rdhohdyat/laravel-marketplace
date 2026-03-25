<?php

use Livewire\Component;

new class extends Component
{
    public string $title = '';
    public string $backUrl = '';
    public bool $showMenu = true;
};
?>

<div class="sticky top-0 z-50 bg-white border-b border-gray-100">
    <div class="max-w-4xl mx-auto flex items-center justify-between px-4 py-3">
        {{-- Back Button --}}
        @if($backUrl)
            <a wire:navigate href="{{ $backUrl }}"
               class="w-9 h-9 flex items-center justify-center rounded-xl text-gray-700 hover:bg-gray-100 transition-colors">
                <iconify-icon icon="solar:alt-arrow-left-linear" width="22"></iconify-icon>
            </a>
        @else
            <a href="javascript:history.back()"
               class="w-9 h-9 flex items-center justify-center rounded-xl text-gray-700 hover:bg-gray-100 transition-colors">
                <iconify-icon icon="solar:alt-arrow-left-linear" width="22"></iconify-icon>
            </a>
        @endif

        {{-- Title --}}
        <span class="text-[15px] font-semibold text-gray-900">{{ $title }}</span>

        {{-- Menu / Placeholder --}}
        @if($showMenu)
            <a wire:navigate href="{{ route('profile') }}" class="w-9 h-9 flex items-center justify-center rounded-xl text-gray-700 hover:bg-gray-100 transition-colors">
                <iconify-icon icon="solar:menu-dots-bold" width="22"></iconify-icon>
            </a>
        @else
            <div class="w-9 h-9"></div>
        @endif
    </div>
</div>
