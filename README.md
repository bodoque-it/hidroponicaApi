# HidroponicaApi- API REST para el proyecto hidroponica

Comienza por copiar el archivo .env.example y rellena tus credenciales en el archivo .env, esto aplica a ambos metodos

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