# rrhh

copy .env.default to .env

to build execute
term> docker-compose build app

to run execute
term> docker-compose up

to install dependencies
term> docker-compose exec app composer install

to encrypt sessions
term> docker-compose exec app php artisan key:generate

to see logs of a service
term> docker-compose logs nginx

to shutdown the app
term>docker-compose down


