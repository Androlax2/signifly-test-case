# Installation

## Requirements

- [Composer](https://getcomposer.org/)
- [Docker](https://www.docker.com/)

```shell
composer install
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

## Run linter :

````shell
./vendor/bin/sail test
````
