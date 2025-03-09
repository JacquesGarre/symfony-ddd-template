#!/bin/bash

# Stop and remove existing containers if running
echo "🛑 Stopping existing containers..."
docker compose down

# Install dependencies
echo "📦 Installing dependencies..."
composer install

# Clear Symfony cache
echo "🧹 Clearing cache..."
php bin/console cache:clear
php bin/console cache:warmup

# Build and start Docker containers
echo "🚀 Building and starting containers..."
docker compose build

# Run Symfony commands inside the PHP container
PHP_CONTAINER_NAME="php" 

echo "🔄 Running Symfony commands in the container..."
docker exec -it $PHP_CONTAINER_NAME composer install
docker exec -it $PHP_CONTAINER_NAME php bin/console cache:clear
docker exec -it $PHP_CONTAINER_NAME php bin/console cache:warmup
docker exec -it $PHP_CONTAINER_NAME php bin/console doctrine:migrations:migrate --no-interaction

docker compose up --watch
