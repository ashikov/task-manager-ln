BUILD_ARGS:= --build-arg UID=$(shell id -u) --build-arg GID=$(shell id -u)

compose: compose-clear compose-build compose-setup compose-start

compose-clear:
	docker-compose down -v --remove-orphans || true

compose-build:
	docker-compose build ${BUILD_ARGS}

compose-setup: compose-build
	docker-compose run --rm app make setup

compose-start:
	docker-compose up --abort-on-container-exit

compose-clear:
	docker-compose down -v --remove-orphans || true
