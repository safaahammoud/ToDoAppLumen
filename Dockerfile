
FROM php:7.2-fpm-alpine
RUN docker-php-ext-install pdo pdo_mysql
FROM composer
RUN composer global require "laravel/lumen-installer"
ENV PATH $PATH:/tmp/vendor/bin
