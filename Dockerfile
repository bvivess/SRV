FROM php:8-apache

# Instal·lar les dependencias necessàries
RUN apt-get update && apt-get install -y \
    vim \
    nano \
    unzip \
    git \
    curl

# Permisos d'accés globals
#RUN ln -s /etc/apache2 /usr/local/etc/apache2
RUN docker-php-ext-install mysqli 
RUN docker-php-ext-enable mysqli
RUN apachectl restart

RUN chmod 777 /etc/apache2 -R
RUN chown www-data:www-data html -R

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Verificar la instalació
RUN composer --version