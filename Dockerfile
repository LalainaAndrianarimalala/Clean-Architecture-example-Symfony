FROM dunglas/frankenphp:1.10-php8.5

# Ajout de l'extension redis à la liste
RUN install-php-extensions \
    intl \
    opcache \
    pdo \
    pdo_mysql \
    mysqli \
    redis

WORKDIR /app
