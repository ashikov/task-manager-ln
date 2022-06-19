setup:
	composer install
	cp -n .env.example .env || true
	php artisan key:gen --ansi
	php artisan migrate
	php artisan db:seed
	npm ci
	npm run dev

start:
	heroku local -f Procfile.dev

lint:
	composer exec -v phpcs

test:
	php artisan test

test-coverage:


deploy:
	git push heroku master

log:
	tail -f storage/logs/laravel.log

migrate:
	php artisan migrate

migrate-rollback:
	php artisan migrate:rollback

serve:
	php artisan serve

watch:
	npm run watch
