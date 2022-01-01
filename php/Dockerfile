#
# PHP Composer Dependencies
#

FROM composer:2.0 as composer


COPY composer.json /app
COPY composer.lock /app

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

# For PostgreSQL connection
RUN docker-php-ext-install pdo pdo_pgsql

# Set up mail config for msmtp
COPY msmtprc /etc/msmtprc
RUN chmod 600 /etc/msmtprc

#change mail owner to php-fpm process
RUN chown www-data:www-data /etc/msmtprc
RUN chmod 600 /etc/msmtprc

#just a script to test mail function
COPY send.php /scripts/send.php

#set up PHP to use msmtp to send mails 
COPY mail.ini $PHP_INI_DIR/conf.d/mail.ini


