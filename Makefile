#!make

init: docker-clear docker-build docker-up composer-install migrate
up: docker-up
down: docker-down
restart: docker-down docker-up

docker-up:
	docker-compose up --d

docker-down:
	docker-compose down

docker-clear:
	docker-compose down -v --remove-orphans

docker-build:
	docker-compose build --pull

migrate:
	docker-compose exec -T indigo-auth-php bin/console doctrine:migrations:migrate --no-interaction

rollback:
	docker-compose exec -T indigo-auth-php bin/console doctrine:migrations:migrate prev --no-interaction

composer-install:
	docker-compose exec -T indigo-auth-php composer install

composer-update:
	docker-compose exec -T indigo-auth-php composer update

