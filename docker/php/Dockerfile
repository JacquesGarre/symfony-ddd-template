#docker/php
FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    bash \
    libzip-dev \
    zip

RUN docker-php-ext-install \
    pdo_pgsql \ 
    zip 

COPY --from=composer:2.8.3 /usr/bin/composer /usr/bin/composer

# Copy application files
WORKDIR /var/www/app


RUN mkdir -p /var/www/.composer/cache && \
    chown -R www-data:www-data /var/www/.composer

RUN chown -R www-data:www-data /var/www/app

COPY ../. .

RUN composer install --optimize-autoloader

