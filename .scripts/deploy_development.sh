#!/bin/bash
set -e

echo "Deployment started ..."

# Enter maintenance mode or return true
# if already is in maintenance mode
(php artisan down) || true

# Pull the latest version of the app
git pull origin Development

# Install composer dependencies
composer install --no-interaction --prefer-dist --optimize-autoloader

# Install dependencies
npm install

# Compile npm assets
npm run build

# Run database migrations
php artisan migrate:fresh --seed

# Clear the old cache
php artisan clear-compiled

# Recreate cache
php artisan optimize

# Optimizing Route Loading
php artisan route:cache

# Optimizing View Loading
php artisan view:cache

# Exit maintenance mode
php artisan up

echo "Deployment finished!"