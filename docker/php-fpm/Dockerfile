FROM php:fpm-alpine

RUN apk update && apk upgrade --no-cache

RUN apk --no-cache add postgresql-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN echo 'memory_limit = 512M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini;
RUN echo 'upload_max_filesize = 128M' >> /usr/local/etc/php/conf.d/docker-php-upload-max-filesize.ini;
RUN echo 'post_max_size = 128M' >> /usr/local/etc/php/conf.d/post-max-size.ini;
RUN echo 'max_execution_time = 600' >> /usr/local/etc/php/conf.d/max-execution-time.ini;



