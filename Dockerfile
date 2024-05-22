# Use the official PHP image as a base
FROM php:8.3-fpm

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-enable mysqli

COPY . /var/www/html

WORKDIR /var/www/html
