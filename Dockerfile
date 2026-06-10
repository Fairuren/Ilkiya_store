FROM php:8.1-cli-alpine

RUN apk add --no-cache libzip-dev zip unzip curl bash \
    && docker-php-ext-install pdo_mysql zip

WORKDIR /var/www

COPY . .

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && if [ ! -d vendor ]; then composer install --no-dev --no-interaction --prefer-dist; fi

RUN chmod +x docker-entrypoint.sh

EXPOSE 8000
ENTRYPOINT ["bash", "docker-entrypoint.sh"]
