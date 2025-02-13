# Użyj oficjalnego obrazu PHP 8.4
FROM php:8.4-apache

# Instalacja zależności
RUN apt-get update -y && apt-get install -y \
    curl \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_mysql

# Instalacja Node.js 20.x
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - && \
    apt-get install -y nodejs

WORKDIR /var/www

COPY . .

COPY ./docker/vhost.conf /etc/apache2/sites-available/000-default.conf

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN chown -R www-data:www-data /var/www

RUN chmod +x /var/www/docker/entrypoint.sh

RUN a2enmod rewrite

ENV PORT=80

ENTRYPOINT ["docker/entrypoint.sh"]
