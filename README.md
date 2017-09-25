# Instalacion

## Instalar 

* docker & docker-compose

## Ejecutar 
```
docker-compose up -d --build
```

## Ingresar al contendor php

* docker exec -it docker_php_1 bash

## Una vez dentro ejecutar artisan

* php artisan migrate --seed
