# Sistem Penjagaan Pegawai

Project ini dibuat saat melakukan praktik kerja lapangan di Dinas Komunikasi dan Informatika Kab Pacitan

Dibangun menggunakan 
- Laravel 9
- Bootsrap 5


# Screenshots
![screencapture-spp-test-2023-10-09-18_01_09](https://github.com/Alvinn549/sistem-penjagaan-pegawai/assets/110670962/990827d8-80e9-4f88-bc6f-05e1dca779a3)

![screencapture-spp-test-login-2023-10-09-18_21_29](https://github.com/Alvinn549/sistem-penjagaan-pegawai/assets/110670962/b8f0e00c-2156-4979-8107-30677a20853a)

![screencapture-spp-test-dashboard-2023-10-09-18_03_43](https://github.com/Alvinn549/sistem-penjagaan-pegawai/assets/110670962/85f75972-d7bc-4c97-8396-e76a21a107cc)

![screencapture-spp-test-dashboard-process-tmt-pangkat-2023-10-09-18_02_44](https://github.com/Alvinn549/sistem-penjagaan-pegawai/assets/110670962/f8ef1485-a767-40b7-a172-7503d6353c12)

![screencapture-spp-test-pegawai-2023-10-09-18_03_23](https://github.com/Alvinn549/sistem-penjagaan-pegawai/assets/110670962/feae0f44-9b4d-4dc5-b874-7daf9ff71eef)

![screencapture-spp-test-pegawai-2023-10-09-18_04_29](https://github.com/Alvinn549/sistem-penjagaan-pegawai/assets/110670962/b6566019-0c6b-4d99-b692-7f82ea6b3064)

![screencapture-spp-test-persyaratan-gaji-2023-10-09-18_04_08](https://github.com/Alvinn549/sistem-penjagaan-pegawai/assets/110670962/58bc8c10-d9fe-4285-a8b5-d034f8c443b0)



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
  TIMEZONE=Asia/Jakarta
  LOCALE_ID=id
  FAKER_LOCALE=id_ID
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
