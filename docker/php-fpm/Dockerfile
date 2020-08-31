FROM php:7.3-fpm

RUN usermod -u 1000 www-data

RUN apt-get update \
&& docker-php-ext-install pdo pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


