# Estágio 1: Builder
FROM php:8.3-cli AS builder

ARG user=yourusername
ARG uid=1000

RUN apt-get update && apt-get install -y \
    git \
    libzip-dev \
    unzip \
    libicu-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring pcntl zip bcmath gd intl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY composer.json composer.lock ./

RUN composer install --no-scripts --no-autoloader

COPY . .

RUN composer dump-autoload --optimize

# Estágio 2: Production
FROM php:8.3-fpm

ARG user=yourusername
ARG uid=1000

RUN apt-get update && apt-get install -y \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets intl

RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

WORKDIR /var/www

RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

COPY --from=builder /var/www/vendor /var/www/vendor
COPY --from=builder /var/www /var/www

COPY docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini

RUN chown -R $user:www-data /var/www
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

USER $user

EXPOSE 8080

CMD ["php-fpm"]
