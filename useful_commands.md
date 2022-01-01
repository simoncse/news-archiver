### Add dhparam key
mkdir dhparam
cd dhparam
openssl dhparam -out `pwd`/dhparam-2048.pem 2048


### check if credentials have been mounted to the webserver
docker-compose exec webserver ls -la /etc/nginx/ssl/live
sudo ls certbot/conf/live/;

### force recreate certificate request
docker-compose up --force-recreate --no-deps certbot


### Renewing Certificates

~/project/ssl_renew.sh

``` bash 
#!/bin/bash

COMPOSE="/usr/local/bin/docker-compose --no-ansi"
DOCKER="/usr/bin/docker"

cd /home/sammy/project/
$COMPOSE run certbot renew --dry-run && $COMPOSE kill -s SIGHUP webserver
$DOCKER system prune -af
```
- Remove --dry-run in production.

#### crontab 
sudo crontab -e
*/5 * * * * {ABOSOLUTE_PATH}/ssl_renew.sh >> {ABOSOLUTE_PATH}/ssl_renew.log 2>&1

#### check cron log 
cd to working dir
tail -f ssl_renew.log

