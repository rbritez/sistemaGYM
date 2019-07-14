drop database if exists gimnasio;

create database gimnasio;

use gimnasio;

create table personas (
	id INT auto_increment not null primary key,
	apellido_nombre varchar(255) not null,
	dni varchar(64) not null,
	domicilio text not null
);

create table turnos (
	id int auto_increment not null primary key,
	descripcion varchar(255)
);

insert into turnos (descripcion) values ('Mañana'), ('Tarde');

create table empleados (
	id int auto_increment not null primary key,
	persona_id int not null references personas(id),
	turno_id int not null references turnos(id)
);

create table planes (
	id int auto_increment not null primary key,
	descripcion varchar(255) not null,
	precio decimal(8,2) not null check (precio > 0)
);

create table rutinas (
	id int auto_increment not null primary key,
	descripcion varchar(255) not null
);

create table maquinas (
	id int auto_increment not null primary key,
	descripcion varchar(255) not null,
	estado varchar(255) not null
);

create table clientes (
	id int auto_increment not null primary key,
	persona_id int not null references personas(id)
);

create table inscripciones (
	id int auto_increment not null primary key,
	cliente_id int not null references clientes(id),
	plan_id int not null references planes(id),
	rutina_id int not null references rutinas(id),
	empleado_id int not null references empleados(id),
	fecha datetime not null default now()
);

create table pagos (
	id int auto_increment not null primary key,
	cliente_id int not null references clientes(id),
	empleado_id int not null references empleados(id),
	plan_id int not null references planes(id),
	monto decimal(8,2) not null check (monto > 0.00),
	fecha datetime not null default now()
);

create table rutina_maquinas (
	id int auto_increment not null primary key,
	rutina_id int not null references rutinas(id),
	maquina_id int not null references maquinas(id)
);

create table ingresos (
	id int auto_increment not null primary key,
	empleado_id int not null references empleados(id),
	turno_id int not null references turnos(id),
	fecha datetime not null default now()
);