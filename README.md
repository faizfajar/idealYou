# iDealYou - BMI Tracker & Health Consultant 🏃‍♂️🥗

iDealYou adalah aplikasi pelacak kesehatan modern yang membantu pengguna menghitung Index Massa Tubuh (BMI), memantau riwayat berat badan secara berkala, serta mendapatkan rekomendasi pola makan dan olahraga yang dipersonalisasi.

## 🚀 Fitur Utama
- **Kalkulator BMI Pintar**: Perhitungan akurat berdasarkan berat, tinggi, dan gender.
- **Riwayat Perhitungan**: Pencatatan log otomatis dengan referensi data master (MySQL).
- **Dashboard Statistik**: Pantau total pengecekan dan hasil BMI terakhir Anda.
- **Saran Kesehatan Otomatis**: Rekomendasi makanan dan olahraga berdasarkan kategori BMI (Underweight, Normal, Overweight, Obesitas).
- **Sistem Autentikasi**: Registrasi dan Login aman menggunakan Laravel Fortify dengan validasi Bahasa Indonesia.
- **UI/UX Premium**: Tampilan responsif dengan Tailwind CSS, Sticky Navbar, dan integrasi SweetAlert2 untuk interaksi yang lebih hidup.

## 🛠️ Stack Teknologi
- **Framework**: Laravel 12
- **Frontend**: Livewire, Tailwind CSS
- **Database**: MySQL 8.x (Engine InnoDB)
- **Autentikasi**: Laravel Fortify
- **Interaksi**: SweetAlert2 (Notifikasi & Konfirmasi)

## 📋 Prasyarat Sistem
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL Server

## ⚙️ Langkah Instalasi

### 1. Clone Repositori
```bash
git clone [https://github.com/username/idealyou.git](https://github.com/username/idealyou.git)
cd idealyou
```

### 2. Instalasi Dependensi

```bash
# Instal PHP packages
composer install

# Instal Node modules
npm install
```
### 3. Konfigurasi Environment
Salin file .env.example menjadi .env

```bash
cp .env.example .env
```
Sesuaikan pengaturan database pada file .env

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=idealYou
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Setup Database
Buat database baru di MySQL dengan nama idealYou

lalu jalankan ini

```bash
php artisan migrate --seed
```

### 5. Finalisasi Project
```bash
# Generate key aplikasi
php artisan key:generate

# Bersihkan cache konfigurasi
php artisan config:clear
```

### 6. Jalankan Aplikasi
```bash
php artisan serve
```