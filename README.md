# Sistem Penjagaan Pegawai

Project ini dibuat saat melakukan praktik kerja lapangan di Dinas Komunikasi dan Infromatika Kab Pacitan

Dibangun menggunakan 
- Laravel 9
- Bootsrap 5

## Default Account for testing

**Admin Default Account**

- username : Admin
- Password : password

## Deployment

To deploy this project

1. **Clone Repository**

```bash
  git clone https://github.com/Alvinn549/sistem-penjagaan-pegawai
  cd sistem-penjagaan-pegawai
  composer install
```

2. **Buat file `.env`**

```bash
  cp .env.example .env
```

3. **Buka `.env` lalu ubah baris berikut sesuai dengan databasemu yang ingin dipakai**

```bash
  DB_PORT=3306
  DB_DATABASE=laravel
  DB_USERNAME=root
  DB_PASSWORD=
```

4. **Generate app key**

```bash
  php artisan key:generate
```

5. **Jalankan migration dan seeder**

```bash
  php artisan migrate --seed
```

6. **Jalankan website**

```bash
  php artisan serve
```
