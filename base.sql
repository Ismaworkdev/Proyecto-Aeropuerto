
DROP TABLE usuarios CASCADE CONSTRAINTS;
DROP TABLE vuelos CASCADE CONSTRAINTS;
DROP TABLE viajes CASCADE CONSTRAINTS;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT,
    nombre VARCHAR2(50) PRIMARY KEY,
    contraseña VARCHAR2(50),
    rol VARCHAR2(20),
    email VARCHAR2(100)
);
CREATE TABLE vuelos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa VARCHAR2(50),
    aeropuerto_origen VARCHAR2(100),
    aeropuerto_destino VARCHAR2(100),
    tiempo_estimado VARCHAR2(50),
    max_pasajeros INT CHECK (max_pasajeros <= 100),
    precio VARCHAR2 (10, 2) ,
    Fecha DATE,
    hora TIME
);
CREATE TABLE viajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_nombre VARCHAR(50),
    vuelo_id INT,
   CONSTRAINT FOREIGN KEY (usuario_nombre) REFERENCES usuarios(nombre),
  CONSTRAINT  FOREIGN KEY (vuelo_id) REFERENCES vuelos(id)
 
);
INSERT INTO usuarios (id, nombre, contraseña, rol, email) VALUES
(1, 'admin', 'admin', 'A', 'admin.admin@gmail.com'),
(2, 'juanperez', 'ahh', 'B', 'juan.perez@gmail.com'),
(2, 'mariagomez', 'lol', 'B', 'maria.gomez@gmail.com'),
(3, 'carloslopez', 'lol1', 'B', 'carlos.lopez@gmail.com');


INSERT INTO vuelos (id, empresa, aeropuerto_origen, aeropuerto_destino, tiempo_estimado, max_pasajeros, precio , fecha , hora) VALUES
(1, 'Iberia', 'Aeropuerto Adolfo Suàrez  Madrid-Barajas', 'Aeropuerto Josep Tarradellas Barcelona-El Prat', '02:00:00', 67, '60.00€', SYSDATE + 2, TO_DATE('7:14:00', 'HH24:MI:SS')),
(2, 'Air Europa ', 'Aeropuerto Adolfo Suàrez  Madrid-Barajas', 'Aeropuerto Internacional El Dorado Bogotá, Colombia', '01:30:00', 50, '120.00€' , SYSDATE + 2 , TO_DATE('12:14:00', 'HH24:MI:SS')),
(3, 'air France ', 'Aeropuerto Adolfo Suàrez  Madrid-Barajas', 'Aeropuerto Internacional Jorge Chávez Lima, Perú', '01:45:00', 40, '130.00€' , SYSDATE + 1 ,TO_DATE('10:14:00', 'HH24:MI:SS') );


INSERT INTO viajes (id, usuario_nombre, vuelo_id) VALUES
(1, 'juanperez', 1),
(2, 'mariagomez', 2),
(3, 'carloslopez', 3);
