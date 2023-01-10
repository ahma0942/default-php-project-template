FROM php:8.1.14-cli-alpine

RUN apk update && apk add git openssh zip unzip curl-dev pkgconfig linux-headers

RUN apk --no-cache add pcre-dev ${PHPIZE_DEPS}
RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN pecl install mongodb && docker-php-ext-enable mongodb
RUN apk del pcre-dev ${PHPIZE_DEPS}

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.client_host = host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.client_autostart = 1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.client_log = /var/www/api/logs/xdeubg.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

ARG UID=1000
ARG GID=1000
RUN addgroup --system --gid $GID todo
RUN adduser --system --uid $UID --ingroup todo todo
USER todo

WORKDIR /var/www/api
EXPOSE 8080
CMD php build.local.php
