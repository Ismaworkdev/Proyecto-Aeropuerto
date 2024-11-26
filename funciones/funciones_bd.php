
<?php


session_start();
$erro = false;
$pdo;
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

function comprobaruser($user, $password)
{
    global $pdo;
    global $erro;
    try {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombre = :user AND contraseña = :password");
        $stmt->bindParam(':user', $user);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "El usuario $user existe.";
            $erro = false;
            if ($user == "admin") {
                header("Location:Vistaadmin/admin.php");
            } else {

                header("Location:Vistauser/user.php");
            }
        } else {
            echo "El usuario $user no existe.";
            $erro = true;
        }
    } catch (PDOException $e) {
        echo 'Error en la consulta: ' . $e->getMessage();
    }
}
function mostrarerroresuser()
{
    global $erro;
    if ($erro == false) {
        print "   <span class='error'>  </span>";
    } else {
        print "   <span class='error'>  Usuario iniexistente  . </span>";
    }
};
