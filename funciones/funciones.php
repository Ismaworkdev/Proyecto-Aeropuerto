<?php

$error = null;
$empty = null;

/**
 * Encargado de mostrar de comprobar si se a iniciados ession correctamente con el token . 
 * y llama a la funcion comprobaruser . 
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['token']) == isset($_POST['token'])) {

        $tokenvalidado = $_SESSION['token'];

        if (isset($_POST["user"]) && isset($_POST["password"])) {
            if (!empty($_POST["user"]) && !empty($_POST["password"])) {
                $empty = false;
                $user = $_POST["user"];
                $password = $_POST["password"];
                $_SESSION['user'] = $_POST["user"];
                if (strlen($user) <= 30 && strlen($password) <= 30) {
                    comprobaruser($user, $password);
                    $error = false;
                    $_SESSION["user"] = $_POST["user"];
                    $_SESSION["password"] = $_POST["password"];
                    $_SESSION['validaciontoken']  = $tokenvalidado;
                } else {
                    $error = true;
                }
            } else {
                $empty = true;
            }
        }
    }
}

/**
 * Encargada del control de errores en index.php de formulario de inicio . Usa  parametros globales .
 * @return spans dependiendo del error . 
 */
function mostrarerrores()
{
    global $error;
    global $empty;
    if ($error !== null) {
        if ($error == false) {
            print "   <span class='error'>  </span>";
        } else {
            print "   <span class='error'>  Usuario o contraseña incorrectas . </span>";
        }
    }

    if ($empty !== null) {
        if ($empty) {
            print "<span class='error'> Rellene todos lo campos .</span>";
        } else {
            print "<span class='error'></span>";
        }
    }
};

/**
 * Cuando hacede sin iniciar session y sin token a las vistas de usuarios y admin sale este index . 
 * @return index de error . 
 */
function Errorpermiso()
{
    print '
    

    <!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Reserva de Vuelo</title>
    <link rel="stylesheet" href="../Pagina/css/my-login.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="container mt-5">
        <div class="alert alert-danger error-message" role="alert">
            No tienes permisos para acceder aquí. 
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
    
    
    ';
}
