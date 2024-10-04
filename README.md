# Test KATA pour candidat Oussama Aitmi 


## Install et start the project (Symfony 6.4.*)

```console
git clone ...

cd library_php_symfony
docker-compose up -d --build
docker exec -it php-fpm bash
composer update
symfony console doctrine:database:create
symfony console make:migration
symfony console doctrine:migrations:migrate
```

Vous devez pouvoir acceder à l'application depuis URL: http://localhost/



```console
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```
