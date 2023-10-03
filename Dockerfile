# Użyj oficjalnie zalecanego obrazu PHP w wersji 8.1
FROM php:8.2

# Instalacja zależności
RUN apt-get update && apt-get install -y \
    build-essential \
     curl \
     zip \
     sudo \
     unzip \
     && docker-php-ext-install pdo pdo_mysql
# Ustawienie katalogu roboczego
WORKDIR /var/www

# Kopiowanie plików źródłowych do kontenera
COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

ENV PORT=8000

ENTRYPOINT ["docker/entrypoint.sh"]
