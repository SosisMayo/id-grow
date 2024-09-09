setup:
	@make build
	@make up
	@make update
	@make data

build:
	docker-compose build --no-cache --force-rm

stop:
	docker-compose stop

up:
	docker-compose up -d

update:
	docker exec laravel_app bash -c "composer update"

data:
	docker exec -it laravel_app bash -c "php artisan migrate"
	docker exec -it laravel_app bash -c "php artisan db:seed"

