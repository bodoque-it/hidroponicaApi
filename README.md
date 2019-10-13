# HidroponicaApi- API REST para el proyecto hidroponica

Comienza por copiar el archivo .env.example en .env y rellena tus credenciales en el archivo si es en local
,si se usa docker cambia el host por "db"


```bash
cp .env.example .env
 ```
## Docker
```bash
docker-compose up
```

## localmente

```bash
php -S localhost:8080 -t public public/index.php
```
esto levantara la api el localhost:8080