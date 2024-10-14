FROM php:8.2.0-apache

WORKDIR /var/www/html

# Copia os arquivos do projeto para o contêiner
COPY . .

# Mod Rewrite
RUN a2enmod rewrite

# Linux Library
RUN apt-get update -y && apt-get install -y \
    libicu-dev \
    libmariadb-dev \
    unzip zip \
    zlib1g-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpq-dev \
    libzip-dev

# PHP Extension: Configure and Install Zip extension
RUN docker-php-ext-configure zip && docker-php-ext-install zip

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# PHP Extension
RUN docker-php-ext-install gettext intl pdo_pgsql

# PHP GD Extension
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Install Node.js
RUN apt-get install -y curl \
&& curl -sL https://deb.nodesource.com/setup_18.x | bash - \
&& apt-get install -y nodejs

COPY apache-config.conf /etc/apache2/sites-available/000-default.conf