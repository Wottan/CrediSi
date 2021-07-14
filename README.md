## rrhh

# Pre-requisites:

copy default configuration (**first time** only)

`term/git/persona> cp .env.default .env`

to build execute (**first time** only)

`term/git/persona> docker-compose build app`

# Routine:

to run execute (**every time you want to start the servers**)

`term/git/persona> docker-compose up`

to start frontend (**every time you want to user the web app**)

`term/git/persona> yarn hot`

to shutdown the app (**when you are done using it** and want to free docker resources)

`term/git/persona>docker-compose down`

# Updates:

to install dependencies (**first time** or **when there is new dependencies**)

`term/git/persona> docker-compose exec app composer install`

`term/git/persona> yarn`

to update db (**when you change the db schema** only)

`term/git/persona> docker-compose exec app php artisan migrate`

to init db data (when you want to **reset initial data** only)

`term/git/persona> docker-compose exec app php artisan db:seed`

**to see logs** of a service

`term/git/persona> docker-compose logs nginx`
