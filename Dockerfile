FROM php:8.3.14-apache

RUN pecl install xdebug-3.4.0
RUN docker-php-ext-enable xdebug
