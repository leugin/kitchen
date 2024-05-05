# Utiliza la imagen oficial de PHP
FROM php:8.1

# Actualiza los paquetes del sistema e instala las bibliotecas necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zlib1g-dev \
    libicu-dev \
    g++ \
    libmagickwand-dev \
    libxslt-dev \
    unzip \
    p7zip-full

# Configura la extensión gd
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# Instala las extensiones requeridas por Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

RUN apt-get install libsodium-dev -y
RUN docker-php-ext-install sodium sockets

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer global require "squizlabs/php_codesniffer=*"

RUN apt-get update && apt-get install -y \
    software-properties-common \
    npm
RUN npm install npm@latest -g && \
    npm install n -g && \
    n latest
# Establece el directorio de trabajo
WORKDIR /var/www/html

