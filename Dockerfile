FROM php:8.4-fpm-alpine

WORKDIR /var/www

RUN apk update && apk add --no-cache \
    postgresql-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    redis

RUN docker-php-ext-install pdo pdo_pgsql zip

# Добавляем поддержку Redis
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del .build-deps

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN addgroup -g 1000 -S www && \
    adduser -u 1000 -S www -G www

USER www

COPY --chown=www:www . /var/www

RUN composer install --no-interaction --no-scripts --prefer-dist

EXPOSE 9000
