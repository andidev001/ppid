# Portal PPID (Pejabat Pengelola Informasi dan Dokumentasi)

Sistem Informasi PPID berbasis website yang dikembangkan menggunakan **Laravel 10**, **Tailwind CSS**, dan **Alpine.js**. Aplikasi ini bertujuan untuk memfasilitasi publik dalam mengajukan permohonan informasi publik secara terintegrasi serta digunakan oleh Admin untuk memanajemen informasi.

## ✨ Fitur Utama
*   **Hak Akses Multi-Level:** Terdapat 3 role (User Pemohon, Admin PPID, dan Supervisor/Atasan PPID).
*   **Permohonan Informasi:** Registrasi user (Perorangan / Lembaga / Masyarakat) dan tracking permohonan informasi.
*   **Pengajuan Keberatan (Banding):** Jika pemohon tidak puas dengan hasil permohonan, mereka dapat mengajukan keberatan.
*   **Publikasi Dokumen:** Manajemen dokumen informasi publik (Berkala, Serta merta, Setiap Saat, Dikecualikan).
*   **Buku Tamu, Survei Kepuasan & Laporan (Ekspor ke Excel/PDF).**
*   **Dashboard Modern:** UI Premium terinspirasi dari standar modern.

---

## 🚀 Cara Instalasi untuk Klien / Developer Lain

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek ini di Localhost (menggunakan XAMPP / Laragon).

### 1. Persyaratan Sistem
*   PHP >= 8.1
*   Composer
*   Node.js & NPM
*   Database MySQL (MariaDB)
*   Web Server (Apache/Nginx/Laragon)

### 2. Kloning Repository
```bash
git clone https://github.com/USERNAME_ANDA/REPOSITORI_ANDA.git
cd ppid
```

### 3. Install Dependensi PHP dan Node.JS
Buka terminal/CMD di dalam folder project dan jalankan:
```bash
composer install
npm install
```

### 4. Konfigurasi Environment (`.env`)
Copy file konfigurasi environment dan sesuaikan.
```bash
cp .env.example .env
```
Buka file `.env` dan atur detail koneksi database. Contoh jika nama databasenya adalah `ppid`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ppid
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Impor Database
Untuk mempermudah setup database yang sudah berisi pengaturan awal dan struktur lengkap, kami telah menyediakan *Database Dump*.
1. Buat database kosong terlebih dahulu di phpMyAdmin atau Laragon (biasanya bernama `ppid`).
2. Masukkan (Import) file SQL yang berada di dalam folder `database` yaitu:
   👉 **`database/db_ppid_dump.sql`**
3. Import file tersebut langsung melalui antarmuka **phpMyAdmin**, atau melalui CLI/Terminal MySQL.

> **Catatan jika Anda lebih nyaman dengan Migrate (Advanced):**
> Anda juga bisa menjankan perintah `php artisan migrate --seed` jika proyek sudah memiliki fungsional seeder lengkap. Namun, impor menggunakan file SQL dijamin akan langsung membawa 100% data persis seperti yang digunakan terakhir kali di development.

### 7. Tautkan Storage (Storage Link)
Aplikasi ini membaca dan menyimpan banyak file PDF, gambar identitas, dsb. Anda perlu menautkan folder *public*:
```bash
php artisan storage:link
```
*(Catatan Windows: Jalankan terminal/CMD as Administrator jika gagal).*

### 8. Jalankan Aplikasi (Development)
Pertama, jalankan compiler CSS/JS:
```bash
npm run dev
```

Lalu di tab terminal satu lagi, jalankan server Laravel:
```bash
php artisan serve
```
Akses aplikasi melalui browser di: **[http://localhost:8000](http://localhost:8000)**

---

## 🔐 Info Login (Testing)
Pastikan mencoba login untuk melihat fungsionalitas:
*   **Email Admin:** `admin@gmail.com` *(Atau email admin test yang telah Anda buat)*
*   **Password Admin:** `password` *(Atau kombinasi password login Anda di DB saat export)*
