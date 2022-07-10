include make-compose.mk

start-app:
	php artisan serve --host 0.0.0.0 --port 8000

start-frontend:
	npm run watch

install-app:
	composer install

install-frontend:
	npm ci

console:
	php artisan tinker

env-prepare:
	cp -n .env.example .env || true

install: install-app install-frontend

key:
	php artisan key:generate

db-prepare:
	php artisan migrate:fresh --seed

setup: env-prepare install key db-prepare
	npm run development

lint:
	composer exec phpcs -v

test-coverage:
	XDEBUG_MODE=coverage composer exec phpunit tests -- --coverage-clover build/logs/clover.xml

test:
	composer exec phpunit tests
