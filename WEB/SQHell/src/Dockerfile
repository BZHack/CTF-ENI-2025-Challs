FROM php:8.2-apache

RUN apt-get -y update && apt-get -y upgrade
RUN docker-php-ext-install pdo_mysql

COPY ./www /var/www/html/

EXPOSE 80
