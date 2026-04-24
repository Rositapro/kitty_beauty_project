# 1. Usamos una imagen oficial de PHP con Apache ya incluido
FROM php:8.1-apache

# 2. Instalamos la extensión mysqli que es la que usas en tus archivos .php
# Sin esto, el comando 'new mysqli' de tus archivos marcaría error
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# 3. (Opcional) Le damos permisos a la carpeta para que no haya problemas al subir fotos o archivos
RUN chown -R www-data:www-data /var/www/html