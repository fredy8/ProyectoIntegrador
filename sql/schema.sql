create database circulo_virtuoso;
use circulo_virtuoso;

create table users (
  id bigint(20) unsigned not null auto_increment primary key,
  email varchar(255) not null unique,
  password varchar(61) not null,
  approved bool default false
);

create table escuelas (
  id bigint(20) unsigned not null auto_increment primary key,
  nombre varchar(255) not null unique,
  director varchar(100) not null,
  nivel varchar(30) not null,
  turno varchar(30) not null,
  sostenimiento varchar(30) not null,
  direccion varchar(255) not null,
  region varchar(30) not null,
  fecha date not null,
  alumnos INTEGER not null,
  comentarios varchar(500) not null
);
