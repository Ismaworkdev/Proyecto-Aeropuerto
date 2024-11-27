CREATE TABLE usuarios (
    nombre VARCHAR(50) PRIMARY KEY,
    contraseña VARCHAR(50),
    rol VARCHAR(20),
    email VARCHAR(100)
);
CREATE TABLE vuelos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa VARCHAR(50),
    aeropuerto_origen VARCHAR(100),
    aeropuerto_destino VARCHAR(100),
    tiempo_estimado TIME,
    max_pasajeros INT CHECK (max_pasajeros <= 100),
    precio DECIMAL(10, 2),
    fecha DATE,
    hora TIME
);
CREATE TABLE viajes (
    usuario_nombre VARCHAR(50),
    vuelo_id INT,
    PRIMARY KEY (usuario_nombre, vuelo_id),
    CONSTRAINT FOREIGN KEY (usuario_nombre) REFERENCES usuarios(nombre),
    CONSTRAINT FOREIGN KEY (vuelo_id) REFERENCES vuelos(id)
);


INSERT INTO usuarios ( nombre, contraseña, rol, email) VALUES
( 'admin', 'admin', 'A', 'admin.admin@gmail.com'),
( 'juanperez', 'ahh', 'B', 'juan.perez@gmail.com'),
( 'mariagomez', 'lol', 'B', 'maria.gomez@gmail.com'),
( 'carloslopez', 'lol1', 'B', 'carlos.lopez@gmail.com');
INSERT INTO vuelos (id, empresa, aeropuerto_origen, aeropuerto_destino, tiempo_estimado, max_pasajeros, precio, fecha, hora) VALUES
(1, 'Iberia', 'Aeropuerto Adolfo Suárez Madrid-Barajas', 'Aeropuerto Josep Tarradellas Barcelona-El Prat', '02:00:00', 67, 60.00, '2024-10-22', '07:14:00'),
(2, 'Air Europa', 'Aeropuerto Adolfo Suárez Madrid-Barajas', 'Aeropuerto Internacional El Dorado Bogotá, Colombia', '01:30:00', 50, 120.00, '2024-10-22', '12:14:00'),
(3, 'Air France', 'Aeropuerto Adolfo Suárez Madrid-Barajas', 'Aeropuerto Internacional Jorge Chávez Lima, Perú', '01:45:00', 40, 130.00, '2024-10-21', '10:14:00');
INSERT INTO viajes ( usuario_nombre, vuelo_id) VALUES
( 'juanperez', 1),
( 'mariagomez', 2),
( 'carloslopez', 3);
