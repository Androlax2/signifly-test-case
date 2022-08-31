# Requirements

- [Docker](https://www.docker.com/)
- [NPM](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm)

### Vite

Install `vite` globally (if it's not already installed) :

```shell
npm i -g vite
```

# Installation

```shell
cp .env.example .env
```

If you are on Windows, copy `.env.example` to `.env`

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
./vendor/bin/sail artisan key:generate
npm install
npm run build
```

```shell
./vendor/bin/sail artisan migrate
```

If you have an error **SQLSTATE[HY000] [2002] Connection refused**, re run it (it is because the mysql container is not already up)

- You can go now to [http://localhost](http://localhost) to see the application running.
- Administration URL is by default : [http://localhost/administration](http://localhost/administration)
- You have a mail server running also on [http://localhost:8025/](http://localhost:8025/).

# Development

## Run linter :

````shell
./vendor/bin/sail pint
````

## Run tests :

````shell
./vendor/bin/sail test
````
