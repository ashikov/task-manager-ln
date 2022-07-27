BUILD_ARGS:= --build-arg UID=$(shell id -u) --build-arg GID=$(shell id -u)

compose: compose-clear compose-setup compose-start

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

compose-bash:
	docker-compose run --rm app bash

compose-test:
	docker-compose run app make test lint

ci:
	docker-compose -f docker-compose.ci.yml -p task-manager-ci build ${BUILD_ARGS}
	docker-compose -f docker-compose.ci.yml -p task-manager-ci run app make setup
	docker-compose -f docker-compose.ci.yml -p task-manager-ci up --abort-on-container-exit
	docker-compose -f docker-compose.ci.yml -p task-manager-ci down -v --remove-orphans
