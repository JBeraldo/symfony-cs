FROM php:8.3.12-cli AS base

WORKDIR var/www/

COPY --from=composer:2.7.2 /usr/bin/composer /usr/bin/composer

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    libbrotli-dev

RUN pecl install swoole-5.1.4

RUN pecl install redis-6.1.0
# Install PHP extensions
RUN docker-php-ext-install mbstring exif pcntl bcmath gd sockets opcache pdo pdo_pgsql

RUN docker-php-ext-enable redis swoole

CMD ["php", "public/index.php"]
