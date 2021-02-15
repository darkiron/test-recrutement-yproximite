# TEST RECRUTEMENT YPROXIMITE

## Pre-requis : 
* Docker
* Docker-compose 
  [https://docs.docker.com/engine/install/](https://docs.docker.com/engine/install/)
  
## Install : 
dans un terminal
* `docker-compose up`
* `docker-compose exec php composer install`
* `docker-compose exec php bin/console doctrine:schema:create`
* `docker-compose exec php bin/console hautelook:fixtures:load`

## Lancement :
* `docker-compose up` (start)
* `docker-compose down` (stop)


## Timing / Deroulement du test
* test install : plusieurs heures (debian)
* dockerisation: 30 min
* TOTAL .env : 1h30
### Bugs : 
* Connection à la DB: 15min  - pas mal le coup du mot mot de passe oublié

#### Front
* 404 (htacces) 5mins
* affichage des articles publiées : 10min (pulished)
* affichage de la page article : 5min (fullName, email)
  
### Admin
* correction de la page edit article : 10 min (persist)
* suppression des articles : 5 min (remove)

### Fonction comment : 
* page commentaire 25min
*pages commentaires : 10min
  
### Refactor:
* Article repository todo : 5min

### divers test/soucis : 20 min
