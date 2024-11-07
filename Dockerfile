# Użyj oficjalnie zalecanego obrazu PHP w wersji 8.3
FROM php:8.3-apache

# Instalacja zależności
RUN apt-get update -y && apt-get install -y \
    nodejs \
    npm \
    curl \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www

COPY . .

COPY ./docker/vhost.conf /etc/apache2/sites-available/000-default.conf

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN chown -R www-data:www-data /var/www

RUN npm install -g npm@latest
RUN npm install

RUN composer install --no-interaction --no-progress

RUN cd public && ln -sf ../storage/app/public/ storage

RUN a2enmod rewrite

ENV PORT=80
