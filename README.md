# Installation

## Requirements

- [Docker](https://www.docker.com/)

```shell
cp .env.example .env
```

```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

## Run the application

```shell
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate
```

You can go now to [http://localhost](http://localhost) to see the application running.

You have a mail server running also on [http://localhost:8025/](http://localhost:8025/).

# Development

## Run linter :

````shell
./vendor/bin/sail pint
````

## Run tests :

````shell
./vendor/bin/sail test
````
