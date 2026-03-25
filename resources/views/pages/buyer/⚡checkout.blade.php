<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new class extends Component
{
    public array $address = [
        'name' => 'John Doe',
        'phone' => '081234567890',
        'label' => 'Rumah',
        'street' => 'Jl. Kebon Jeruk Raya No. 12, RT 01/RW 02, Kebon Jeruk, Jakarta Barat, 11530',
        'is_primary' => true
    ];

    public array $stores = [
        [
            'id' => 1,
            'name' => 'iBox Official',
            'is_official' => true,
            'shipping_method' => 'Reguler (Estimasi 2-3 Hari)',
            'shipping_cost' => 25000,
            'items' => [
                [
                    'name'     => 'iPhone 14 Pro Max',
                    'variant'  => 'Black, 128 GB',
                    'price'    => 20000000,
                    'qty'      => 1,
                    'image'    => 'https://images.unsplash.com/photo-1695048133142-1a20484d2569?w=200&q=80',
                ]
            ]
        ]
    ];

    public string $voucherCode = '';
    public bool $voucherApplied = false;
    public float $voucherDiscount = 0.0;
    public int $discountAmount = 0;

    public string $paymentMethod = 'BCA Virtual Account';

    public function applyVoucher(): void
    {
        if (strtoupper($this->voucherCode) === 'DISKON10') {
            $this->voucherApplied = true;
            $this->voucherDiscount = 0.10;
        } else {
            $this->voucherApplied = false;
            $this->voucherDiscount = 0;
            $this->addError('voucherCode', 'Kode voucher tidak valid.');
        }
    }

    public function getSubTotalProperty(): int
    {
        $total = 0;
        foreach ($this->stores as $store) {
            foreach ($store['items'] as $item) {
                $total += $item['price'] * $item['qty'];
            }
        }
        return $total;
    }

    public function getShippingTotalProperty(): int
    {
        $total = 0;
        foreach ($this->stores as $store) {
            $total += $store['shipping_cost'];
        }
        return $total;
    }

    public function getTotalProperty(): int
    {
        $this->discountAmount = $this->voucherApplied ? (int)($this->subTotal * $this->voucherDiscount) : 0;
        return $this->subTotal + $this->shippingTotal - $this->discountAmount;
    }

    public function placeOrder()
    {
        // Logika menyimpan order ke database ditaruh di sini
        // Redirect ke halaman pembayaran atau sukses
    }
};
?>

