# Sistem Pembagian Daging Kurban Digital (QR Code)

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Laravel v11.x](https://img.shields.io/badge/Laravel-v12.x-FF2D20?style=flat-square&logo=laravel)](https://laravel.com/)
[![Filament v3.x](https://img.shields.io/badge/Filament-v3.x-228B22?style=flat-square&logo=filament)](https://filamentphp.com/)
[![Livewire v3.x](https://img.shields.io/badge/Livewire-v3.x-4B4B4B?style=flat-square&logo=livewire)](https://livewire.laravel.com/)

Sistem Pembagian Daging Kurban Digital adalah aplikasi web yang dirancang untuk memodernisasi dan mempermudah proses pembagian daging kurban. Dengan mengganti kupon fisik menjadi QR code digital, sistem ini memungkinkan panitia untuk mengelola data penerima, menerbitkan kupon digital, dan memvalidasi pengambilan daging secara efisien menggunakan pemindaian QR code melalui perangkat seluler.

Dibangun dengan Laravel, FilamentPHP, dan Livewire, aplikasi ini menawarkan antarmuka admin yang intuitif untuk manajemen penuh dan pengalaman pengguna yang lancar untuk penerima.

## Fitur Utama

* **Manajemen Penerima:** Tambah, edit, hapus, dan kelola data penerima daging kurban.
* **Penerbitan Kupon Digital:** Otomatis menghasilkan QR code unik untuk setiap penerima.
* **Akses Penerima:** Penerima dapat login untuk melihat kupon QR code digital mereka.
* **Pemindaian Cepat:** Panitia dapat memindai QR code menggunakan kamera perangkat seluler untuk validasi pengambilan daging secara real-time.
* **Manajemen Status Kupon:** Lacak status pengambilan kupon (belum diambil, sudah diambil).
* **Sistem Role & Permission:** Pembatasan akses granular menggunakan Filament Shield untuk admin, panitia, dan penerima.
* **Dashboard Informatif:** Ikhtisar status kupon dan progress pengambilan.

## Teknologi yang Digunakan

* [**Laravel**](https://laravel.com/) - Framework PHP untuk backend.
* [**FilamentPHP**](https://filamentphp.com/) - Toolkit PHP cepat untuk membangun antarmuka admin yang indah dengan cepat.
* [**Livewire**](https://livewire.laravel.com/) - Framework full-stack untuk Laravel yang membuat pengembangan antarmuka dinamis jadi mudah.
* [**Spatie/Laravel-Permission**](https://spatie.be/docs/laravel-permission/v6) - Untuk manajemen role dan permission.
* [**html5-qrcode**](https://github.com/mebjas/html5-qrcode) - Library JavaScript untuk pemindaian QR code dari kamera web.
* [**Vite**](https://vitejs.dev/) - Tooling frontend modern untuk bundling aset.
* [**Tailwind CSS**](https://tailwindcss.com/) - Framework CSS untuk styling.

## Persyaratan Sistem

* PHP >= 8.2
* Composer
* Node.js & NPM / Yarn
* Database MySQL, PostgreSQL, SQLite (direkomendasikan MySQL)

## Instalasi

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek secara lokal.

1.  **Clone Repositori:**
    ```bash
    git clone [https://github.com/nama_pengguna_anda/nama_repo_anda.git](https://github.com/nama_pengguna_anda/nama_repo_anda.git)
    cd nama_repo_anda
    ```

2.  **Instal Dependensi Composer:**
    ```bash
    composer install
    ```

3.  **Salin File Konfigurasi Lingkungan:**
    ```bash
    cp .env.example .env
    ```

4.  **Buat Kunci Aplikasi:**
    ```bash
    php artisan key:generate
    ```

5.  **Konfigurasi Database:**
    Edit file `.env` Anda dan sesuaikan pengaturan database:
    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_anda
    DB_USERNAME=username_database_anda
    DB_PASSWORD=password_database_anda
    ```

6.  **Jalankan Migrasi Database dan Seeder:**
    Perintah ini akan membuat tabel database dan mengisi data awal untuk role, permission, dan user admin.
    ```bash
    php artisan migrate --seed
    ```
    **Catatan:** User Admin awal akan dibuat dengan kredensial:
    * **Email:** `admin@qurban.com`
    * **Password:** `adminqurban` (Sangat disarankan untuk mengubahnya setelah login pertama!)

7.  **Instal Dependensi NPM & Build Aset Frontend:**
    ```bash
    npm install
    npm run dev # Untuk pengembangan, otomatis memantau perubahan
    # Atau npm run build # Untuk produksi, akan membuat aset yang dioptimalkan
    ```

8.  **Jalankan Server Lokal:**
    ```bash
    php artisan serve
    ```

9.  **Akses Aplikasi:**
    Buka browser Anda dan kunjungi `http://127.0.0.1:8000/admin`.
    Login dengan kredensial admin yang telah disediakan.

## Penggunaan

### Panel Admin (Untuk Admin & Panitia)

* **Login:** Akses `/admin` dan login dengan kredensial yang sesuai.
* **Manajemen Pengguna:** Admin dapat membuat dan mengelola pengguna baru di menu "Users".
* **Manajemen Role & Permission:** Admin dapat mengatur peran (`admin`, `panitia`, `penerima`) dan izin yang sesuai di menu "Roles" dan "Permissions".
* **Manajemen Penerima:** Di menu "Penerima", admin dapat menambahkan data penerima, yang secara otomatis akan terkait dengan kupon digital.
* **Pindai Kupon:** Panitia dengan izin "scan qr codes" dapat mengakses halaman "Pindai Kupon" di navigasi samping untuk memindai QR code.

### Akses Penerima

* Penerima dapat login ke aplikasi (jika Anda menyediakan fitur login untuk mereka) untuk melihat kupon QR code digital mereka di dashboard. Anda mungkin perlu membuat fitur login/registrasi terpisah untuk penerima jika belum ada di Filament.

## Kontribusi

Kami sangat menyambut kontribusi dari komunitas! Jika Anda ingin berkontribusi:

1.  Fork repositori ini.
2.  Buat branch baru untuk fitur atau perbaikan Anda (`git checkout -b feature/nama-fitur`).
3.  Lakukan perubahan Anda.
4.  Commit perubahan Anda (`git commit -m 'feat: Menambahkan fitur baru XYZ'`).
5.  Push ke branch Anda (`git push origin feature/nama-fitur`).
6.  Buka Pull Request ke repositori utama.

Mohon ikuti [Panduan Kontribusi](CONTRIBUTING.md) kami (jika Anda berencana membuatnya) dan [Code of Conduct](CODE_OF_CONDUCT.md) (jika Anda berencana membuatnya).

## Lisensi

Proyek ini dilisensikan di bawah Lisensi MIT. Anda bebas menggunakan, memodifikasi, dan mendistribusikan kode ini untuk tujuan pribadi maupun komersial.
