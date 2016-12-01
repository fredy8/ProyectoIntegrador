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

create table eventos (
  id bigint(20) unsigned not null auto_increment primary key,
  escuela_id bigint(20) unsigned not null,
  empresa varchar(255) not null,
  gestion varchar(100) not null,
  nombre varchar(100) not null,
  objetivo varchar(400) not null,
  inicio datetime not null,
  fin datetime not null,
  lugar varchar(100) not null,
  tematica varchar(100) not null,
  descripcion varchar(400) not null,
  num_alumnos integer not null,
  num_padres integer not null,
  num_personal integer not null,
  num_voluntarios integer not null,
  institucion varchar(100) not null,
  num_alumnos_servicio integer not null,
  universidad varchar(50) not null,
  empresario bool not null,
  inversion_monetaria_empresa integer not null,
  inversion_especie_empresa varchar(200) not null,
  inversion_monetaria_escuela integer not null,
  inversion_especie_escuela varchar(200) not null,
  otro_tipo_donacion varchar(100) not null,
  correo_electronico varchar(100) not null,
  foreign key (escuela_id) references escuelas(id)
);
