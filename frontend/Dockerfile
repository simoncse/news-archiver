FROM nginx:latest as dev




#
# Frontend (Compiling SASS and JS)
#

FROM node:14.9 as frontend


USER node
RUN mkdir -p /home/node/app
WORKDIR /home/node/app

COPY --chown=node:node package*.json ./
COPY --chown=node:node webpack.*.js ./

RUN npm install

COPY --chown=node:node . .

RUN npm run production



FROM dev as final

WORKDIR /var/www

COPY --from=frontend /home/node/public/js/ ./public/js/
COPY --from=frontend /home/node/public/css/ ./public/css/

