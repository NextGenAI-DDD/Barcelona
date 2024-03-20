#!/bin/bash

php artisan migrate
php artisan db:seed --class=DatabaseSeeder --database=mysql_test
php artisan cache:clear
php artisan config:clear
php artisan route:clear
npm run build

exec docker-php-entrypoint apache2-foreground
