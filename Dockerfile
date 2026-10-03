# Dockerfile untuk aplikasi Laravel (Tugas 4)
# Tahap 1: pasang dependensi composer dengan cache layer
FROM php:8.2-cli AS composer-deps

# Dependensi sistem untuk ekstensi PHP umum Laravel
RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip libzip-dev libsqlite3-dev \
    && docker-php-ext-install zip pdo pdo_mysql pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*

# Salin composer dari image resmi
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# PENTING (urutan cache): composer.json & composer.lock disalin dan
# dipasang SEBELUM kode aplikasi, supaya layer ini di-cache oleh Docker
# dan tidak dipasang ulang setiap kali kode berubah.
# (Jalankan `composer install` sekali di laptop untuk membuat composer.lock,
#  lalu commit berkasnya. Tanda * membuat build tetap jalan bila lock belum ada.)
COPY composer.json composer.lock* ./
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-autoloader

# Baru setelah itu kode aplikasi disalin
COPY . .

# Generate autoloader setelah seluruh kode ada
RUN composer dump-autoload --optimize

# Tahap 2: image akhir
FROM php:8.2-cli

RUN apt-get update && apt-get install -y --no-install-recommends \
    libzip-dev libsqlite3-dev \
    && docker-php-ext-install zip pdo pdo_mysql pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /app
COPY --from=composer-deps /app /app

EXPOSE 8000

# Jalankan server Laravel. APP_KEY disuntikkan lewat environment saat run,
# bukan ditulis di dalam image.
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
