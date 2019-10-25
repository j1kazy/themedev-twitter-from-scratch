FROM php:7.2-fpm
COPY php.ini /usr/local/etc/php/
RUN docker-php-ext-install pdo_mysql

RUN apt-get update && \
    apt-get install -y libmagickwand-dev && \
    pecl install imagick && \
    docker-php-ext-enable imagick

WORKDIR /var/www