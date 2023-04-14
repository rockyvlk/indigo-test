FROM php:8.2-fpm

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

COPY ./docker/php/conf.d /usr/local/etc/php/conf.d

### PHP extensions ###
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo_pgsql
### PHP extensions ###

### host.docker.internal ###
COPY ./docker/php/entrypoint.sh /usr/local/bin/docker-php-entrypoint
RUN chmod +x /usr/local/bin/docker-php-entrypoint
### host.docker.internal ###

### wait-for-it ###
COPY ./docker/wait-for-it.sh /usr/local/bin/wait-for-it
RUN chmod +x /usr/local/bin/wait-for-it
### wait-for-it ###

### Composer install ###
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet
### Composer install ###

WORKDIR /app

