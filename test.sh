#!/bin/bash

docker exec -it php php  vendor/bin/phpstan analyse src tests --level 10
docker exec -it php php vendor/bin/phpunit -c tests/phpunit.unit.xml.dist
docker exec -it php php vendor/bin/phpunit -c tests/phpunit.integration.xml.dist
