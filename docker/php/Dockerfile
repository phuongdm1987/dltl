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
    libmcrypt-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmagickwand-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN pecl install -o -f redis mcrypt

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/lib --with-png-dir=/usr/lib --with-jpeg-dir=/usr/lib
RUN docker-php-ext-install pdo_mysql mbstring exif zip pcntl bcmath gd opcache exif
RUN docker-php-ext-enable mcrypt exif

ARG PHP_OPCACHE_VALIDATE_TIMESTAMPS="0"

COPY opcache.ini /usr/local/etc/php/conf.d/opcache.ini

###########################################################################
# xDebug:
###########################################################################

ARG INSTALL_XDEBUG=false

RUN if [ ${INSTALL_XDEBUG} = true ]; then \
  # Install the xdebug extension
  pecl install xdebug; \
  docker-php-ext-enable xdebug \
;fi

# Copy xdebug configuration for remote debugging
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

# Set working directory
WORKDIR /var/www

# Change current user to www
USER www
