FROM php:7.4-fpm

WORKDIR /var/www

RUN apt-get update \
 && apt-get install -y -q --no-install-recommends \
    msmtp \
    libpq-dev\
 && apt-get clean \
 && rm -r /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_pgsql


COPY msmtprc /etc/msmtprc
RUN chmod 600 /etc/msmtprc

#change owner to php-fpm process
RUN chown www-data:www-data /etc/msmtprc
RUN chmod 600 /etc/msmtprc

#for testing
COPY send.php /scripts/send.php

COPY mail.ini $PHP_INI_DIR/conf.d/mail.ini


