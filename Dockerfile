FROM php:8-apache

# Instalar las dependencias necesarias
RUN apt-get update && apt-get install -y \
    vim \
    nano \
    unzip \
    git \
    curl

# Permisos accés globals
#RUN ln -s /etc/apache2 /usr/local/etc/apache2
#RUN chmod 777 /etc
RUN chmod 777 /etc/apache2 -R

# Instalar Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Verificar la instalación
RUN composer --version