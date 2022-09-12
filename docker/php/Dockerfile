# Image
FROM php:8.1-fpm

ARG USER_ID=1000

# Starting from scratch
RUN apt-get clean
RUN apt-get -y autoremove
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Dependencies
RUN apt-get update

# Zip
RUN apt-get install -y libzip-dev zip && docker-php-ext-configure zip && docker-php-ext-install zip

# Git
RUN apt-get install -y git

# Curl
RUN apt-get install -y libcurl3-dev curl && docker-php-ext-install curl

# GD
RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install gd

# MySQL
RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN docker-php-ext-install exif

# BC Math
RUN docker-php-ext-install bcmath

# Human Language and Character Encoding Support
RUN apt-get install -y zlib1g-dev libicu-dev g++ \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl

# PHP Redis extension
RUN pecl install redis
RUN docker-php-ext-enable redis

# Install Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Composer installation
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Clean up
RUN apt-get clean
RUN apt-get -y autoremove
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Add non root user
RUN useradd -u $USER_ID dejan
RUN usermod -aG www-data dejan

RUN mkdir -p /home/dejan
RUN chown -R dejan: /home/dejan
RUN chmod -R 755 /home/dejan

# Set up default directory
WORKDIR /var/www/api

USER dejan