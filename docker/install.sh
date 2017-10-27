#!/bin/bash
docker exec -it dev-php-fpm composer install
docker exec -it dev-php-fpm php artisan migrate:fresh --seed
