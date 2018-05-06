# Docker compose demo 

## Intro

### Why using docker-compose?

1. you can configure all the settings to save the time for writing the long docker build and run command.

2. you can define dependencies such as the site depends on the api

3. the containers can use syboml defined in docker compose so that they can talk to each other.

### How is this demo organized?

Using Flask as api on the Backend, Using php with html as site on the front end, to mock up a vertical web-application by using docker compose

## Note

* Using python:3.6.5-onbuild will automaticlly install all the packages in the requirements.txt

## Steps

1. Finish Dockerfile and src files of flask for the api，then write the docker-compose for the backend part and test:

```yml
version: '3'

services:
  product-service:
    build: ./api
    volumes:
      - ./api/src:/usr/src/app
    ports:
      - 6001:80
```

then `docker-compose up` and you can use [localhost:6001](http://localhost:6001) to test.

* notice that if you change anything in the api.py file while the container is still running, the service will be automaticlly refreshed.

2. Finish src files of php for the site, then complement the docker-compose file for the front end part

* notice that we don't create a Dockerfile for the site here, because we can use the existing image we created before for the php

and then we just need to add the rest part of the docker-compose file

```yml
  website:
    image: php:apache
    volumes: 
      - ./site:/var/www/html
    ports:
      - 5001:80
    depends_on:
      - product-service

```

* and to run docker-compose in the background, we just need to use `docker-compose up -d`. To check if there is currently running docker container, use `docker ps`. And to stop the background process, we just need to run `docker-compose stop`.

* to rebuild, use `docker-compose build`