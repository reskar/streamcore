FROM dunglas/frankenphp:1.4-php8.4

RUN install-php-extensions \
    pdo_pgsql \
    redis \
    intl \
    pcntl \
    bcmath \
    opcache

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-progress --no-autoloader --no-scripts

COPY . .
RUN composer dump-autoload --optimize --no-dev

ENV SERVER_NAME=:80
EXPOSE 80

CMD ["php", "artisan", "octane:start", "--server=frankenphp", "--host=0.0.0.0", "--port=80", "--workers=4"]
