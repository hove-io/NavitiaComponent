##
## Help
##

.PHONY: help
help: ## Prints this help message
	@grep -E '^[a-zA-Z_-]+:.*## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

##
## Run tests
##

end_tests: ## Clean only container
	_UID=$(shell id -u) GID=$(shell id -g) docker-compose -p "navitiacomponent_$(shell git rev-parse --abbrev-ref HEAD)" -f docker-compose.test.yml down --remove-orphans

clean_tests: ## Clean all
	@ echo "\033[0;32mCleaning\033[0m"
	@$(MAKE) end_tests
	@ rm composer.lock; rm -rf vendor

build_tests: ## Build image and vendor
  _UID=$(shell id -u) GID=$(shell id -g) docker-compose -p "navitiacomponent_$(shell git rev-parse --abbrev-ref HEAD)" -f docker-compose.test.yml build
	_UID=$(shell id -u) GID=$(shell id -g) docker-compose -p "navitiacomponent_$(shell git rev-parse --abbrev-ref HEAD)" -f docker-compose.test.yml run --rm --no-deps navitiacomponent composer install --no-interaction --prefer-source

start_tests: ## Start phpunit tests
	_UID=$(shell id -u) GID=$(shell id -g) docker-compose -p "navitiacomponent_$(shell git rev-parse --abbrev-ref HEAD)" -f docker-compose.test.yml run --rm navitiacomponent

all_tests_dev: ## Start all tests and clean only container
    @$(MAKE) build_tests
    @$(MAKE) start_tests
    @$(MAKE) end_tests

all_tests: ## Start all tests and clean all
    @$(MAKE) build_tests
    @$(MAKE) start_tests
    @$(MAKE) clean_tests
