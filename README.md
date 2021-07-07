# rrhh

Pre-requisites:

copy default configuration (first time only)
term> cp .env.default .env

to build execute (first time only)
term> docker-compose build app

Routine:

to run execute (every time you want to start the servers)
term> docker-compose up

to start frontend (every time you want to user the web app)
term> yarn hot

to shutdown the app (when you are done using it and want to free docker resources)
term>docker-compose down

Updates:

to install dependencies (first time or when there is new dependencies)
term> docker-compose exec app composer install

to update db (when you change the db schema only)
term> docker-compose exec app php artisan migrate

to init db data (when you want to reset initial data only)
term> docker-compose exec app php artisan db:seed

to see logs of a service
term> docker-compose logs nginx
