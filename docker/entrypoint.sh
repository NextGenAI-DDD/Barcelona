#!/bin/bash

php artisan key:generate
php artisan migrate
php artisan db:seed --class=DatabaseSeeder --database=mysql_test
php artisan cache:clear
php artisan config:clear
php artisan route:clear
npm run build
php artisan queue:work

exec docker-php-entrypoint apache2-foreground
