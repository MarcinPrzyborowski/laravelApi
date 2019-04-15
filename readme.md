##

1. docker-compose exec php composer install
2. docker-compose exec php ./artisan migrate
3. docker-compose exec php ./artisan db:seed
3. docker-compose exec php ./artisan jwt:secret