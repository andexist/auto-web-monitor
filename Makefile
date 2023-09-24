export PROJECT_NAME=autowebmonitor
export IMAGE_NAME=autowebmonitor
export PROJECT_TITLE="Auto Web Monitor App"
export PROJECT_TITLE="Auto Web Monitor App"
export PROJECT_HTTP_PORT=3006
export REDIS_TITLE="Redis Light"
export REDISLIGHT_HTTP_PORT=8001

.SILENT:info

info:
	echo ""
	echo "\033[92m${PROJECT_TITLE}\033[0m"
	echo ""
	echo "	- \033[35mHTTP:\033[0m : http://localhost:${PROJECT_HTTP_PORT}"
	echo ""
	echo "\033[92m${REDIS_TITLE}\033[0m"
	echo ""
	echo "	- \033[35mHTTP:\033[0m : http://localhost:${REDISLIGHT_HTTP_PORT}"
	echo ""

upd:
	docker-compose -p=${PROJECT_NAME} up -d
	make info

down:
	docker-compose -p=${PROJECT_NAME} down

build:
	docker-compose -p=${PROJECT_NAME} build --no-cache

bash:
	docker exec -it ${IMAGE_NAME} /bin/bash

logs:
	docker-compose -p=${PROJECT_NAME} logs -t --follow --tail=500

migrate:
	docker-compose -p=${PROJECT_NAME} exec ${PROJECT_NAME} php bin/console doctrine:migrations:migrate -n

phpunit:
	docker-compose -p=${PROJECT_NAME} exec ${PROJECT_NAME} vendor/bin/phpunit
