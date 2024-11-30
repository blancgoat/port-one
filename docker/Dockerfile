FROM php:8.3.14-apache
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

RUN apt-get update
RUN apt install -y git

RUN pecl install xdebug-3.4.0 \
    && docker-php-ext-enable xdebug

RUN apt install -y libicu-dev libonig-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl
    
RUN apt install -y zip unzip libzip-dev \
    && docker-php-ext-install zip

RUN a2enmod rewrite
COPY ./docker/000-default.conf /etc/apache2/sites-enabled/000-default.conf

WORKDIR /var/www/html
COPY ./src /var/www/html
RUN composer install
RUN chown -R www-data:www-data .
