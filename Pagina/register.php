<?php

/**
 * Paigina de registro , se debe poner el nombre un gmail valido y una contraseña 
 */
include('../funciones/funciones_bd.php');

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Kodinger">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/my-login.css">

</head>

<body class="my-login-page">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="brand">
                        <img src="../img/logo.png" alt="bootstrap 4 login page">
                    </div>
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title">Registrar</h4>
                            <form method="POST" class="my-login-validation" novalidate="">
                                <div class="form-group">
                                    <label for="name">Nombre </label>
                                    <input id="name" type="text" class="form-control" name="nom" required autofocus>
                                </div>

                                <div class="form-group">
                                    <label for="email">Correo Electrónico</label>
                                    <input id="email" type="email" class="form-control" name="gmail" placeholder="ejemplo@dominio.com" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input id="password" type="password" class="form-control" name="passwd" required data-eye>
                                </div>

                                <div class="form-group m-0">
                                    <?php insertaerrores() ?>
                                    <button type="submit" name="registerr" class="btn btn-primary btn-block registrar">
                                        Registrarse
                                    </button>
                                </div>
                                <div class="mt-4 text-center">
                                    ¿Ya tienes cuenta? <a href="../index.php">Iniciar sesión</a>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="footer">
                        Copyright &copy; 2024 &mdash; Aeropuerto Internacional MORT-JIMENEZ
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="./js/reenvio.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>