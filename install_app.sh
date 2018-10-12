#!/bin/bash

cp .env.example .env
cd docker
docker stop $(docker ps -sq)
docker-compose up -d nginx mysql workspace
docker-compose exec workspace composer install
docker-compose exec workspace yarn install
docker-compose exec workspace php artisan migrate
docker-compose exec workspace php artisan db:seed
docker-compose exec workspace yarn run dev