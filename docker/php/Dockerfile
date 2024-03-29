FROM php:7.1-fpm-buster

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
  zip \
    libzip-dev \
    git \
    unzip \
    libonig-dev \
    libpng-dev \
    zlib1g-dev \
    libwebp-dev \
    libjpeg-dev \
    libpng-dev libxpm-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    g++

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN pecl install -o -f redis mcrypt

RUN docker-php-ext-configure gd --with-freetype-dir --with-jpeg-dir --with-png-dir
RUN docker-php-ext-install -j$(getconf _NPROCESSORS_ONLN) gd

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath opcache
RUN docker-php-ext-enable mcrypt

###########################################################################
# xDebug:
###########################################################################

ARG INSTALL_XDEBUG=false

RUN if [ ${INSTALL_XDEBUG} = true ]; then \
  # Install the xdebug extension
  pecl install xdebug; \
  docker-php-ext-enable xdebug \
;fi

ARG PHP_OPCACHE_VALIDATE_TIMESTAMPS

# Copy xdebug configuration for remote debugging
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
# COPY opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Add user for laravel application
RUN getent group www-data || groupadd -g 1000 www-data
RUN id -u 1000 &>/dev/null || useradd -u 1000 -ms /bin/bash -g www-data www-data

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www

# Set working directory
WORKDIR /var/www

# Change current user to www
USER www-data
