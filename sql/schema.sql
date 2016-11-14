create database circulo_virtuoso;
use circulo_virtuoso;

create table users (
  id bigint(20) unsigned not null auto_increment primary key,
  email varchar(255) not null unique,
  password varchar(61) not null,
  approved bool default false
);
