#!/bin/bash
now=$(date)
echo "$now"
COMPOSE="/usr/local/bin/docker-compose --no-ansi"
DOCKER="/usr/bin/docker"

cd /home/simon/web/news-archiver/site/
$COMPOSE run certbot renew && $COMPOSE kill -s SIGHUP webserver


