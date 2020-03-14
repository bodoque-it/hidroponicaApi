# HidroponicaApi- API REST para el proyecto hidroponica

Luego de clonar se debe correr

```
composer install
```
para instalar las dependecias 

Luego copia el archivo .env.example en .env y rellena tus credenciales de tus mysql local 

- MYSQL_HOST=localhost
- MYSQL_PORT=3306
- MYSQL_DATABASE=doctrine_h
- MYSQL_USER=root
- MYSQL_PASSWORD=

luego de eso crea un base de datos en mysql con el mismo nombre de MYSQL_DATABASE

```mysql -u root -p ``` o ```  sudo mysql -u root -p  ```

por ejemplo  ejecutar 
```sql
CREATE DATABASE doctrine_h;
```
para terminar esta parte carga las variables de entorno con el comando loadenv(deberia estar en tu .bashrc o .zshrc)
NOTA: es este
```
loadenv()
{
if [ -f .env ]
then
  export $(cat .env | sed 's/#.*//g' | xargs)
fi
}

```

## Doctrine ORM
Si es la primera vez que corres la base de datos usa
```
vendor/bin/doctrine orm:schema-tool:create
```
esto busca en la carpeta vendor y corre el setup inicial de doctrine
cada vez que se actualizen los modelos de la base de datos se debe usar

```
vendor/bin/doctrine orm:schema-tool:update --force
```

si todo sale bien es necesario levantar el servidor con 
```bash
composer start 
```
Esto inicia el servidor de desarrollo en localhost:8080
el puerto se puede editar en el composer.json en la llave scripts