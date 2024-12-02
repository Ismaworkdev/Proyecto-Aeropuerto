<?php
session_start();

include("../funciones/funciones_bd.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuarioActual = $_POST['usuario_actual'];
    $contrasena = $_POST['contrasena'];
    $nuevoUsuario = $_POST['nuevo_usuario'];
    $repetirUsuario = $_POST['repetir_usuario'];

    if ($nuevoUsuario === $repetirUsuario) {
        if (cambiarUsuario($usuarioActual, $contrasena, $nuevoUsuario)) {
            $_SESSION['exito'] = "Nombre de usuario cambiado con éxito.";
            header('Location: usuarioActualizado.php');
            exit;
        } else {
            $_SESSION['error'] = 'El usuario actual o la contraseña son incorrectos.';
            header('Location: cambioUsuario.php');
            exit;
        }
    } else {
        $_SESSION['error'] = 'Los nuevos nombres de usuario no coinciden.';
        header('Location: cambioUsuario.php');
        exit;
    }
}
?>

<?php
if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}
?>




<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h2 class="mb-4">Cambiar Usuario</h2>
                <form action="" method="POST" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="usuarioActual" class="form-label">Usuario Actual</label>
                        <input type="text" class="form-control" id="usuarioActual" name="usuario_actual" required>
                        <div class="invalid-feedback">
                            Por favor, ingresa tu usuario actual.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                    </div>
                    <div class="mb-3">
                        <label for="nuevoUsuario" class="form-label">Nuevo Usuario</label>
                        <input type="text" class="form-control" id="nuevoUsuario" name="nuevo_usuario" required>
                        <div class="invalid-feedback">
                            Por favor, ingresa un nuevo nombre de usuario.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="repetirUsuario" class="form-label">Repetir Nuevo Usuario</label>
                        <input type="text" class="form-control" id="repetirUsuario" name="repetir_usuario" required>
                        <div class="invalid-feedback">
                            Por favor, repite el nuevo nombre de usuario.
                        </div>
                    </div>
                    <button type="submit" class="btn" style="background-color: rgba(117, 149, 252, 255); color:white">Cambiar Usuario</button>
                </form>
            </div>

            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <img src="../img/logo.png" alt="Imagen de seguridad" class="img-fluid rounded" style="width: 500px;">
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>