<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new class extends Component
{
    public array $user = [
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'phone' => '+62 812 3456 7890',
        'avatar' => 'https://ui-avatars.com/api/?name=John+Doe&background=0D8ABC&color=fff&size=128'
    ];

    public function openStore()
    {
        // TODO: Redirect to store opening process or seller dashboard
    }

    public function logout()
    {
        // TODO: Implement logout logic
    }
};
?>

<div class="min-h-dvh bg-gray-50 flex flex-col">

    {{-- Page Header --}}
    <livewire:page-header :title="'Profil Saya'" :showMenu="false" />

    <div class="flex-1 pb-28 max-w-4xl mx-auto w-full px-4 pt-5 space-y-4">
        
        {{-- User Info Card --}}
        <div class="bg-white rounded-2xl p-4 flex items-center gap-4 border border-gray-100">
            <div class="relative shrink-0">
                <img src="{{ $user['avatar'] }}" alt="Avatar" class="w-16 h-16 rounded-full object-cover border-2 border-white shadow-sm" />
                <button class="absolute bottom-0 right-0 w-6 h-6 bg-blue-600 rounded-full text-white flex items-center justify-center border-2 border-white shadow-sm">
                    <iconify-icon icon="solar:pen-bold" width="12"></iconify-icon>
                </button>
            </div>
            <div class="flex-1 min-w-0">
                <h2 class="text-[17px] font-bold text-gray-900 truncate">{{ $user['name'] }}</h2>
                <div class="flex items-center gap-2 mt-0.5 text-[13px] text-gray-500">
                    <span class="truncate">{{ $user['email'] }}</span>
                    <span>•</span>
                    <span class="truncate text-gray-400">{{ $user['phone'] }}</span>
                </div>
                <div class="mt-1.5 inline-flex items-center gap-1 bg-green-50 text-green-700 font-semibold px-2 py-0.5 rounded text-[11px]">
                    <iconify-icon icon="solar:check-circle-bold" width="12"></iconify-icon>
                    Akun Terverifikasi
                </div>
            </div>
        </div>

        {{-- Buka Toko Banner (Seller CTA) --}}
        <div class="bg-blue-900 rounded-2xl p-5 text-white flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 overflow-hidden relative">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
            
            <div class="relative z-10 flex gap-3 items-center">
                <div class="shrink-0 w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center backdrop-blur-sm">
                    <iconify-icon icon="solar:shop-2-bold" width="28"></iconify-icon>
                </div>
                <div>
                    <h3 class="font-bold text-[16px]">Buka Toko Gratis!</h3>
                    <p class="text-[13px] text-blue-100 mt-0.5 leading-snug">Jangkau jutaan pembeli dan mulai bisnis kamu sekarang juga.</p>
                </div>
            </div>
            
            <button 
                wire:click="openStore" 
                class="relative z-10 whitespace-nowrap bg-white text-blue-900 font-bold px-5 py-2.5 rounded-xl text-[13px] hover:bg-blue-50 transition-colors shadow-sm w-full sm:w-auto mt-2 sm:mt-0"
            >
                Mulai Berjualan
            </button>
        </div>

        {{-- Pengaturan Akun --}}
        <div>
            <h3 class="text-[13px] font-semibold text-gray-500 mb-2 px-1 uppercase tracking-wider">Pengaturan Akun</h3>
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                
                {{-- Identitas --}}
                <button class="w-full flex items-center justify-between px-4 py-4 border-b border-gray-50 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <iconify-icon icon="solar:user-id-linear" class="text-gray-500" width="24"></iconify-icon>
                        <div class="text-left">
                            <p class="text-[14px] font-medium text-gray-900">Informasi Pribadi</p>
                            <p class="text-[12px] text-gray-400">Nama, Email, dan Identitas diri</p>
                        </div>
                    </div>
                    <iconify-icon icon="solar:alt-arrow-right-linear" class="text-gray-400" width="18"></iconify-icon>
                </button>

                {{-- Alamat --}}
                <button class="w-full flex items-center justify-between px-4 py-4 border-b border-gray-50 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <iconify-icon icon="solar:map-point-linear" class="text-gray-500" width="24"></iconify-icon>
                        <div class="text-left">
                            <p class="text-[14px] font-medium text-gray-900">Daftar Alamat</p>
                            <p class="text-[12px] text-gray-400">Atur lokasi pengiriman</p>
                        </div>
                    </div>
                    <iconify-icon icon="solar:alt-arrow-right-linear" class="text-gray-400" width="18"></iconify-icon>
                </button>

                {{-- Keamanan --}}
                <button class="w-full flex items-center justify-between px-4 py-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <iconify-icon icon="solar:shield-keyhole-linear" class="text-gray-500" width="24"></iconify-icon>
                        <div class="text-left">
                            <p class="text-[14px] font-medium text-gray-900">Keamanan Akun</p>
                            <p class="text-[12px] text-gray-400">Password & Autentikasi 2 Langkah</p>
                        </div>
                    </div>
                    <iconify-icon icon="solar:alt-arrow-right-linear" class="text-gray-400" width="18"></iconify-icon>
                </button>

            </div>
        </div>

        {{-- Pusat Bantuan & Lainnya --}}
        <div>
            <h3 class="text-[13px] font-semibold text-gray-500 mb-2 px-1 uppercase tracking-wider">Lainnya</h3>
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                
                {{-- Bantuan --}}
                <button class="w-full flex items-center justify-between px-4 py-3.5 border-b border-gray-50 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <iconify-icon icon="solar:question-circle-linear" class="text-gray-500" width="22"></iconify-icon>
                        <span class="text-[14px] font-medium text-gray-800">Pusat Bantuan</span>
                    </div>
                    <iconify-icon icon="solar:alt-arrow-right-linear" class="text-gray-400" width="18"></iconify-icon>
                </button>

                {{-- Kebijakan --}}
                <button class="w-full flex items-center justify-between px-4 py-3.5 border-b border-gray-50 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <iconify-icon icon="solar:document-text-linear" class="text-gray-500" width="22"></iconify-icon>
                        <span class="text-[14px] font-medium text-gray-800">Kebijakan Privasi</span>
                    </div>
                    <iconify-icon icon="solar:alt-arrow-right-linear" class="text-gray-400" width="18"></iconify-icon>
                </button>

                {{-- Logout --}}
                <button wire:click="logout" class="w-full flex items-center justify-between px-4 py-3.5 hover:bg-red-50 group transition-colors">
                    <div class="flex items-center gap-3">
                        <iconify-icon icon="solar:logout-2-linear" class="text-red-500" width="22"></iconify-icon>
                        <span class="text-[14px] font-bold text-red-500">Keluar</span>
                    </div>
                </button>

            </div>
        </div>

        <p class="text-center text-[12px] text-gray-400 pt-2">Marketplace App v1.0.0</p>

    </div>

    {{-- Bottom Navigation --}}
    <livewire:bottom-navigation :active="'profile'" />

</div>