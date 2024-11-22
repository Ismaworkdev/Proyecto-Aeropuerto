-- Crear tabla Aerolíneas
CREATE TABLE Aerolineas (
    ID_Aerolinea INT PRIMARY KEY,
    Nombre_Aerolinea VARCHAR(100) NOT NULL
);

-- Insertar datos en la tabla Aerolíneas
INSERT INTO Aerolineas (ID_Aerolinea, Nombre_Aerolinea) VALUES
(1, 'Aeromexico'),
(2, 'Iberia'),
(3, 'Delta Airlines'),
(4, 'American Airlines'),
(5, 'Lufthansa');

-- Crear tabla Vuelos
CREATE TABLE Vuelos (
    ID_Vuelo INT PRIMARY KEY,
    Aerolinea INT,
    Hora TIME,
    Lugar_Origen VARCHAR(100),
    Lugar_Destino VARCHAR(100),
    FOREIGN KEY (Aerolinea) REFERENCES Aerolineas(ID_Aerolinea)
);

-- Insertar datos en la tabla Vuelos
INSERT INTO Vuelos (ID_Vuelo, Aerolinea, Hora, Lugar_Origen, Lugar_Destino) VALUES
(101, 1, '08:00:00', 'CDMX', 'Nueva York'),
(102, 2, '09:30:00', 'Madrid', 'Buenos Aires'),
(103, 3, '10:45:00', 'Atlanta', 'Los Angeles'),
(104, 4, '11:30:00', 'Miami', 'Cancún'),
(105, 5, '13:00:00', 'Frankfurt', 'Mexico City'),
(106, 1, '14:15:00', 'Monterrey', 'Cancún'),
(107, 3, '15:00:00', 'New York', 'Boston'),
(108, 2, '16:20:00', 'Barcelona', 'Paris'),
(109, 4, '17:10:00', 'Dallas', 'Chicago'),
(110, 5, '18:00:00', 'Berlin', 'Los Angeles');

-- Crear tabla Admins
CREATE TABLE Admins (
    ID_Admin INT PRIMARY KEY,
    Rol VARCHAR(50),
    Nombre VARCHAR(50),
    Apellidos VARCHAR(50),
    Telefono VARCHAR(20),
    Email VARCHAR(100)
);

-- Insertar datos en la tabla Admins
INSERT INTO Admins (ID_Admin, Rol, Nombre, Apellidos, Telefono, Email) VALUES
(1, 'Admin', 'Laura', 'Pérez', '555-1234', 'laura@empresa.com'),
(2, 'Admin', 'Roberto', 'García', '555-5678', 'roberto@empresa.com');

-- Crear tabla Clientes
CREATE TABLE Clientes (
    ID_Cliente INT PRIMARY KEY,
    Rol VARCHAR(50),
    Nombre VARCHAR(50),
    Apellidos VARCHAR(50),
    Telefono VARCHAR(20),
    Email VARCHAR(100)
);

-- Insertar datos en la tabla Clientes
INSERT INTO Clientes (ID_Cliente, Rol, Nombre, Apellidos, Telefono, Email) VALUES
(1, 'Cliente', 'Juan', 'González', '555-0001', 'juan@cliente.com'),
(2, 'Cliente', 'María', 'López', '555-0002', 'maria@cliente.com'),
(3, 'Cliente', 'Pedro', 'Martínez', '555-0003', 'pedro@cliente.com'),
(4, 'Cliente', 'Ana', 'Hernández', '555-0004', 'ana@cliente.com'),
(5, 'Cliente', 'Carlos', 'Rodríguez', '555-0005', 'carlos@cliente.com'),
(6, 'Cliente', 'Sofia', 'Pérez', '555-0006', 'sofia@cliente.com'),
(7, 'Cliente', 'Luis', 'Sánchez', '555-0007', 'luis@cliente.com'),
(8, 'Cliente', 'Valeria', 'Ramírez', '555-0008', 'valeria@cliente.com'),
(9, 'Cliente', 'Eduardo', 'Torres', '555-0009', 'eduardo@cliente.com'),
(10, 'Cliente', 'Mariana', 'Díaz', '555-0010', 'mariana@cliente.com');
