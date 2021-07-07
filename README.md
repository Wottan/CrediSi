# rrhh

copy default configuration
term> cp .env.default to .env

to build execute
term> docker-compose build app

to run execute
term> docker-compose up

to install dependencies
term> docker-compose exec app composer install

to update db
term> docker-compose exec app php artisan migrate

to init db data (only the first time)
term> docker-compose exec app php artisan db:seed

to start frontend
term> yarn hot

to see logs of a service
term> docker-compose logs nginx

to shutdown the app
term>docker-compose down


