SAIL_PATH=./vendor/bin/sail

sail-build:
	$(SAIL_PATH) build

sail-build-no-cache:
	$(SAIL_PATH) build --no-cache

sail-start:
	$(SAIL_PATH) up

sail-start-detached:
	$(SAIL_PATH) up -d

sail-test:
	$(SAIL_PATH) test

sail-stop:
	$(SAIL_PATH) stop

sail-setup:
	composer install
	cp -n .env.example .env || true
	$(SAIL_PATH) build
	$(SAIL_PATH) up -d
	$(SAIL_PATH) artisan key:gen --ansi
	$(SAIL_PATH) artisan migrate
	$(SAIL_PATH) artisan db:seed
	npm install
	npm run dev
	$(SAIL_PATH) stop

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
