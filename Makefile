# Description: Makefile for Laravel Sail

up:
	./vendor/bin/sail up

down:
	./vendor/bin/sail down

migrate:
	./vendor/bin/sail artisan migrate
