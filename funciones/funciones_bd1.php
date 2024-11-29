<?php


function conexion()
{
    global $pdo;
    try {
        $pdo = new PDO('mysql:host=localhost:3306;dbname=proyecto-aeropuerto', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('SET NAMES "utf8"');
    } catch (PDOException $e) {
        echo 'Error en la conexión: ' . $e->getMessage();
    }
}

conexion();


function insertuser($nombre, $correo, $password) {
    global $pdo;
    
    try {

        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombre = :nombre OR email = :email");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $correo);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            echo "El usuario o correo ya están registrados.";
            return false;
        }

        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, contraseña) VALUES (:nombre, :email, :password)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $correo);
        $stmt->bindParam(':password', $password);
        
        if ($stmt->execute()) {
            echo "Usuario registrado exitosamente.";
            return true;
        } else {
            echo "Error al registrar el usuario.";
            return false;
        }
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
        return false;
    }
}

?>