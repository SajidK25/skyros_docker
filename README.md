# skyros_docker

## Prerequisites
- Docker
- Docker compose plugin
- Nginx docker contaier
- MySQL8

# Installation process

## Step-1: Create an user and give necessary permission 
```
adduser devops
```
```
usermod -aG sudo devops
```
## Step-2: Install docker and docker compose plugin 

Create a file name `docker_setup.sh`
```
nano docker_setup.sh
```
Copy following commands and paste inside `docker_setup.sh`
```
#!/bin/bash
sudo apt update -y
sudo apt install -y apt-transport-https ca-certificates curl software-properties-common
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg
echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
sudo apt update -y
sudo apt install docker-ce -y
sudo curl -L "https://github.com/docker/compose/releases/download/1.29.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
sudo ln -s /usr/local/bin/docker-compose /usr/bin/docker-compose
```
Press ***ctrl+s*** to save and then press ***ctrl+x*** to exit nano

Give execution permission to the file `docker_setup.sh`
```
sudo chmod +x docker_setup.sh
```
Then execute to install docker
```
./docker_setup.sh
```
After installation complete give following commands
```
sudo usermod -aG docker ${USER}
su - ${USER}
```
give sudo password and then check the docker version

```
docker --version
```

## Step-3: Create a docker network named `skyros_net`.
```
docker network create skyros_net
```
This network will be used by the all containers.

## Step-4: Install MySQL8
```
git clone --branch=mysqldb https://github.com/SajidK25/skyros_docker.git mysqldb
```
```
cd mysqldb

docker compose up -d
```
After creating `MySQL` and `PhpMyAdmin`containers. You can access database using following URL:_

    - http://95.217.236.223:8081/
    - server: mysql
    - user: root

Restore database backup:-

    # Select DB - skyros
    # Click on -> import
    # Chose file -> backup.sql
    # Click on -> import
    # Select table - minisite -> domain -> testskyros.ibserver.gr

## Step-5: Deploy Skyros containers
```shell
git clone --branch=skyros https://github.com/SajidK25/skyros_docker.git skyros

cd skyros/
```
Change `NGINX_HOST`on the `.env` file

    nano .env # NGINX_HOST= testskyros.ibserver.gr

```shell
docker compose up -d
```

## Step-6: Deploy Nginx

```shell
git clone --branch=nginx https://github.com/SajidK25/skyros_docker.git nginx-proxy

cd nginx-proxy/
```
```
nano etc/nginx/default.conf
```
```shell
upstream skyros {
  server        skyros_web:80;
}

server {
  listen 80;
  listen [::]:80;
  server_name   testskyros.ibserver.gr;

  location / {
    proxy_pass  http://skyros;
  }
}

```
```shell
nano etc/nginx/httpd.conf
```
```shell
upstream httpd {
  server        httpd:80;
}

server {
  listen 80;
  listen [::]:80;
  server_name   httpd.ibserver.gr;

  location / {
    proxy_pass  http://httpd;
  }
}
```

## Step-7: Deploy a Apache(httpd) server

```shell
mkdir apache2 && cd apache2
```
create a docker compose config file
```
nano docker-compose.yml
```
```shell
version: '3'
services:
    httpd:
        image: httpd:2.4
        container_name: httpd
        volumes:
            - ./:/usr/local/apache2/htdocs/
        ports:
            - "8080:80"
  
        restart: always
        networks:
            - skyros_net
networks:
    skyros_net:
        external: true
        driver: bridge
```
Create a `index` file for test the Apache server

```
nano index.html
```
```
<html>
<h1>Hello from Apache 2 webserver</h1>
</html>
```
Create the Apache container
```
docker compose up -d
```

### Test the containers

Access Skyros container on a browser

```shell
http://testskyros.ibserver.gr
```

Access Apache container on a browser

```shell
http://httpd.ibserver.gr
```

