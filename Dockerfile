FROM dunglas/frankenphp:1.10-php8.5

RUN install-php-extensions intl opcache

WORKDIR /app