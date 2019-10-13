# HidroponicaApi- API REST para el proyecto hidroponica

## Para probar necesario levantar docker

```bash
docker-compose up
```
##localmente

Comienza por copiar el archivo .env.example

```bash
cp .env.example .env
 ```
 Rellena con tus credenciales y luego levanta el servidor basico de php

```bash
php -S localhost:8080 -t public public/index.php
```
