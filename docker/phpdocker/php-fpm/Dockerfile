FROM php:7-fpm

WORKDIR "/application"

# Install git
RUN apt-get update \ 
    && apt-get install -y \
        zlib1g-dev \
        git \
        zip \
        unzip \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
    && docker-php-ext-install -j$(nproc) iconv mcrypt \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# pcntl
RUN docker-php-ext-install pcntl

# Instalar extencion mysql
RUN docker-php-ext-install pdo pdo_mysql

# Instalar zip
RUN docker-php-ext-install zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
        --install-dir=/usr/local/bin \
        --filename=composer

