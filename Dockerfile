#
# PHP Composer Dependencies
#

FROM composer:2.0 as composer


COPY php/composer.json /app
COPY php/composer.lock /app

RUN composer install



#
# Main PHP APP
#

FROM php:7.4-fpm

WORKDIR /var/www

# Load composer vendor
COPY --from=composer /app/vendor/ ./vendor/


# Dependencies
RUN apt-get update \
 && apt-get install -y -q --no-install-recommends \
    msmtp \
    libpq-dev\
 && apt-get clean \
 && rm -r /var/lib/apt/lists/*

# For PostgreSQL
RUN docker-php-ext-install pdo pdo_pgsql

# Set up mail config for msmtp
COPY php/msmtprc /etc/msmtprc
RUN chmod 600 /etc/msmtprc

#change mail owner to php-fpm process
RUN chown www-data:www-data /etc/msmtprc
RUN chmod 600 /etc/msmtprc

#just a script to test mail function
COPY php/send.php /scripts/send.php

#set up PHP to use msmtp to send mails 
COPY php/mail.ini $PHP_INI_DIR/conf.d/mail.ini


