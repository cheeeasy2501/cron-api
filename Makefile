CURRENT_ID=$([[ $(id -u) -gt 9999 ]] && echo "root" || id -u)
CURRENT_GROUP=$([[ $(id -g) -gt 9999 ]] && echo "root" || id -g)

DC := CURRENT_USER=${CURRENT_ID}:${CURRENT_GROUP} docker-compose
FPM := $(DC) exec phpfpm
ARTISAN := $(FPM) php artisan

env:
	cp ./.env.example ./.env

build:
	@$(DC) build

start:
	@$(DC) up -d

stop:
	@$(DC) down

keygen:
	@$(ARTISAN) key:generate

migrate:
	@$(ARTISAN) migrate

composer-install:
	@$(FPM) composer install

deploy: env start composer-install keygen migrate
