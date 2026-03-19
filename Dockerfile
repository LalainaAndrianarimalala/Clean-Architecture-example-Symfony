FROM dunglas/frankenphp:1.10-php8.5

# Ajout de l'extension redis à la liste
RUN install-php-extensions \
    intl \
    opcache \
    pdo \
    pdo_mysql \
    mysqli \
    redis \
    zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY composer.json composer.lock ./

COPY . .

RUN composer dump-autoload
