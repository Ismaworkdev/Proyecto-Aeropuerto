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



function cambiarContrasena($usuario, $contrasenaAntigua, $nuevaContrasena) {
    global $pdo; 

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombre = :usuario");
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuarioData['contraseña'] === $contrasenaAntigua) {
            $updateStmt = $pdo->prepare("UPDATE usuarios SET contraseña = :nueva_contrasena WHERE nombre = :usuario");
            $updateStmt->bindParam(':nueva_contrasena', $nuevaContrasena);
            $updateStmt->bindParam(':usuario', $usuario);
            $updateStmt->execute();

            return true;
        }
    }

    return false;
}


function cambiarUsuario($usuarioAntiguo, $contrasena, $usuarioNuevo) {
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombre = :usuarioAntiguo");
    $stmt->bindParam(':usuarioAntiguo', $usuarioAntiguo);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuarioData['contraseña'] === $contrasena) {
            $updateStmt = $pdo->prepare("UPDATE usuarios SET nombre = :usuarioNuevo WHERE nombre = :usuarioAntiguo");
            $updateStmt->bindParam(':usuarioNuevo', $usuarioNuevo);
            $updateStmt->bindParam(':usuarioAntiguo', $usuarioAntiguo);
            $updateStmt->execute();
            return true;
        }
    }

    return false;
}
?>