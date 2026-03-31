FROM php:8.3-fpm-alpine
RUN apk add --no-cache bash git unzip icu-dev oniguruma-dev libzip-dev postgresql-dev nodejs npm
RUN docker-php-ext-install intl mbstring zip pdo pdo_pgsql
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
CMD ["php-fpm"]