<div class="min-h-dvh bg-gray-50 flex flex-col">

    {{-- Page Header --}}
    <livewire:page-header :title="'Checkout'" :backUrl="route('cart')" />

    <div class="flex-1 pb-32 max-w-4xl mx-auto w-full px-4 pt-4 space-y-4">

        {{-- Alamat Pengiriman --}}
        <div>
            <h3 class="text-[13px] font-semibold text-gray-500 mb-2 px-1 uppercase tracking-wider">Alamat Pengiriman</h3>
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                <button class="w-full relative px-4 py-4 text-left hover:bg-gray-50 transition-colors flex gap-3 items-start">
                    <iconify-icon icon="solar:map-point-linear" class="text-blue-600 shrink-0 mt-0.5" width="22"></iconify-icon>
                    
                    <div class="flex-1 min-w-0 pr-6">
                        <div class="flex items-center gap-2 mb-1">
                            <h4 class="text-[14px] font-bold text-gray-900 leading-none">{{ $address['label'] }}</h4>
                            @if($address['is_primary'])
                                <span class="bg-gray-100 text-gray-600 text-[10px] font-bold px-1.5 py-0.5 rounded leading-none">Utama</span>
                            @endif
                        </div>
                        <p class="text-[14px] font-semibold text-gray-900 mb-1">{{ $address['name'] }} <span class="text-gray-400 font-normal">| {{ $address['phone'] }}</span></p>
                        <p class="text-[13px] text-gray-500 leading-relaxed">{{ $address['street'] }}</p>
                    </div>

                    <iconify-icon icon="solar:alt-arrow-right-linear" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400" width="18"></iconify-icon>
                </button>
            </div>
        </div>

        {{-- Daftar Barang --}}
        <div>
            <h3 class="text-[13px] font-semibold text-gray-500 mb-2 px-1 uppercase tracking-wider">Detail Pesanan</h3>
            
            @foreach($stores as $store)
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden mb-4 last:mb-0">
                
                {{-- Store Header --}}
                <div class="px-4 py-3 border-b border-gray-50 flex items-center gap-2 bg-gray-50/50">
                    <iconify-icon icon="solar:shop-linear" class="text-gray-500"></iconify-icon>
                    <h3 class="text-[13px] font-bold text-gray-900">{{ $store['name'] }}</h3>
                    @if($store['is_official'])
                        <iconify-icon icon="solar:verified-check-bold" class="text-blue-500" width="14"></iconify-icon>
                    @endif
                </div>

                {{-- Items --}}
                <div class="divide-y divide-gray-50">
                    @foreach($store['items'] as $item)
                        <div class="p-4 flex gap-3">
                            <img src="{{ $item['image'] }}" class="w-14 h-14 rounded-xl object-cover border border-gray-100 shrink-0 bg-gray-50" />
                            <div class="flex-1 min-w-0">
                                <p class="text-[13px] font-medium text-gray-900 leading-snug line-clamp-2 mb-1">{{ $item['name'] }}</p>
                                <div class="flex items-center justify-between mt-1">
                                    <p class="text-[11px] text-gray-500 bg-gray-50 px-1 rounded">{{ $item['variant'] }}</p>
                                    <p class="text-[12px] text-gray-500">x{{ $item['qty'] }}</p>
                                </div>
                                <p class="text-[14px] font-bold text-gray-900 mt-1">IDR {{ number_format($item['price'], 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Shipping Method --}}
                <div class="p-4 border-t border-gray-50">
                    <p class="text-[12px] font-semibold text-gray-600 mb-2">Opsi Pengiriman</p>
                    <button class="w-full flex items-center justify-between border border-gray-200 rounded-xl px-3 py-3 hover:border-blue-500 hover:bg-blue-50/50 transition-colors">
                        <div class="text-left">
                            <h5 class="text-[13px] font-bold text-gray-900">{{ $store['shipping_method'] }}</h5>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-[13px] font-semibold text-gray-900">IDR {{ number_format($store['shipping_cost'], 0, ',', '.') }}</span>
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="text-gray-400" width="16"></iconify-icon>
                        </div>
                    </button>
                    
                    {{-- Pesan (Note) --}}
                    <div class="mt-3 flex items-center gap-2 border-b border-gray-200 focus-within:border-blue-500 pb-1">
                        <iconify-icon icon="solar:pen-linear" class="text-gray-400" width="16"></iconify-icon>
                        <input type="text" placeholder="Tinggalkan pesan untuk penjual (opsional)..." class="flex-1 bg-transparent text-[13px] focus:outline-none placeholder:text-gray-400">
                    </div>
                </div>

            </div>
            @endforeach
        </div>

        {{-- Metode Pembayaran --}}
        <div>
            <h3 class="text-[13px] font-semibold text-gray-500 mb-2 px-1 uppercase tracking-wider">Pembayaran</h3>
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                <button class="w-full px-4 py-4 hover:bg-gray-50 transition-colors flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center text-blue-600 shrink-0">
                            <iconify-icon icon="solar:card-2-bold" width="18"></iconify-icon>
                        </div>
                        <div class="text-left leading-none">
                            <p class="text-[14px] font-bold text-gray-900">{{ $paymentMethod }}</p>
                        </div>
                    </div>
                    <iconify-icon icon="solar:alt-arrow-right-linear" class="text-gray-400" width="18"></iconify-icon>
                </button>

                {{-- Voucher Promo --}}
                <div class="px-4 py-4 border-t border-gray-50">
                    <div class="flex items-center gap-2 border {{ $voucherApplied ? 'border-green-500 bg-green-50/30' : 'border-gray-200' }} rounded-xl px-3 py-2.5 transition-colors">
                        <iconify-icon icon="solar:ticket-sale-linear" class="{{ $voucherApplied ? 'text-green-600' : 'text-gray-400' }}" width="18"></iconify-icon>
                        <input
                            wire:model="voucherCode"
                            type="text"
                            class="flex-1 bg-transparent text-[13px] font-semibold uppercase tracking-wider outline-none text-gray-900 placeholder:normal-case placeholder:tracking-normal placeholder:font-normal"
                            placeholder="Makin hemat pakai promo..."
                        />
                        @if($voucherApplied)
                            <iconify-icon icon="solar:check-circle-bold" class="text-green-600 shrink-0" width="20"></iconify-icon>
                        @else
                            <button wire:click="applyVoucher"
                                class="text-[12px] font-semibold text-blue-600 hover:text-blue-700 shrink-0">
                                Gunakan
                            </button>
                        @endif
                    </div>
                    @error('voucherCode') <p class="text-[11px] text-red-500 mt-1 ml-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Ringkasan Pembayaran --}}
        <div>
            <h3 class="text-[13px] font-semibold text-gray-500 mb-2 px-1 uppercase tracking-wider">Ringkasan Pembayaran</h3>
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden px-4 py-4 space-y-3">
                
                <div class="flex items-center justify-between text-[13px] text-gray-600">
                    <span>Subtotal Produk</span>
                    <span class="font-medium text-gray-900">IDR {{ number_format($this->subTotal, 0, ',', '.') }}</span>
                </div>
                
                <div class="flex items-center justify-between text-[13px] text-gray-600">
                    <span>Subtotal Pengiriman</span>
                    <span class="font-medium text-gray-900">IDR {{ number_format($this->shippingTotal, 0, ',', '.') }}</span>
                </div>

                @if($voucherApplied)
                    <div class="flex items-center justify-between text-[13px]">
                        <span class="text-gray-600 flex items-center gap-1">Diskon Promo <iconify-icon icon="solar:ticket-sale-linear" class="text-green-500" width="14"></iconify-icon></span>
                        <span class="font-semibold text-green-500">- IDR {{ number_format($this->discountAmount, 0, ',', '.') }}</span>
                    </div>
                @endif
                
                <div class="pt-3 border-t border-dashed border-gray-200 flex items-center justify-between">
                    <span class="text-[14px] font-bold text-gray-900">Cetak Tagihan</span>
                    <span class="text-[17px] font-black text-blue-600">IDR {{ number_format($this->total, 0, ',', '.') }}</span>
                </div>

            </div>
        </div>

    </div>

    {{-- Bottom Checkout Action --}}
    <div class="fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-gray-200 pb-safe">
        <div class="max-w-4xl mx-auto px-4 py-3 flex items-center justify-between">
            <div>
                <p class="text-[11px] text-gray-500 font-medium">Total Pembayaran</p>
                <p class="text-[17px] font-bold text-blue-600 tracking-tight">IDR {{ number_format($this->total, 0, ',', '.') }}</p>
            </div>
            
            <button 
                wire:click="placeOrder" 
                class="bg-blue-600 text-white font-semibold py-3 px-6 rounded-2xl hover:bg-blue-700 transition-colors flex items-center justify-center gap-2 text-[14px]"
            >
                Buat Pesanan
            </button>
        </div>
    </div>

</div>