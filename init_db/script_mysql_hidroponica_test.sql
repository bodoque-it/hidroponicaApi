DROP DATABASE IF EXISTS hidroponica;
create database hidroponica;
use hidroponica;

create table users ( id_user int NOT NULL AUTO_INCREMENT,
username varchar(255) NOT NULL,
first_name varchar(255),
last_name varchar(255),
pass_word varchar(255),
email varchar(255),
PRIMARY KEY (id_user) );

create table rails( id_rail int NOT NULL AUTO_INCREMENT,
fk_user int, 
name varchar(255),
location varchar(255),
PRIMARY KEY (id_rail),
FOREIGN KEY (fk_user) REFERENCES users(id_user) );

create table containers( id_container int NOT NULL AUTO_INCREMENT,
fk_user int,
fk_rail int,
volume float,
active BOOLEAN,
name varchar(255),
PRIMARY KEY(id_container),
FOREIGN KEY (fk_user) REFERENCES users(id_user),
FOREIGN KEY (fk_rail) REFERENCES rails(id_rail) );

create table cycles( id_cycle int NOT NULL AUTO_INCREMENT,
PRIMARY KEY (id_cycle));

create table microclimates( id_microclimate int NOT NULL AUTO_INCREMENT,
PRIMARY KEY (id_microclimate));

create table measurements( id_measurement int NOT NULL AUTO_INCREMENT,
PRIMARY KEY (id_measurement));

alter table cycles 
add fk_user int, 
add fk_container int, 
add fk_microclimate int, 
add name varchar(255), 
add start_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
add estimated_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
add end_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
add FOREIGN KEY (fk_user) REFERENCES users(id_user), 
add FOREIGN KEY (fk_container) REFERENCES containers(id_container),
add FOREIGN KEY (fk_microclimate) REFERENCES microclimates(id_microclimate);

alter table microclimates 
add fk_user int, 
add fk_cycle int, 
add name varchar(255), 
add intensity int, 
add type_of_light varchar(255),
add ph_water float,
add daily_hours float, 
add light_start_time float, 
add FOREIGN KEY (fk_user) REFERENCES users(id_user), 
add FOREIGN KEY (fk_cycle) REFERENCES cycles(id_cycle);

alter table measurements 
add fk_cycle int, 
add temperature float, 
add dampness float, 
add present_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
add FOREIGN KEY (fk_cycle) REFERENCES cycles(id_cycle);

INSERT INTO users (username,first_name,last_name,pass_word,email) VALUES ('heinzsiano','Alexander','Oses Runge','123','McFlaco@gmail.com');
INSERT INTO rails(fk_user,name,location) VALUES (1,'chuchu','a');
INSERT INTO rails(fk_user,name,location) VALUES (1,'MostFastWestOld','b');
INSERT INTO containers(fk_user,fk_rail,volume,active,name) VALUES(1,1,300,1,'cont_izq');
INSERT INTO containers(fk_user,fk_rail,volume,active,name) VALUES(1,1,300,0,'frutishas');
INSERT INTO containers(fk_user,fk_rail,volume,active,name) VALUES(1,2,250.8,0,'cont_der');
INSERT INTO cycles(fk_user,fk_container,fk_microclimate,name,start_date,estimated_date,end_date) VALUES(1,1,default,'ciclito',default,default,default);
INSERT INTO microclimates(fk_user,fk_cycle,name,intensity,type_of_light,Ph_water,daily_hours,light_start_time) VALUES(1,1,'Tropical',7,'solarium',17.3,4,6);
INSERT INTO microclimates(fk_user,fk_cycle,name,intensity,type_of_light,Ph_water,daily_hours,light_start_time) VALUES(1,1,'lluvioso',9,'sendo sol',20.6,3,8);
INSERT INTO cycles(fk_user,fk_container,fk_microclimate,name,start_date,estimated_date,end_date) VALUES(1,2,2,'ciclazo',default,default,default);
UPDATE cycles SET fk_microclimate = 1 WHERE id_cycle = 1;
INSERT INTO measurements(fk_cycle,temperature,dampness,present_date) VALUES(1,25.6,13.9,default);
INSERT INTO measurements(fk_cycle,temperature,dampness,present_date) VALUES(2,10.3,25.7,default);



