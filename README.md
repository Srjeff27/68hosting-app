<div align="center">

  <img src="https://img.shields.io/badge/68Hosting-Academic_Platform-indigo?style=for-the-badge&logo=laravel" alt="68Hosting Banner" width="100%" />

  # 🚀 68Hosting
  ### Academic & Professional Static Hosting Platform

  <p align="center">
    <a href="#features">Fitur</a> •
    <a href="#tech-stack">Teknologi</a> •
    <a href="#installation">Instalasi</a> •
    <a href="#workflow">Workflow</a> •
    <a href="#license">Lisensi</a>
  </p>

  ![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=flat-square&logo=laravel)
  ![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=flat-square&logo=php)
  ![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.0-38B2AC?style=flat-square&logo=tailwind-css)
  ![Alpine.js](https://img.shields.io/badge/Alpine.js-3.0-8BC0D0?style=flat-square&logo=alpine.js)
  ![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat-square&logo=mysql)
  ![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)

</div>

---

## 📖 Tentang Project

**68Hosting** adalah platform hosting modern yang dirancang khusus untuk kebutuhan akademisi dan mahasiswa. Platform ini memungkinkan pengguna untuk mempublikasikan website statis (HTML, CSS, JS) dengan mudah, cepat, dan aman.

Dibangun dengan **Laravel 12** dan **Tailwind CSS**, 68Hosting menawarkan antarmuka yang elegan, responsif, dan profesional. Sistem ini dilengkapi dengan fitur manajemen order, validasi pembayaran, dan manajemen user yang komprehensif.

---

## ✨ Fitur Unggulan

### 🎨 User Interface & Experience
- **Desain Premium & Modern**: Menggunakan font *Plus Jakarta Sans* dan palet warna Indigo/Slate yang profesional.
- **Fully Responsive**: Tampilan optimal di Desktop, Tablet, dan Mobile.
- **Interactive UI**: Animasi halus menggunakan Alpine.js dan transisi CSS.
- **Light Mode Enforced**: Tampilan bersih dan konsisten dengan mode terang permanen.

### 🚀 Hosting & Deployment
- **Static Site Hosting**: Dukungan penuh untuk file HTML, CSS, dan JavaScript.
- **Custom Subdomain**: Pengguna mendapatkan subdomain unik `*.zone.id`.
- **Live Preview**: Fitur untuk melihat tampilan website sebelum dipublikasikan.
- **File Validation**: Keamanan file upload untuk mencegah script berbahaya.

### 👮 Administrator Dashboard
- **User Management**: CRUD (Create, Read, Update, Delete) user lengkap.
- **Order Management**: Verifikasi pesanan, bukti pembayaran, dan status project.
- **Admin Notes**: Sistem catatan internal untuk komunikasi antar admin mengenai order tertentu.
- **Project Download**: Admin dapat mendownload source code project user untuk verifikasi manual.

### 💳 Sistem Pembayaran & Order
- **QRIS & Virtual Account**: Simulasi pembayaran modern.
- **Status Tracking**: Pelacakan status order real-time (Pending, Paid, Approved, Rejected).
- **WhatsApp Integration**: Link langsung ke WhatsApp user untuk konfirmasi cepat.

---

## 🛠️ Tech Stack

Project ini dibangun menggunakan teknologi terkini untuk memastikan performa dan keamanan maksimal:

| Kategori | Teknologi | Deskripsi |
| :--- | :--- | :--- |
| **Backend** | Laravel 12 | Framework PHP modern dan robust. |
| **Frontend** | Blade & Tailwind CSS | Styling utility-first yang cepat dan elegan. |
| **Interactivity** | Alpine.js | Framework JS ringan untuk interaksi UI. |
| **Database** | MySQL | Penyimpanan data relasional yang handal. |
| **Auth** | Laravel Breeze | Sistem autentikasi yang aman dan simpel. |
| **Icons** | Heroicons | Set ikon SVG yang bersih dan konsisten. |

---

## ⚙️ Instalasi & Setup

Ikuti langkah-langkah berikut untuk menjalankan project di komputer lokal Anda:

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL

### Langkah-langkah

1.  **Clone Repository**
    ```bash
    git clone https://github.com/username/68hosting-app.git
    cd 68hosting-app
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Setup Environment**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Konfigurasi Database**
    Buat database baru di MySQL, lalu sesuaikan file `.env`:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=68hosting_db
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5.  **Migrasi & Seeding**
    Jalankan migrasi database dan isi data awal (termasuk akun admin):
    ```bash
    php artisan migrate:fresh --seed
    ```

6.  **Jalankan Aplikasi**
    Buka dua terminal terpisah untuk menjalankan server Laravel dan Vite:
    ```bash
    # Terminal 1
    php artisan serve

    # Terminal 2
    npm run dev
    ```

7.  **Akses Aplikasi**
    Buka browser dan kunjungi `http://localhost:8000`.

---

## 🔑 Akun Default

Gunakan akun berikut untuk mengakses fitur administrator:

| Role | Email | Password |
| :--- | :--- | :--- |
| **Administrator** | `admin@68hosting.zone.id` | `password` |

> **Catatan:** Jangan lupa untuk mengganti password setelah login pertama kali demi keamanan.

---

## 🔄 Workflow Sistem

1.  **Registrasi**: User mendaftar akun baru.
2.  **Order Hosting**: User mengisi form order, memilih subdomain, dan mengupload file project (ZIP).
3.  **Pembayaran**: User melakukan pembayaran dan mengupload bukti transfer.
4.  **Verifikasi Admin**: Admin menerima notifikasi, memeriksa bukti bayar, dan memverifikasi file project.
5.  **Aktivasi**: Jika valid, admin menyetujui order. Status berubah menjadi `Approved`.
6.  **Live**: Website user aktif dan dapat diakses melalui subdomain yang dipilih.

---

<div align="center">
  <p>Dibuat dengan ❤️ dan ☕ di Bengkulu</p>
  <p>&copy; 2025 68Hosting. All Rights Reserved.</p>
</div>
