FROM php:8.1-fpm

ARG user=guilherme
ARG uid=1000

WORKDIR /var/www

RUN apt-get update && apt-get install -y git

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-install pdo_mysql

RUN useradd -G www-data,root -u $uid -d /home/$user $user
