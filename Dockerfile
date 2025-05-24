FROM php:8.2-apache

# Copie tout le code dans le dossier de l'image Docker
COPY . /var/www/html/

# Active mod_rewrite si tu utilises .htaccess (optionnel)
RUN a2enmod rewrite

# Tu peux installer d'autres extensions si besoin
# RUN docker-php-ext-install pdo pdo_pgsql

EXPOSE 80
