<?php
session_start();
include('../funciones/funciones_bd.php');
include('../funciones/funciones.php');
/**
 * Aqui cualquier usuario puede cambiar su contraseña sabiendo su gmail y su usuario  . 
 */

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link rel="stylesheet" href="./css/my-login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">

            <div class="col-md-6">
                <h2 class="mb-4">Cambiar Contraseña</h2>
                <form action="" method="POST" class="needs-validation" novalidate>

                    <div class="mb-3">
                        <label for="usuarioAntiguo" class="form-label">Usuario</label>
                        <input type="user" class="form-control" id="usuarioAntiguo" name="usu_actual" value="<?php echo isset($_SESSION["user"]) && !empty($_SESSION["user"]) ? $_SESSION["user"] : ''; ?>" required>

                    </div>
                    <div class="mb-3">
                        <label for="gmail" class="form-label">Gmail Actual</label>
                        <input type="email" class="form-control" id="gmail" name="gmail" required>

                    </div>

                    <div class="mb-3">
                        <label for="nuevaContrasena" class="form-label">Nueva Contraseña</label>
                        <input type="password" class="form-control" id="nuevaContrasena" name="nueva_contrasena" required>

                    </div>

                    <div class="mb-3">
                        <label for="repetirContrasena" class="form-label">Repetir Nueva Contraseña</label>
                        <input type="password" class="form-control" id="repetirContrasena" name="repetir_contrasena" required>
                        <?php Cambiocontraseñaerroressinsession() ?>
                    </div>

                    <button type="submit" name="cambiocontraseñasinsession" class="btn" style="background-color: rgba(117, 149, 252, 255); color: white;">Cambiar Contraseña</button>
                </form>
            </div>


            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <img src="../img/logo.png" alt="Imagen de seguridad" class="img-fluid rounded" style="width: 550px;">
            </div>
        </div>
    </div>
    <script src="./js/reenvio.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>