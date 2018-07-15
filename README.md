# Test task "Add payment system to store"

## Requirements

You need [Docker Engine](https://docs.docker.com/engine/) and [Docker Compose](https://docs.docker.com/compose/) installed on your machine.

## Quick start

```sh
# boot containers
docker-compose up -d

# run Symfony console
./console

```

### Map a different host port

By default, the web server will be mapped to host port `80`, but specifying another port is as easy as:

```
EXTERNAL_PORT=8000 docker-compose up -d
```

Create table and add data
```
./console doctrine:migrations:migrate
./console doctrine:fixtures:load --append
```

In case of 404 use the next command
```
./console cache:clear --env=prod
```