#!/bin/bash

echo "Installing dependencies..."
npm install

echo "Building assets..."
npm run build

echo "Optimizing Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Setting permissions..."
chmod -R 755 storage bootstrap/cache

echo "Deployment preparation complete!"
