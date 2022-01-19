restart: down up

up:
	docker-compose up -d --build --remove-orphans

down:
	docker-compose down --remove-orphans

build:
	docker-compose build

cd:
	docker-compose run --rm php-cli bash