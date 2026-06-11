# UP-Resident: Sistem Informasi Manajemen Rumah Kos

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![FilamentPHP](https://img.shields.io/badge/Filament-F28D1A?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Midtrans](https://img.shields.io/badge/Midtrans-Payment-005C84?style=for-the-badge&logo=wallet&logoColor=white)

> **UP-Resident** adalah platform berbasis web yang dirancang untuk mempermudah pengelolaan operasional rumah kos, mulai dari pendataan kamar, manajemen penghuni, hingga pencatatan tagihan dan pembayaran secara otomatis.

LINK WEB: https://up-resident-production.up.railway.app

> *Catatan: Midtrans pada website ini masih menggunakan KEY sandbox belum production. Jadi, jika ingin menggunakan midtrans pembayarannya melalui simulator midtrans (https://simulator.sandbox.midtrans.com).* 

---

LINK YOUTUBE: https://youtu.be/bWNWjhSnYEE

---

## 🚀 Alur Penggunaan Aplikasi (User Flow)

Berikut adalah langkah singkat menggunakan aplikasi sebagai penyewa:

1.  **Registrasi / Login:**
    Buat akun baru pada menu *Register* (atau *Login* jika sudah memiliki akun).
2.  **Isi Data & Pilih Kamar:**
    Masuk ke menu penyewaan, lengkapi **formulir data diri penghuni** (KTP & Kontak), lalu pilih kamar yang tersedia.
3.  **Pembayaran Sewa:**
    Lakukan pembayaran tagihan awal melalui **Midtrans** (Support QRIS, Virtual Account, & E-Wallet).
4.  **Selesai:**
    Sistem otomatis memverifikasi pembayaran. Status sewa menjadi aktif dan kamar berhasil dipesan.

---

## 🗂️ Dokumentasi & Laporan Proyek

Berikut adalah dokumentasi lengkap pengembangan sistem. Silakan klik tautan pada tabel di bawah untuk melihat detail setiap bab:

| Bagian | Topik Pembahasan | Link Akses |
| :--- | :--- | :--- |
| **1. Basis Data** | Desain ERD, relasi tabel (Users, Kamars, Penghunis), dan aliran data. | [📂 Buka Laporan ERD](./docs/1_ERD.md) |
| **2. Fitur & Tim** | Penjelasan fitur lengkap (Auth, Billing, Dashboard) & pembagian tugas tim. | [📂 Buka Laporan Fitur](./docs/2_FITUR.md) |
| **3. Antarmuka (UI)** | Galeri *screenshot* perkembangan tampilan dari minggu 1 s.d. final. | [📂 Buka Galeri UI](./docs/3_TAMPILAN.md) |
| **4. Instalasi** | Panduan menjalankan aplikasi di komputer lokal (Localhost). | [📂 Panduan Instalasi](./docs/4_INSTALASI.md) |
| **5. Deployment** | Cara upload aplikasi ke internet menggunakan Railway. | [📂 Panduan Deployment](./docs/5_DEPLOYMENT.md) |

---

## 📸 Kilas Tampilan Aplikasi

Berikut adalah sedikit cuplikan tampilan dari aplikasi UP-Resident. Untuk galeri lengkap, silakan kunjungi [Dokumentasi UI](./docs/3_TAMPILAN.md).

### Halaman Utama (Landing Page)
![Landing Page](./docs/image/Ui_Minggu_4.png)

### Dashboard Admin (Manajemen Kamar)
![Dashboard Admin](./docs/image/Fitur_Kamar.png)

---

## 🛠️ Fitur Unggulan

* **Live Deployment:** Aplikasi dapat diakses publik via Railway.
* **Midtrans Integration:** Pembayaran sewa kos online otomatis.
* **Billing System:** Pembuatan tagihan otomatis setiap bulan.
* **Manajemen Penghuni:** Pendataan penghuni dan kamar menggunakan **FilamentPHP**.

---

## 👨‍💻 Tim Pengembang

Proyek ini dikembangkan dengan kolaborasi tim sebagai berikut:

* **Naufal** - Fullstack Developer (Payment Gateway)
* **Shafiq** - Backend Engineer
* **Ihsan** - Frontend & Data Logic
* **Hardy** - UI/UX Designer
* **Arya** - Technical Writer

---
