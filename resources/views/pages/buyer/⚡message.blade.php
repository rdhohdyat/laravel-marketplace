<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new class extends Component
{
    public array $chats = [
        [
            'id' => 1,
            'store_name' => 'iBox Official',
            'store_avatar' => 'https://ui-avatars.com/api/?name=iBox&background=0D8ABC&color=fff&size=128',
            'is_official' => true,
            'last_message' => 'Halo kak, untuk iPhone 14 Pro Max 128GB warna Black ready stock ya. Silakan langsung diorder kak! Terima kasih ☺️.',
            'time' => '10:30',
            'unread' => 2,
            'is_online' => true,
        ],
        [
            'id' => 2,
            'store_name' => 'Samsung Center',
            'store_avatar' => 'https://ui-avatars.com/api/?name=Samsung+C&background=1E3A8A&color=fff&size=128',
            'is_official' => true,
            'last_message' => 'Pesanan kakak sudah kami proses dan akan dikickim hari ini ya kak. Resi akan update malam nanti.',
            'time' => 'Kemarin',
            'unread' => 0,
            'is_online' => false,
        ],
        [
            'id' => 3,
            'store_name' => 'Gadget Murah Jkt',
            'store_avatar' => 'https://ui-avatars.com/api/?name=GMJ&background=F59E0B&color=fff&size=128',
            'is_official' => false,
            'last_message' => 'Bisa kurang gak harganya gan? Kalo ambil 2 bisa nego gak?',
            'time' => 'Senin',
            'unread' => 0,
            'is_online' => true,
        ],
        [
            'id' => 4,
            'store_name' => 'Erafone',
            'store_avatar' => 'https://ui-avatars.com/api/?name=Erafone&background=EF4444&color=fff&size=128',
            'is_official' => true,
            'last_message' => 'Sama-sama kak, semoga produknya memuaskan! Jangan lupa ulasan bintang 5 nya ya kak.',
            'time' => '14 Mar',
            'unread' => 0,
            'is_online' => false,
        ],
    ];
};
?>

<div class="min-h-dvh bg-gray-50 flex flex-col">

    {{-- Page Header --}}
    <livewire:page-header :title="'Pesan'" :backUrl="route('home')" />

    {{-- Page Content --}}
    <div class="flex-1 pb-28 max-w-4xl mx-auto w-full px-4 pt-4">

        {{-- Search Bar --}}
        <div class="mb-4">
            <div class="relative">
                <iconify-icon icon="solar:magnifer-linear" class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400" width="18"></iconify-icon>
                <input 
                    type="text" 
                    placeholder="Cari pesan atau nama toko..." 
                    class="w-full bg-white border border-gray-200 rounded-full pl-10 pr-4 py-2.5 text-[13px] text-gray-900 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all placeholder:text-gray-400"
                />
            </div>
        </div>

        @if(count($chats) === 0)
            {{-- Empty State --}}
            <div class="flex flex-col items-center justify-center py-20 text-center">
                <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                    <iconify-icon icon="solar:chat-round-line-linear" class="text-gray-300 text-4xl"></iconify-icon>
                </div>
                <p class="text-gray-600 font-medium mb-1">Belum ada obrolan</p>
                <p class="text-[13px] text-gray-400 w-3/4 mx-auto">Anda belum pernah mengirim atau menerima pesan apa pun.</p>
                <a href="{{ route('home') }}" class="mt-5 bg-blue-600 text-white font-semibold text-[13px] px-6 py-2.5 rounded-full hover:bg-blue-700 transition">
                    Mulai Belanja
                </a>
            </div>
        @else
            {{-- Chat List --}}
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                @foreach($chats as $index => $chat)
                    <button class="w-full flex items-center gap-3 px-4 py-3.5 hover:bg-gray-50 transition-colors {{ !$loop->last ? 'border-b border-gray-50' : '' }}">
                        
                        {{-- Avatar --}}
                        <div class="relative shrink-0">
                            <img src="{{ $chat['store_avatar'] }}" alt="{{ $chat['store_name'] }}" class="w-12 h-12 rounded-full object-cover bg-gray-100 border border-gray-100" />
                            @if($chat['is_online'])
                                <span class="absolute bottom-0 right-0 w-3.5 h-3.5 bg-green-500 border-2 border-white rounded-full"></span>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="flex-1 min-w-0 text-left">
                            <div class="flex items-center justify-between mb-0.5">
                                <div class="flex items-center gap-1.5 min-w-0 pr-2">
                                    <h3 class="text-[14px] font-semibold text-gray-900 truncate">{{ $chat['store_name'] }}</h3>
                                    @if($chat['is_official'])
                                        <iconify-icon icon="solar:verified-check-bold" class="text-blue-500 shrink-0" width="14"></iconify-icon>
                                    @endif
                                </div>
                                <span class="text-[11px] font-medium {{ $chat['unread'] > 0 ? 'text-blue-600' : 'text-gray-400' }} shrink-0">
                                    {{ $chat['time'] }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between gap-3">
                                <p class="text-[13px] text-gray-500 truncate leading-snug {{ $chat['unread'] > 0 ? 'font-medium text-gray-800' : '' }}">
                                    {{ $chat['last_message'] }}
                                </p>
                                @if($chat['unread'] > 0)
                                    <div class="bg-blue-600 text-white text-[10px] font-bold min-w-[18px] h-[18px] rounded-full flex items-center justify-center px-1 shrink-0">
                                        {{ $chat['unread'] }}
                                    </div>
                                @endif
                            </div>
                        </div>

                    </button>
                @endforeach
            </div>
        @endif

    </div>

</div>