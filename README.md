## CrediSi

Laravel integrado con Vuejs. Como es un sistema monolitico los "end points" se encuentran en el archivo web.

# Pre-requisites:

copy default configuration (**first time** only)

`term/git/CrediSi> cp .env.default .env`

to build execute (**first time** only)

`term/git/CrediSi> docker-compose build app`

# Routine:

to run execute (**every time you want to start the servers**)

`term/git/CrediSi> docker-compose up`

to start frontend (**every time you want to user the web app**)

`term/git/CrediSi> yarn hot`

to shutdown the app (**when you are done using it** and want to free docker resources)

`term/git/CrediSi>docker-compose down`

# Updates:

to install dependencies (**first time** or **when there is new dependencies**)

`term/git/CrediSi> docker-compose exec app composer install`

`term/git/CrediSi> yarn`

to update db (**when you change the db schema** only)

`term/git/CrediSi> docker-compose exec app php artisan migrate`

to init db data (when you want to **reset initial data** only)

`term/git/CrediSi> docker-compose exec app php artisan db:seed`

**to see logs** of a service

`term/git/CrediSi> docker-compose logs nginx`