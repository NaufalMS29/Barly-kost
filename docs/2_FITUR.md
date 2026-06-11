#  IMPLEMENTASI DAN FITUR APLIKASI

Bab ini menjelaskan pembagian tugas tim pengembang serta dokumentasi lengkap fitur-fitur yang telah berhasil diimplementasikan dalam aplikasi UP-Resident, mencakup sisi Pengunjung (Guest) dan sisi Administrator.

---

## A. PEMBAGIAN TUGAS TIM (JOB DESK)

Berdasarkan *Log History* pengembangan, berikut adalah rincian tanggung jawab setiap anggota tim:

| Nama Anggota | Role / Fokus Pengerjaan | Deskripsi Tugas |
| :--- | :--- | :--- |
| **Naufal** | *Fullstack Developer* | • Membuat Database Migrations<br>• Mengatur Filament Resources & Seeders<br>• Integrasi Payment Gateway (Midtrans)|
| **Shafiq** | *Backend Engineer* | • Mengembangkan Fitur Login/Auth<br>• Mengelola Logika Tagihan/Billing |
| **Ihsan** | *Frontend & Data Logic* | • Mengelola Data Penghuni<br>• Mengembangkan Dashboard sisi User |
| **Hardy** | *UI/UX Designer* | • Mengatur Tampilan User Interface (Landing Page)<br>• Kustomisasi Komponen & Status Badges |
| **Arya** | *Technical Writer* | • Menyusun Dokumentasi Proyek<br>• Menyusun Laporan Markdown |

---

## B. FITUR AKSES PUBLIK (FRONTEND)

Fitur ini dapat diakses oleh siapa saja (pengunjung umum) tanpa perlu login terlebih dahulu, bertujuan untuk promosi dan informasi ketersediaan kamar.

### 1. Halaman Utama (Landing Page)
Halaman depan yang menyambut pengunjung dengan desain modern, menampilkan slogan "Temukan Kos Impian Anda" dan navigasi utama.

<div align="center">
  <img src="image/Ui_Minggu_4.png" width="90%">
  <br>
  <p><b>Gambar : Hero Section Landing Page</b></p>
</div>

### 2. Informasi Keunggulan
Bagian yang menjelaskan fasilitas dan alasan mengapa calon penghuni harus memilih UP-Resident (Pembayaran Otomatis, Manajemen Kamar, Responsif).

<div align="center">
  <img src="image/Alasan_Mamilih_UpResident.png" width="90%">
  <br>
  <p><b>Gambar : Bagian Fitur & Keunggulan</b></p>
</div>

### 3. Katalog Ketersediaan Kamar
Fitur pencarian yang memungkinkan pengunjung melihat daftar kamar, filter berdasarkan tipe (AC/Non-AC), status (Kosong/Terisi), dan harga.

<div align="center">
  <img src="image/Fitur_Kamar_Tersedia.png" width="90%">
  <br>
  <p><b>Gambar : Katalog Pencarian Kamar</b></p>
</div>

### 4. Detail Kontak & Footer
Bagian bawah halaman yang menampilkan informasi kontak pengelola dan tautan cepat.

<div align="center">
  <img src="image/Kontak.png" width="90%">
  <br>
  <p><b>Gambar : Footer & Informasi Kontak</b></p>
</div>

### 5. Registrasi Penghuni Baru
Formulir pendaftaran untuk calon penghuni baru yang ingin membuat akun untuk menyewa kamar.

<div align="center">
  <img src="image/Fitur_Register.png" width="90%">
  <br>
  <p><b>Gambar : Halaman Registrasi Akun</b></p>
</div>

### 6. Login Sistem
Halaman autentikasi untuk Admin dan Penghuni agar bisa masuk ke dalam dashboard pengelolaan.

<div align="center">
  <img src="image/Fitur_Login.png" width="90%">
  <br>
  <p><b>Gambar : Halaman Login</b></p>

</div>


## C. FITUR MANAJEMEN DATA MASTER (ADMIN BACKEND)

Fitur ini khusus diakses oleh Admin melalui Dashboard Filament untuk mengelola data utama sistem.

### 7. Fitur Manajemen Users
Halaman untuk mengelola akun pengguna sistem, memverifikasi email, dan mengatur hak akses (Role).

<div align="center">
  <img src="image/Fitur_Users.png" width="90%">
  <br>
  <p><b>Gambar : Halaman Manajemen User</b></p>
</div>

### 8. Fitur Manajemen Kamar
Admin dapat mengelola inventaris kamar, mengubah harga bulanan, dan memantau status fasilitas (AC/Listrik).

<div align="center">
  <img src="image/Fitur_Kamar.png" width="90%">
  <br>
  <p><b>Gambar : Halaman Daftar Kamar</b></p>
</div>

### 9. Fitur Manajemen Penghuni
Halaman untuk mendata identitas lengkap penyewa yang sedang aktif, termasuk data KTP dan kontak.

<div align="center">
  <img src="image/Fitur_Penghunis.png" width="90%">
  <br>
  <p><b>Gambar : Halaman Data Penghuni</b></p>
</div>

---

## D. FITUR KEUANGAN & TRANSAKSI

Fitur krusial untuk menangani alur pembayaran sewa kos dan pencatatan arus kas.

### 10. Daftar Tagihan (Invoices)
Rekapitulasi tagihan bulanan penghuni dengan status pembayaran (Lunas/Belum Lunas).

<div align="center">
  <img src="image/Fitur_Tagihans.png" width="90%">
  <br>
  <p><b>Gambar : Halaman List Tagihan</b></p>
</div>

### 11. Generate Tagihan Otomatis
Fitur pop-up untuk membuat tagihan bulanan secara otomatis bagi penghuni yang dipilih.

<div align="center">
  <img src="image/Generate_Pembayaran_Penghunis.png" width="90%">
  <br>
  <p><b>Gambar : Pop-up Generate Tagihan</b></p>
</div>

### 12. Input & Riwayat Pembayaran
Formulir untuk mencatat pembayaran yang diterima dari penghuni (Cash/Transfer).

<div align="center">
  <img width="1919" height="1079" alt="image" src="https://github.com/user-attachments/assets/40f2feb0-5bdb-49dc-bc49-8d4233fb8a85" />    
  <br>
  <p><b>Gambar : Form Pembayaran</b></p>
</div>

### 13. Detail Pembayaran
Halaman rincian transaksi yang berfungsi sebagai kuitansi digital.

<div align="center">
    <img width="1919" height="1079" alt="image" src="https://github.com/user-attachments/assets/8369ab7e-be6f-4fa3-a030-5d74496cf3c8" />    
  <br>
  <p><b>Gambar : Detail Pembayaran</b></p>
</div>

---

[⬅️ Kembali ke Halaman Utama](../README.md)
