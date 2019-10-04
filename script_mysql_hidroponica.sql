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
add Ph_water float, 
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




