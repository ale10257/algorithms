FROM php:8.0-cli

RUN apt-get clean \
    && apt-get update \
    && apt-get install -y git zip unzip \
    && pecl install xdebug ds \
    && docker-php-ext-enable xdebug

COPY ./xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

CMD [ "php" ]