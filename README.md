# ⚽ Maaafiqs Mini Soccer - Sistem Reservasi & Manajemen Lapangan

<p align="center">
  <img src="public/images/hero_pitch_night.jpg" width="850" alt="Maaafiqs Mini Soccer Arena" style="border-radius: 16px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);" />
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel" />
  <img src="https://img.shields.io/badge/PHP-^8.1-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" />
  <img src="https://img.shields.io/badge/TailwindCSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS" />
  <img src="https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white" alt="Alpine.js" />
  <img src="https://img.shields.io/badge/Vite-5.x-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite" />
  <img src="https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
</p>

---

## 🌟 Tentang Proyek

**Maaafiqs Mini Soccer** adalah aplikasi web modern berbasis **Laravel 10** yang dirancang untuk mengelola pemesanan lapangan sepak bola mini (*mini soccer*) secara *end-to-end*. Aplikasi ini menghadirkan pengalaman visual kelas dunia bertema **Athletic Obsidian & Neon Emerald**, menjembatani kebutuhan pemain dalam memesan jadwal pertandingan secara *real-time* sekaligus mempermudah manajemen arena dalam mengelola transaksi, inventaris, dan keuangan.

---

## ✨ Fitur Utama

### 1. 🏟️ Landing Page Publik & Branding Atletik
- **Hero Section Premium:** Desain modern dengan efek *mesh pitch*, status booking aktif, dan headline memikat.
- **Pengecek Jadwal Real-Time (*Schedule Checker*):** Filter interaktif berbasis tanggal dan lapangan untuk melihat ketersediaan slot jam secara langsung tanpa perlu login.
- **Katalog Lapangan & Matriks Tarif Transparan:** Rincian biaya berdasarkan kategori waktu (Siang Weekday, Malam Weekday, dan Weekend).
- **Galeri HD & Fasilitas Stadion:** Menampilkan potret pencahayaan LED 1200 Lux, rumput sintetis monofilament standar FIFA, serta tribune & kafe lounge.
- **Testimoni Pemain & FAQ Interaktif:** Informasi seputar aturan main, sistem refund, dan fasilitas pendukung.

### 2. 👤 Portal Member / Pelanggan
- **Alur Pemesanan Interaktif:** Integrasi pemilihan tanggal via kalender dinamis, durasi sewa fleksibel, dan validasi kode promo / voucher instan.
- **Ringkasan Biaya Menempel (*Sticky Order Summary*):** Menampilkan rincian subtotal, potongan diskon, dan total tagihan secara transparan.
- **Batas Waktu Pembayaran Otomatis:** Hitung mundur (*countdown timer*) 24 jam untuk pembayaran sebelum slot dibatalkan otomatis.
- **Kemudahan Pembayaran:** Tombol *1-Click Copy* untuk nomor rekening bank (BCA, BNI) serta *drag-and-drop proof uploader* bukti transfer.
- **E-Tiket & Bukti Booking:** Halaman cetak tiket pertandingan digital siap pakai lengkap dengan Barcode / QR Code.

### 3. 🛡️ Panel Manajemen Admin
- **Dasbor Analitik & KPI:** Statistik pendapatan total, transaksi aktif, jumlah pengguna, dan grafik Chart.js yang interaktif.
- **Verifikasi Pembayaran Cepat:** Modal preview bukti transfer dengan aksi persetujuan (*Approve*) atau penolakan (*Reject*) satu klik.
- **Manajemen Lapangan:** Pengaturan nama lapangan, deskripsi, harga per jam, dan upload foto arena.
- **Manajemen Voucher:** Pembuatan kode diskon persentase maupun potongan nominal tetap beserta kuota dan masa berlaku.
- **Inventaris Alat Olahraga:** Pelacakan stok perlengkapan lapangan (bola pertandingan, rompi tim, sarung tangan kiper, cone, dll).
- **Pengumuman Berjalan (*Marquee Banner*):** Publikasi kabar operasional atau promo terbaru di bagian atas website.

---

## 🛠️ Tech Stack & Library

