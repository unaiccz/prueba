DROP DATABASE IF EXISTS prueba;
CREATE DATABASE IF NOT EXISTS prueba;
USE prueba;

CREATE TABLE IF NOT EXISTS restaurantes (
    id_restaurante INT PRIMARY KEY AUTO_INCREMENT,
    nombre_restaurante VARCHAR(255) NOT NULL,
    direccion VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS mascotas (
    id_mascota INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nombre_mascota VARCHAR(90) NOT NULL,
    edad INT NOT NULL
);

CREATE TABLE IF NOT EXISTS contactos (
    id_contacto INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nombre_contacto VARCHAR(90) NOT NULL,
    telefono VARCHAR(9) NOT NULL,
    id_restaurante INT NOT NULL,
    id_mascota INT,
    FOREIGN KEY (id_restaurante) REFERENCES restaurantes(id_restaurante) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_mascota) REFERENCES mascotas(id_mascota) ON DELETE SET NULL ON UPDATE CASCADE
);

INSERT INTO restaurantes (nombre_restaurante, direccion) VALUES
('Restaurante A', 'Calle 1, Ciudad'),
('Restaurante B', 'Calle 2, Ciudad'),
('Restaurante C', 'Calle 3, Ciudad'),
('Restaurante D', 'Calle 4, Ciudad');

INSERT INTO mascotas (nombre_mascota, edad) VALUES
('Firulais', 3),
('Max', 5),
('Bella', 2),
('Luna', 4);

INSERT INTO contactos (nombre_contacto, telefono, id_restaurante, id_mascota) VALUES
('Juan Pérez', '123456789', 1, 1),
('María López', '987654321', 2, 2),
('Carlos Gómez', '456123789', 3, 3),
('Ana Martínez', '321789654', 4, 4);