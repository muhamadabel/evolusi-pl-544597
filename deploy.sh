#!/usr/bin/env bash
# deploy.sh — skrip deployment Laravel (Pertemuan 03, slide 6)
# set -e: berhenti seketika bila ada perintah yang gagal.
# Tanpa baris ini, kalau migrate gagal, skrip tetap lanjut ke artisan up
# dan aplikasi dibuka kembali dalam keadaan rusak.
set -e

cd /var/www/aplikasi

# 1 · Kunci pintu — tampilkan halaman pemeliharaan
php artisan down --retry=60

# 2 · Ambil kode terbaru
git pull origin main

# 3 · Pasang dependensi (tanpa paket dev)
composer install --no-dev --optimize-autoloader

# 4 · Ubah skema basis data. --force = jangan tanya
php artisan migrate --force

# 5 · Bangun ulang cache dengan kode & config baru
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 6 · Muat ulang pekerja antrean
php artisan queue:restart

# 7 · Buka pintu kembali
php artisan up
