FROM php:8.2-apache

COPY . /var/www/html/

RUN a2enmod rewrite

# Installe les extensions PDO (MySQL et POSTGRES)
RUN docker-php-ext-install pdo pdo_pgsql

EXPOSE 80
