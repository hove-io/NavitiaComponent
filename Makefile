##
## Run tests
##

clean_tests:
	@ echo "\033[0;32mCleaning\033[0m"
	_UID=$(shell id -u) GID=$(shell id -g) docker-compose -p "navitiacomponent_$(shell git rev-parse --abbrev-ref HEAD)" -f docker-compose.test.yml down --remove-orphans
	@ rm composer.lock; rm -rf vendor

clean_tests_light:
	_UID=$(shell id -u) GID=$(shell id -g) docker-compose -p "navitiacomponent_$(shell git rev-parse --abbrev-ref HEAD)" -f docker-compose.test.yml down --remove-orphans

start_tests:
	_UID=$(shell id -u) GID=$(shell id -g) docker-compose -p "navitiacomponent_$(shell git rev-parse --abbrev-ref HEAD)" -f docker-compose.test.yml build
	_UID=$(shell id -u) GID=$(shell id -g) docker-compose -p "navitiacomponent_$(shell git rev-parse --abbrev-ref HEAD)" -f docker-compose.test.yml run --rm --no-deps navitiacomponent composer install --no-interaction --prefer-source
	_UID=$(shell id -u) GID=$(shell id -g) docker-compose -p "navitiacomponent_$(shell git rev-parse --abbrev-ref HEAD)" -f docker-compose.test.yml run --rm navitiacomponent

all_tests_dev: start_tests clean_tests_light

all_tests: start_tests clean_tests
