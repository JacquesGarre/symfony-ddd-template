#!/bin/bash

php vendor/bin/phpcbf --standard=PSR12 src/ tests/
docker exec -it php php vendor/bin/phpcs
docker exec -it php php vendor/bin/phpstan analyse src tests --level 10 -c phpstan.neon
docker exec -it php php vendor/bin/phpunit -c tests/phpunit.unit.xml.dist
docker exec -it php php vendor/bin/phpunit -c tests/phpunit.integration.xml.dist
