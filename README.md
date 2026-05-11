# Writing Portal - Minimalist Content Management System

Writing Portal adalah platform blog dan manajemen konten yang dirancang dengan estetika minimalis, performa tinggi, dan pengalaman pengguna yang premium. Dibangun menggunakan Laravel, Tailwind CSS, dan Alpine.js.

## ✨ Fitur Utama

- **Premium UI/UX**: Desain modern dengan skema warna yang dikurasi, tipografi elegan (Outfit), dan mikro-animasi.
- **Dark Mode Dinamis**: Dukungan mode gelap/terang otomatis yang dapat diubah kapan saja.
- **Sistem Artikel Utama (Featured Posts)**: Tandai artikel terbaik Anda untuk ditampilkan di carousel beranda dan halaman khusus artikel utama.
- **Manajemen Web Terpusat**: Kelola logo (teks atau gambar), branding, media sosial, dan footer langsung dari panel admin.
- **Favicon Pintar**: Sistem otomatis yang menghasilkan favicon dari karakter pertama teks logo atau menggunakan gambar yang diunggah.
- **Jodit WYSIWYG Editor**: Editor konten yang user-friendly dengan dukungan tema gelap otomatis.
- **Navigasi Dinamis**: Menu kategori yang dibuat secara otomatis berdasarkan data kategori di database.
- **Lokalisasi Penuh**: Seluruh antarmuka dan pesan sistem dalam Bahasa Indonesia.
- **SEO Ready**: Struktur judul dinamis dan metadata untuk setiap halaman.

## 🚀 Teknologi yang Digunakan

- **Backend**: [Laravel 11](https://laravel.com)
- **Frontend**: [Tailwind CSS](https://tailwindcss.com), [Alpine.js](https://alpinejs.dev)
- **Editor**: [Jodit Editor](https://xdsoft.net/jodit/)
- **Icons**: [Material Icons](https://fonts.google.com/icons)
- **Fonts**: [Google Fonts (Outfit)](https://fonts.google.com/specimen/Outfit)

## 🛠️ Instalasi

Ikuti langkah-langkah berikut untuk menjalankan project di lingkungan lokal:

1. **Clone Repositori**
   ```bash
   git clone https://github.com/username/writing_portal.git
   cd writing_portal
   ```

2. **Instal Dependensi**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment**
   Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database Anda.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Migrasi Database & Seeder**
   ```bash
   php artisan migrate --seed
   ```

5. **Symlink Storage**
   ```bash
   php artisan storage:link
   ```

6. **Build Aset & Jalankan Server**
   ```bash
   npm run build
   php artisan serve
   ```

## ⚙️ Persiapan Produksi

Untuk menjalankan aplikasi di lingkungan production, pastikan Anda melakukan optimasi berikut:

```bash
# Optimasi Konfigurasi & Route
php artisan optimize

# Build Aset untuk Produksi
npm run build

# Pastikan Debug dimatikan di .env
APP_DEBUG=false
APP_ENV=production
```

## 📸 Dokumentasi & Pengaturan

### Pengaturan Logo
Anda dapat mengatur logo melalui menu **Pengaturan Web** di Panel Admin:
- **Tipe Teks**: Masukkan teks logo (misal: "WP"). Sistem akan mengambil huruf "W" sebagai favicon.
- **Tipe Gambar**: Unggah file PNG. Gambar ini akan digunakan sebagai logo navbar dan favicon.

### Panel Admin
Akses panel admin melalui URL `/admin`. Gunakan akun admin yang telah dibuat melalui seeder.

---
Dibuat dengan ❤️ oleh [Hendrik Samkay] (https://github.com/erck-jr)
