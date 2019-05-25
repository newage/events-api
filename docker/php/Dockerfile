FROM php:7.3-fpm

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
           libcurl4-openssl-dev \
           libicu-dev \
           libzip-dev \
   && docker-php-ext-install -j$(nproc) json mbstring pdo pdo_mysql \
   && docker-php-ext-install -j$(nproc) curl \
   && docker-php-ext-install -j$(nproc) zip \
   && docker-php-ext-install -j$(nproc) intl \
   && rm -rf /var/lib/apt/lists/*

# Composer
RUN curl -sS https://getcomposer.org/installer | php \
   && mv composer.phar /usr/local/bin/composer \
   && chmod +x /usr/local/bin/composer \
   && composer global require hirak/prestissimo

#xDebug
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini

ARG PUID=1000
RUN usermod -u ${PUID} www-data
USER www-data