FROM php:8.2.10-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
# change document root directory
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!memory_limit = 128M!memory_limit = 256M!g' /usr/local/etc/php/php.ini

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf


# autorise .htaccess files
# changes None for all.
RUN sed -i '/<Directory ${APACHE_DOCUMENT_ROOT}>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
RUN a2enmod rewrite

# installing xdebug
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.mode=develop" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_host=10.0.2.15" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.start_upon_error=yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini


# Instalar extensiones y herramientas necesarias para Composer
RUN apt-get update && apt-get install -y \
    libpng-dev\
    libjpeg-dev\
    libfreetype6-dev \
    zlib1g-dev \
    libzip-dev \
    libnss3 \
    unzip

RUN docker-php-ext-install zip

# Instal·lar la llibreria GD per a gestió de gràfics
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd


# Instal·lar suport traduccions
RUN apt-get -y update \
    && apt-get install -y libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl


# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


#Installing Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash

RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

#Installing node and namp
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - &&\
 apt-get install -y nodejs

 # Instalar wkhtmltopdf
RUN apt-get update && apt-get install -y \
    wkhtmltopdf \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# docker-compose exec web-server composer install \
# docker-compose exec web-server /bin/bash
# docker-compose exec web-server symfony ....
# docker-compose exec web-server php bin/console ...

