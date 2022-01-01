### Add dhparam key
mkdir dhparam
cd dhparam
openssl dhparam -out `pwd`/dhparam-2048.pem 2048


### check if credentials have been mounted to the webserver
docker-compose exec webserver ls -la /etc/nginx/ssl/live