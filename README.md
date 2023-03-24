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

4. **Buka `.env` lalu tambahkan kode baris berikut **

```bash
  SCOUT_DRIVER=database
```

5. **Generate app key**

```bash
  php artisan key:generate
```

6. **Jalankan migration dan seeder**

```bash
  php artisan migrate --seed
```

7. **Jalankan website**

```bash
  php artisan serve
```
