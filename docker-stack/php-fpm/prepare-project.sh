#!/bin/sh

cd /app
chmod 777 /app/storage -R

composer install
php artisan migrate
php artisan key:generate