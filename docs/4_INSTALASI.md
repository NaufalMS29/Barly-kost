# UP-Resident

Deskripsi singkat mengenai proyek ini. Jelaskan apa tujuan aplikasi ini dan fitur utamanya secara ringkas.

## 📋 Prasyarat

Sebelum memulai instalasi, pastikan sistem Anda telah memenuhi kebutuhan berikut:

* **PHP** >= 8.4 (Sesuai versi Laravel yang digunakan)
* **Composer** (Manajer dependensi PHP)
* **Node.js & NPM** (Untuk kompilasi aset frontend)
* **MySQL** (Database)
* **Git**

## 🚀 Panduan Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di mesin lokal (Localhost).

### 1. Clone Repository

```bash
git clone https://github.com/pall25/UP-Resident.git
cd UP-Resident
```

### 2. Install Dependensi PHP (Composer)

Install semua library backend laravel:

```bash
composer install
```

### 3. Konfigurasi Environment (.env)

Untuk Windows:

```bash
copy .env.example .env
```

Untuk Mac/Linux:

```bash
cp .env.example .env
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Setup Database

```bash
php artisan migrate

# dan seeder

php artisan db:seed

# atau langsung keduanya

php artisan migrate --seed
```

### 6. Install Dependensi Frontend (NPM)

Install dan kompilasi aset CSS/JS (Vite/Mix):

```bash
npm install

# digunakan saat sedang coding

npm run dev

# digunakan saat aplikasi siap di upload ke server

npm run build

```
### 7. Link Storage

Untuk upload file/gambar publik:

```bash
php artisan storage:link
```

### 8. Jalankan Server

```bash
php artisan serve
```

---

[⬅️ Kembali ke Halaman Utama](../README.md)
