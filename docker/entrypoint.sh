#!/bin/bash

# Sprawdź, czy folder "vendor" istnieje
if [ ! -d "vendor" ]; then
  # Jeśli folder "vendor" nie istnieje, wykonaj instalację Composer-a i zależności
  composer install
fi

# Generowanie klucza
php artisan key:generate

# Czyszczenie cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Uruchomienie serwera
php artisan serve --port=$PORT --host=0.0.0.0
