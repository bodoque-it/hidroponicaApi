DROP DATABASE IF EXISTS test_h;
create database test_h;
use test_h;

create table Usuario ( id_user int NOT NULL AUTO_INCREMENT,
Username varchar(255) NOT NULL,
first_name varchar(255),
last_name varchar(255),
Contraseña varchar(255),
Email varchar(255),
PRIMARY KEY (id_user) );

create table Rieles( id_riel int NOT NULL AUTO_INCREMENT,
fk_user int, 
Nombre varchar(255),
Ubicacion varchar(255),
PRIMARY KEY (id_riel),
FOREIGN KEY (fk_user) REFERENCES Usuario(id_user) );

create table Contenedores( id_contenedor int NOT NULL AUTO_INCREMENT,
fk_user int,
fk_riel int,
Volumen float,
Activo BOOLEAN,
Nombre varchar(255),
PRIMARY KEY(id_contenedor),
FOREIGN KEY (fk_user) REFERENCES Usuario(id_user),
FOREIGN KEY (fk_riel) REFERENCES Rieles(id_riel) );

create table Ciclos( id_ciclo int NOT NULL AUTO_INCREMENT,
PRIMARY KEY (id_ciclo));

create table Microclimas( id_microclima int NOT NULL AUTO_INCREMENT,
PRIMARY KEY (id_microclima));

create table Mediciones( id_medicion int NOT NULL AUTO_INCREMENT,
PRIMARY KEY (id_medicion));

alter table Ciclos 
add fk_user int, 
add fk_contenedor int, 
add fk_microclima int, 
add Nombre varchar(255), 
add Fecha_inicio TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
add Fecha_estimada TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
add Fecha_termino TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
add FOREIGN KEY (fk_user) REFERENCES Usuario(id_user), 
add FOREIGN KEY (fk_contenedor) REFERENCES Contenedores(id_contenedor),
add FOREIGN KEY (fk_microclima) REFERENCES Microclimas(id_microclima);

alter table Microclimas 
add fk_user int, 
add fk_ciclo int, 
add Nombre varchar(255), 
add Intensidad int, 
add Tipo_de_luz varchar(255), 
add Ph_agua float, 
add Horas_diarias float, 
add Hora_inicio_luz float, 
add FOREIGN KEY (fk_user) REFERENCES Usuario(id_user), 
add FOREIGN KEY (fk_ciclo) REFERENCES Ciclos(id_ciclo);

alter table Mediciones 
add fk_ciclo int, 
add Temperatura float, 
add Humedad float, 
add Fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
add FOREIGN KEY (fk_ciclo) REFERENCES Ciclos(id_ciclo);



