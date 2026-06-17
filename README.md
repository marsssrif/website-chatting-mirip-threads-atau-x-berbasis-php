# Website Chatting Mirip Threads atau X berbasis PHP

Aplikasi media sosial / microblogging interaktif mirip dengan Threads (Instagram) atau Twitter (X) yang dibangun menggunakan PHP Native dan basis data MySQL.

## 🚀 Fitur Utama
*   **Feed Utama (For You)**: Menampilkan kiriman dari pengguna lain secara real-time.
*   **Post & Reply**: Bagikan pikiran Anda (Meow) lengkap dengan dukungan unggah gambar, serta balas kiriman pengguna lain.
*   **Ghost Post 👻**: Fitur unik untuk mengirim postingan secara anonim tanpa menampilkan nama asli/username Anda.
*   **Sistem Interaksi**: Fitur menyukai (Like) dan menyimpan (Save/Bookmark) postingan.
*   **Direct Messages (Fitur Chatting)**: Komunikasi langsung antar pengguna secara real-time.
*   **Profil Pengguna**: Kustomisasi profil lengkap dengan foto avatar dan gambar header.
*   **Statistik & Insights**: Analitik sederhana mengenai aktivitas kiriman dan interaksi akun Anda.
*   **Tema Gelap/Terang (Dark & Light Mode)**: Dukungan pergantian tema secara dinamis.

## 🛠️ Teknologi yang Digunakan
*   **Backend**: PHP Native (Object-Oriented Programming menggunakan kelas `User`, `Post`, dan `Interaction`)
*   **Database**: MySQL
*   **Frontend**: HTML5, Vanilla CSS (kustom variabel warna dan transisi animasi modern)
*   **Icons**: Bootstrap Icons

## 📋 Prasyarat Instalasi
Pastikan Anda sudah menginstal aplikasi berikut pada komputer Anda:
1.  **XAMPP** (PHP >= 7.4 & MySQL/MariaDB)
2.  **Web Browser** (Chrome, Edge, Firefox, dll.)
3.  **VS Code** (atau text editor pilihan Anda)

## 🔧 Cara Instalasi & Menjalankan Aplikasi

1.  **Kloning atau Unduh Repositori**:
    Pindahkan folder project ke direktori web server Anda (misal: `C:\xampp\htdocs\tugasakhirppw`).

2.  **Setup Database**:
    *   Pastikan MySQL dan Apache di control panel XAMPP Anda sudah aktif.
    *   Buka browser dan jalankan script setup database otomatis di:
        ```
        http://localhost/tugasakhirppw/setup_db.php
        ```
    *   Script ini secara otomatis akan membuat database `tugasakhirppw` beserta seluruh tabel yang dibutuhkan.

3.  **Jalankan Aplikasi**:
    *   Buka halaman utama aplikasi di browser Anda:
        ```
        http://localhost/tugasakhirppw/home.php
        ```
    *   Silakan daftar akun baru atau login menggunakan akun yang sudah ada untuk mulai membagikan Meow Anda!
