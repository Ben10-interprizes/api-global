FROM php:8.2-apache

COPY . /var/www/html/

RUN a2enmod rewrite

# Ajoute cette ligne pour installer les headers PostgreSQL nécessaires
RUN apt-get update && apt-get install -y libpq-dev

# Puis installe l’extension PDO_PGSQL
RUN docker-php-ext-install pdo pdo_pgsql

EXPOSE 80
