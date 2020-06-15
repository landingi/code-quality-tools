FROM php:7.4-cli-alpine
MAINTAINER Miłosz Lenczewski <milosz.lenczewski@gmail.com>

ENV COMPOSER_HOME /composer
ENV COMPOSER_ALLOW_SUPERUSER 1

RUN apk update \
    && apk add --no-cache git unzip libzip \
    && apk add --no-cache --virtual build-dependencies libzip-dev \
    && docker-php-ext-configure zip && docker-php-ext-install zip
RUN apk del build-dependencies && rm -rf /tmp/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY ./ /app
WORKDIR /app

RUN composer install
VOLUME ["/project"]

ENTRYPOINT ["php", "/app/quality.php"]
