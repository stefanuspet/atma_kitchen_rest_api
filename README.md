# Atma Kitchen Rest APi

Ini adalah proyek Laravel REST API .

## Persyaratan Sistem

Sebelum Anda menjalankan proyek ini, pastikan sistem Anda memenuhi persyaratan berikut:

-   PHP versi 8.2 atau lebih baru
-   Composer
-   MySQL

## Instalasi

1. **Clone Repositori**

    ```bash
    git clone https://github.com/stefanuspet/atma_kitchen_rest_api.git
    ```

2. **Pindah ke Direktori Proyek**

    ```bash
    cd atma_kitchen_rest_api
    ```

3. **Instal Dependensi**

    ```bash
    composer install
    ```

4. **Salin File Konfigurasi Lingkungan**

    ```bash
    cp .env.example .env
    ```

5. **Generate Kunci Aplikasi**

    ```bash
    php artisan key:generate
    ```

6. **Atur Koneksi Database**

    Sesuaikan parameter-parameter di file `.env` sesuai dengan konfigurasi database lokal Anda.

7. **Migrasi Database (Opsional)**

    ```bash
    php artisan migrate
    ```

8. **Jalankan Server Lokal**

    ```bash
    php artisan serve
    ```

9. **Akses Aplikasi**

    Buka browser web Anda dan arahkan ke `http://localhost:8000`.
