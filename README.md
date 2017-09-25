## Requisitos

* docker & docker-compose

## Ejecutar 
```
cd docker/
docker-compose up -d --build
docker exec -it docker_php_1 bash
php artisan migrate --seed
```
