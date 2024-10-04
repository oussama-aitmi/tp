# Test KATA pour candidat Oussama Aitmi 


## Install et start the project (Symfony 6.4.*)

```console
git clone ...

cd TP
docker-compose up -d --build
docker exec -it php-fpm bash
composer update

```

Vous devez pouvoir acceder à l'application depuis URL: http://localhost/

Creation Bd & migrations

```console
bin/console doctrine:database:create
bin/console make:migration
bin/console doctrine:migrations:migrate
```
