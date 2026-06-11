# Panduan Deployment ke Railway 🚂

Dokumen ini menjelaskan langkah-langkah untuk melakukan deployment aplikasi Laravel ini ke platform [Railway.app](https://railway.app/).    
  > *Catatan: Deployment hanya 30 hari untuk Trial Plan di railway.*

## 📋 Persiapan

Pastikan repositori GitHub sudah _up-to-date_ dan file berikut tersedia:
1. `composer.json` & `composer.lock`
2. `package.json` & `package-lock.json`
3. `public/index.php`

## 🚀 Langkah-langkah Deployment

### 1. Buat Project Baru di Railway
1. Login ke dashboard Railway.
2. Klik tombol **+ New Project**.
3. Pilih **Deploy from GitHub repo**.
4. Cari dan pilih repositori UP-Resident.
5. Klik **Deploy Now**.
   > *Catatan: Deployment awal mungkin akan gagal karena Environment Variables belum disetting. Ini normal.*

### 2. Tambahkan Database (MySQL/PostgreSQL)
Aplikasi Laravel membutuhkan database. Di dalam dashboard project Railway:
1. Klik tombol **+ New** (atau klik kanan di area kosong).
2. Pilih **Database** -> **MySQL** (atau PostgreSQL sesuai kebutuhan).
3. Tunggu hingga database selesai dibuat.

### 3. Konfigurasi Environment Variables
Masuk ke pengaturan service aplikasi (repo), lalu buka tab **Variables**. Masukkan variabel berikut:

| Variable Key | Value / Instruksi |
| :--- | :--- |
| `APP_NAME` | UP-Resident |
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false` |
| `APP_KEY` | Copy dari `.env` lokal (format: `base64:...`) |
| `APP_URL` | https://up-resident-production.up.railway.app |
| `NIXPACKS_BUILD_CMD` | `npm install && npm run build && composer install --no-dev --optimize-autoloader` |    
| `MIDTRANS_SERVER_KEY` | Masukkan Server Key dari Dashboard Midtrans |
| `MIDTRANS_CLIENT_KEY` | Masukkan Client Key dari Dashboard Midtrans |
| `MIDTRANS_IS_PRODUCTION` | `true` (Jika pakai mode production) atau `false` |

#### Menghubungkan Database
Railway menyediakan cara mudah menghubungkan database menggunakan *Reference Variables*. Masukkan variabel database seperti ini:

| Variable Key | Value (Ketik `${{` untuk autocompletion) |
| :--- | :--- |
| `DB_CONNECTION` | `mysql` |
| `DB_HOST` | `${{MySQL.MYSQLHOST}}` |
| `DB_PORT` | `${{MySQL.MYSQLPORT}}` |
| `DB_DATABASE` | `${{MySQL.MYSQL_DATABASE}}` |
| `DB_USERNAME` | `${{MySQL.MYSQLUSER}}` |
| `DB_PASSWORD` | `${{MySQL.MYSQLPASSWORD}}` |

> *Tips: Dengan menggunakan `${{...}}`, jika kredensial database berubah, aplikasi akan otomatis terupdate.*

### 4. Konfigurasi Start Command (Penting!)
Agar migrasi database berjalan otomatis setiap kali deployment dan storage ter-link, atur **Start Command** di tab **Settings** -> **Service** -> **Deploy**:

Isi **Custom Start Command** dengan:

```bash
php artisan storage:link && php artisan optimize:clear && php artisan serve --host=0.0.0.0 --port=$PORT
```

### 5. Status Deployment

Jika status deployment: ✅ BERHASIL

Aplikasi ini telah berhasil di-deploy dan dapat diakses melalui tautan berikut:    
🔗 [https://up-resident-production.up.railway.app](https://up-resident-production.up.railway.app/)

---
[⬅️ Kembali ke Halaman Utama](../README.md)

