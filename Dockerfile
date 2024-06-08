FROM php:8.3.6-cli

# Arguments
ARG user=php_user
ARG uid=1000

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*docker

RUN pecl install -D 'enable-brotli="no"' swoole

RUN pecl install redis
# Install PHP extensions
RUN docker-php-ext-install mbstring exif pcntl bcmath gd sockets opcache pdo pdo_pgsql

RUN docker-php-ext-enable redis swoole

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#COPY docker/php/conf.d/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
#COPY docker/php/conf.d/realpath.ini /usr/local/etc/php/conf.d/realpath.ini
#COPY docker/php/conf.d/preload.ini /usr/local/etc/php/conf.d/preload.ini

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

COPY . .

RUN  composer install --no-scripts --classmap-authoritative

CMD ["php", "public/index.php"]

USER $user
