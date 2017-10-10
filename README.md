## Requisitos

* docker & docker-compose

###Limpiar todos los contenedores de docker
```
docker rm $(docker ps -a -q)
```

### Limpiar todas las imagenes de docker
```
docker rmi -f $(docker images -a -q)
```

## Ejecutar 
```
cd docker/
docker-compose up -d --build
docker exec -it dev-php-fpm bash
php artisan migrate --seed
```
