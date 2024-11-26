<<<<<<< HEAD
<?php


session_start();

$pdo;
function conexion()
{
    global $pdo;
    try {
        $pdo = new PDO('mysql:host=localhost:3307;dbname=proyecto-aeropuerto', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('SET NAMES "utf8"');
    } catch (PDOException $e) {
        echo 'Error en la conexión: ' . $e->getMessage();
    }
}

conexion();

function comprobaruser($user, $password)
{
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombre = :user AND contraseña = :password");
        $stmt->bindParam(':user', $user);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "El usuario $user existe.";
        } else {
            echo "El usuario $user no existe.";
        }
    } catch (PDOException $e) {
        echo 'Error en la consulta: ' . $e->getMessage();
    }
}
=======
>>>>>>> 350cbeac4f31d825c24ac0c0fe67b01c2fc09763
