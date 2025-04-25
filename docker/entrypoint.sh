#!/bin/bash

if [ ! -d "vendor" ]; then
  composer install
fi

if [ ! -d "node_modules" ]; then
  npm install
fi

php artisan key:generate
php artisan migrate
php artisan db:seed --class=DatabaseSeeder --database=mysql_test
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan storage:link
npm run build
#php artisan queue:work

exec docker-php-entrypoint apache2-foreground
