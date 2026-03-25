# 🛒 Laravel Marketplace

Sebuah aplikasi web marketplace modern yang *mobile-first* (berorientasi pada perangkat seluler) dibangun menggunakan Laravel dan Livewire. Proyek ini berfokus pada penyampaian pengalaman berbelanja yang sangat interaktif, tanpa jeda (SPA-like), dengan desain yang estetis layaknya ekosistem aplikasi iOS modern. Semua ini dibangun di atas fondasi TALL stack terbaru (Tailwind CSS v4, Alpine, Laravel, dan Livewire 4).

## ✨ Fitur-Fitur (Antarmuka Pembeli)

Saat ini, antarmuka pembeli (Buyer UI) telah dirancang sepenuhnya secara fungsional menggunakan komponen Livewire:

- **🏠 Beranda & Penelusuran**: *Hero banner* dinamis, tab kategori produk, dan hitung mundur Flash Sale secara *real-time*.
- **❤️ Wishlist (Favorit)**: Tata letak kotak responsif untuk menyimpan produk incaran, lengkap dengan indikasi "Stok Habis" yang menawan.
- **🛒 Keranjang Pintar (Smart Cart)**: Pengelompokan barang berdasarkan toko (penjual), multi-pilih (fitur "Pilih Semua"), modifikasi kuantitas, serta perhitungan subtotal dinamis.
- **💳 Alur Checkout Interaktif**: Mengelola lokasi pengiriman, memilih kurir berbasis toko, meninjau rincian biaya, memvalidasi kupon diskon (Voucher) secara *real-time*, dan sistem metode pembayaran.
- **📦 Pelacakan Pesanan**: Menggunakan *tabs* bersih untuk melacak status (Belum Bayar, Dikemas, Dikirim, Selesai) per toko masing-masing.
- **💬 Pesan (Chat)**: Fitur antarmuka kotak masuk yang rapi untuk percakapan langsung antara pembaca dan penjual resmi.
- **👤 Profil Pengguna**: Manajemen informasi pribadi, alamat, keamanan akun, serta spanduk promosi modern (Call-To-Action) untuk "Mulai Berjualan" (Buka Toko).
- **📱 Desain Mobile-First Solid**: Menjaga estetika aplikasi *native* dengan ukuran maksimal `max-w-4xl`, serta navigasi bawah (*bottom navigation bar*) yang tetap tersemat (sticky/fixed) di semua ukuran layar.

## 🚀 Teknologi yang Digunakan (Tech Stack)

- **Framework**: [Laravel](https://laravel.com/) (v11/v12)
- **Frontend Interaktivitas**: [Livewire 4](https://livewire.laravel.com/) (Menggunakan pendekatan *Single-File Components*)
- **Dressing & Styling**: [Tailwind CSS v4](https://tailwindcss.com/)
- **Ikonografi**: [Iconify](https://iconify.design/) (Spesifik set ikon *Solar* untuk kesan membulat, modern, dan minimalis)

## 📁 Struktur Proyek (Sorotan)

Logika tampilan frontend kami sebagian besar berkonsentrasi pada pendekatan komponen Livewire tunggal (PHP Logic + Blade bergabung) demi kemudahan pemeliharaan:

- `resources/views/pages/buyer/`: Memuat seluruh rute navigasi pembeli seperti `home`, `cart`, `checkout`, `wishlist`, `orders`, `profile`, dan `message`.
- `resources/views/components/`: Kumpulan elemen UI generik berbasis Blade (cth: `page-header` & navigasi global).
- `routes/web.php`: Seluruh *routing* utama didefinisikan secara deklaratif menggunakan `Route::livewire()` untuk mendukung pergantian rute berbasis SPA menggunakan sintaks `wire:navigate`.

## 🛠️ Panduan Instalasi

1. **Unduh repositori (Clone)**
   ```bash
   git clone https://github.com/rdhohdyat/laravel-marketplace.git
   cd laravel-marketplace
   ```

2. **Pasang pustaka dependency PHP**
   ```bash
   composer install
   ```

3. **Pasang pustaka dependency Node.js & optimasi kompilasi aset**
   ```bash
   npm install
   npm run build
   ```

4. **Konfigurasi Lingkungan**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Pengaturan Basis Data (Database)**  
   Pastikan Anda mengatur konfigurasi database (nama DB, *user*, *password*) pada file `.env` yang baru disalin, kemudian jalankan:
   ```bash
   php artisan migrate --seed
   ```

6. **Jalankan Aplikasi**
   ```bash
   php artisan serve
   ```
   *Opsional: Jalankan `npm run dev` pada jendela terminal yang terpisah jika Anda berencana memodifikasi kerangka kerja Tailwind CSS atau ikon aset.*

## 🎨 Filosofi Desain

Antarmuka berpatokan ketat pada prinsip-prinsip ini:
- **Shadow Minimalis**: Mengutamakan bingkai datar nan cerdas seperti `border border-gray-100` alih-alih bayangan tebal ala material klasik.
- **Gradien & Warna Vokal**: Konsistensi menggunakan identitas palet `blue-600` dan `blue-900` untuk status aktif dan tombol krusial.
- **Bentuk Presisi**: Kebulatan masif `rounded-2xl` untuk semua kartu wadah, dan `rounded-full` untuk badge/tanda.
- **Keterpisahan Fungsi Absolut**: Pembagian antara pengelolaan kuantitas belanja (`Cart`) dari prosedur validasi pembayaran murni (`Checkout`).

## 📄 Lisensi
Perangkat lunak ini dikembangkan dalam lingkup *Open Source* dan dirilis di bawah naungan sertifikasi [Lisensi MIT](https://opensource.org/licenses/MIT).
