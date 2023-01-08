FROM php:8.1.0-zts

RUN apt-get update && apt-get install -y git ssh zip unzip libcurl4-openssl-dev pkg-config libssl-dev
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN pecl install xdebug-3.1.3 && docker-php-ext-enable xdebug
RUN pecl install mongodb && docker-php-ext-enable mongodb

RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.client_host = host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.client_autostart = 1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.client_log = /var/www/api/logs/xdeubg.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

ARG UID=1000
ARG GID=1000
RUN groupadd -g $GID todo && useradd -u $UID -g todo -s /bin/sh todo
USER todo

WORKDIR /var/www/api
EXPOSE 8080
ENTRYPOINT ["php", "build.local.php"]
