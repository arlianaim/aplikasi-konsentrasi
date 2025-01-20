## Cara Menjalankan Proyek

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di mesin Anda:

1. Clone repository:
   ```bash
   git clone https://github.com/arlianaim/aplikasi-konsentrasi.git
   cd aplikasi-konsentrasi

2. Install dependencies backend:
   ```bash
   composer install

3. Install dependencies frontend:
   ```bash
   npm install
4. Build frontend asset:
   ```bash
   npm run build
5. Salin file .env:
   ```bash
   cp .env.example .env
6. Generate application key:
   ```bash
   php artisan key:generate
8. Migrasi dan seed database:
   ```bash
   php artisan migrate --seed   
10. Jalankan server:
    ```bash
    php artisan serve
    
Setelah semua langkah di atas selesai, buka browser Anda dan akses aplikasi di alamat:
http://127.0.0.1:8000



## FYI
### Framework
Proyek ini dibangun menggunakan Laravel, sebuah framework PHP yang terkenal karena sintaksisnya yang elegan dan kemampuannya yang kuat. Laravel menyediakan fitur seperti migrasi database, ORM Eloquent, dan job queue untuk membangun aplikasi web yang modern dan skalabel.
