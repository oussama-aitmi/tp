# Test KATA 


## Installer et démarrer de projet Kata (Symfony 6.4)

```console
git clone ...

cd TP
docker-compose up -d --build
docker exec -it php-fpm bash
composer update
```

Vous devez pouvoir accéder à l'application depuis URL: http://localhost/

Creation de base de donneé & migrations

```console
bin/console doctrine:database:create
bin/console doctrine:migrations:migrate
```


Chargement de fixture pour la ressource Poduit

```console
php bin/console doctrine:fixtures:load
```

## API Ressource Produit


Récupèration la collection de ressources Produit.
```console
GET /api/produits

Par CURL
curl -X 'GET' \ 'http://localhost/api/produits' \ -H 'accept: application/ld+json'
```

Récupèration d'un Produit par {id}.
```console
GET /api/produits/2

Par CURL
curl -X 'GET' \ 'http://localhost/api/produits/2' \ -H 'accept: application/ld+json'
```

Création d'un nouveau Produit.
```console
POST /api/produits

Par CURL
curl -X 'POST' \
  'http://localhost/api/produits' \
  -H 'accept: application/ld+json' \
  -H 'Content-Type: application/ld+json' \
  -d '{
  "code": "string",
  "name": "string",
  "description": "string",
  "image": "string",
  "category": "string",
  "price": 0,
  "quantity": 0,
  "internalReference": "string",
  "shellId": 0,
  "inventoryStatus": [
    "string", "string"
  ],
}'
```

Modification d'un  Produit.
```console
PUT/PATCH /api/produits/{id}

Par CURL
curl -X 'PUT' \
  'http://localhost/api/produits/2' \
  -H 'accept: application/ld+json' \
  -H 'Content-Type: application/ld+json' \
  -d '{
  "code": "string",
  "name": "string",
  "description": "string",
  "image": "string",
  "category": "string",
  "price": 0,
  "quantity": 0,
  "internalReference": "string",
  "shellId": 0,
  "inventoryStatus": [
    "string", "string"
  ],
}'
```

Suppression d'un Produit par {id}.
```console
DELET /api/produits/2

Par CURL
curl -X 'DELETE' \ 'http://localhost/api/produits/2' \ -H 'accept: application/ld+json'
```