| Lapisan | Teknologi |
| :--- | :--- |
| **Backend Framework** | [Laravel 10](https://laravel.com/) (PHP ^8.1) |
| **Authentication** | [Laravel Breeze](https://laravel.com/docs/10.x/starter-kits#laravel-breeze) |
| **Database & ORM** | MySQL / MariaDB via Eloquent ORM |
| **Styling & CSS** | [Tailwind CSS 3.x](https://tailwindcss.com/) dengan plugin `@tailwindcss/forms` |
| **Typography** | Font Google [Outfit](https://fonts.google.com/specimen/Outfit) |
| **Interactivity** | [Alpine.js](https://alpinejs.dev/) |
| **Asset Bundler** | [Vite 5](https://vitejs.dev/) |
| **Visual Chart** | [Chart.js](https://www.chartjs.org/) |
| **Kalender** | [FullCalendar](https://fullcalendar.io/) |

---

## 🚀 Panduan Instalasi & Menjalankan Aplikasi

Ikuti langkah-langkah berikut untuk menjalankan proyek di lingkungan lokal:

### 1. Clone Repository
```bash
git clone https://github.com/maaafiqs/minisoccer-reservation.git
cd minisoccer-reservation
```

### 2. Install Dependensi PHP & JavaScript
```bash
# Install PHP dependencies
composer install

# Install NPM packages
npm install
```

### 3. Salin Konfigurasi Lingkungan (.env)
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database
Buka berkas `.env` dan sesuaikan pengaturan database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=reservasi_minisoccer
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migrasi & Seeder Database
Jalankan migrasi tabel beserta data bawaan (seeder):
```bash
php artisan migrate --seed
```

### 6. Buat Storage Symlink
Hubungkan direktori storage publik untuk gambar bukti pembayaran dan foto lapangan:
```bash
php artisan storage:link
```

### 7. Kompilasi Aset Frontend
```bash
# Untuk mode pengembangan (hot reload)
npm run dev

# ATAU kompilasi build produksi
npm run build
```

### 8. Jalankan Web Server
```bash
php artisan serve
```
Akses aplikasi melalui peramban di: **`http://127.0.0.1:8000`** (atau via Laragon vhost: **`http://reservasi-minisoccer.test`**).

---

## 🔑 Akun Bawaan (Default Credentials)

| Peran (Role) | Email | Password | Akses |
| :--- | :--- | :--- | :--- |
| **Administrator** | `admin@admin.com` | `password` | Kelola reservasi, lapangan, keuangan, & inventaris |
| **User / Pelanggan** | `sapik@gmail.com` | `password` | Booking jadwal, upload bukti bayar, cetak tiket |

*(Catatan: Anda juga dapat mendaftarkan akun pelanggan baru secara langsung melalui halaman Register).*

---

## 📂 Struktur Direktori Utama

```plaintext
reservasi-minisoccer/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/            # Controller panel admin (Field, Voucher, Inventory, dll)
│   │   ├── Auth/             # Controller otentikasi (Login, Register, Password)
│   │   └── ReservationController.php # Controller pemesanan & pembayaran
│   ├── Models/               # Model Eloquent (Reservation, Field, Voucher, User, dll)
│   └── Notifications/        # Notifikasi email & sistem status reservasi
├── database/
│   ├── migrations/           # Skema tabel database
│   └── seeders/              # Data inisialisasi awal
├── public/
│   ├── images/               # Aset gambar stadion, rumput, pencahayaan & tribune HD
│   └── build/                # Hasil build produksi Vite (CSS & JS)
├── resources/
│   ├── css/app.css           # Styling kustom, glassmorphism & utility tokens
│   ├── js/app.js             # Alpine.js & integrasi modul frontend
│   └── views/
│       ├── admin/            # View halaman dashboard admin & verifikasi reservasi
│       ├── auth/             # View halaman Login & Register
│       ├── layouts/          # Layout Blade (App, Guest, Navigation)
│       ├── reservations/     # View booking wizard, riwayat, pembayaran & print tiket
│       └── home.blade.php    # Landing page publik premium
├── routes/
│   ├── web.php               # Rute aplikasi web
│   └── auth.php              # Rute otentikasi
└── tailwind.config.js        # Konfigurasi palet Athletic Neon Emerald & tipografi
```

---

## 📄 Lisensi

Proyek ini berada di bawah lisensi open-source [MIT License](LICENSE).
Dikembangkan untuk menghadirkan pengalaman reservasi olahraga digital yang cepat, akurat, dan memanjakan mata.
