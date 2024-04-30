# Description: Makefile for Laravel Sail

up:
	./vendor/bin/sail up
down:
	./vendor/bin/sail down
share:
	./vendor/bin/sail share

migrate:
	./vendor/bin/sail artisan migrate
migrate_fresh:
	./vendor/bin/sail artisan migrate:fresh
migrate_rollback:
	./vendor/bin/sail artisan migrate:rollback
