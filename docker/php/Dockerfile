FROM php:5.6-fpm

# Get repository and install wget and vim
RUN apt-get update && apt-get install --no-install-recommends -y \
        wget \
        vim \
        git \
        unzip

# Instalar extencion mysql
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
        --install-dir=/usr/local/bin \
        --filename=composer

# Install PHPUnit
#RUN wget https://phar.phpunit.de/phpunit.phar -O /usr/local/bin/phpunit \
#    && chmod +x /usr/local/bin/phpunit

WORKDIR /var/www/html

#RUN composer install --no-interaction
#RUN composer update