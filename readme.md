# Simple Api

Laravel PHP project 

## Requirements

**Docker**

[Instalation for mac](https://docs.docker.com/docker-for-mac/install/)

[Instalation for windows](https://docs.docker.com/docker-for-windows/install/)


### Running docker container

The default databases configuration for running locally is already configured, so just run:

```
docker-compose up -d --build
```


After running the docker compose setup you should run the commands below to set up the project.

### Installing Composer packages

```
docker-compose exec php composer install
```

### Create .env file
```
    cp .env.dist .env
```

### Generating key and optimizing app
```
# needed for generating application app key 
docker-compose exec php ./artisan key:generate
```

### Running laravel commands in docker
```
docker-compose exec php ./artisan migrate
docker-compose exec php ./artisan db:seed
docker-compose exec php ./artisan jwt:secret
```

### Running tests
```
docker-compose exec php ./vendor/bin/phpunit
```

### Accessing the app

- [POSTMAN DOCUMENTATION ALL ENDPOINTS](https://documenter.getpostman.com/view/702958/S1EQUdg5)
- Navigate to [http://localhost](http://localhost) or configurated custom url
- Login - if `db:seed` command has been run, you can login with `admin`/`admin` credentials)