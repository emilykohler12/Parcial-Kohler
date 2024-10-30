Create database ek_ahorcado;
Use ek_ahorcado;

Create table ek_palabras (
id_palabras int primary key auto_increment,
palabra varchar(50) not null,
categoria varchar(50) default null
);

Create table ek_jugadores (
id_jugadores int primary key auto_increment,
usuario VARCHAR(50) UNIQUE NOT NULL,
contraseña VARCHAR(255) NOT NULL
);

CREATE TABLE ek_jugadas (
    id_jugadas int primary key auto_increment,
    id_jugadores int,
    palabra varchar(50) not null,
    resultado varchar(50) not null,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_jugadores) REFERENCES ek_jugadores(id_jugadores) ON DELETE CASCADE
);


INSERT INTO ek_palabras (palabra, categoria) VALUES
('gato', 'animales'),
('perro', 'animales'),
('manzana', 'frutas'),
('carro', 'objetos'),
('flor', 'naturaleza'),
('rojo', 'colores'),
('dulce', 'sabores');

INSERT INTO ek_jugadores (usuario, contraseña) VALUES 
('emi', '2602'),
('jugador1', '$2y$10$JdJ/lc4AfWQ2KFlIc9Zj6eIokG5bdyD6I/0sM0G19X1uq8MwFwziC'), -- contraseña: 123456
('jugador2', '$2y$10$gB1K6K5j79AhExQ8pD5g0uBwpOgjzHtvDg89YeEtbLRc1pZZX7vLi');  -- contraseña: 123456