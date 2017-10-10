FROM php:7-fpm

WORKDIR "/application"

# Install git
RUN apt-get update \
    && apt-get -y install git \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# pcntl
RUN docker-php-ext-install pcntl 

# Instalar extencion mysql
RUN docker-php-ext-install pdo pdo_mysql


# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
        --install-dir=/usr/local/bin \
        --filename=composer

USER www-data:www-data
