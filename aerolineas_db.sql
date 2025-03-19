CREATE DATABASE aerolineas_db;
USE aerolineas_db;

CREATE TABLE reservas (
    reserva int(10) PRIMARY KEY,
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    email VARCHAR(100),
    telefono  VARCHAR(50),
    documento VARCHAR(50),
    destino VARCHAR(50),
    aerolinea VARCHAR(50),
    tipo_vuelo VARCHAR(50),
    menu VARCHAR(50),
    horario VARCHAR(50),
    idaVuelta VARCHAR(50),
    pasajeros int(5),
    detalle VARCHAR(100),
    precio_total Decimal(10,2),
    tipo_tarjeta VARCHAR(50)
);

