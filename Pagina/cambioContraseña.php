<?php
    include("../funciones/funciones_bd1.php");

    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $usuarioAntiguo = $_POST['usuario_antiguo'];
        $contrasenaAntigua = $_POST['contrasena_antigua'];
        $nuevaContrasena = $_POST['nueva_contrasena'];
        $repetirContrasena = $_POST['repetir_contrasena'];

        if ($nuevaContrasena !== $repetirContrasena) {
            $_SESSION['error'] = "Las contraseñas no coinciden.";
            header('Location: cambioContraseña.php'); 
            exit;
        }

        $resultado = cambiarContrasena($usuarioAntiguo, $contrasenaAntigua, $nuevaContrasena);
        
        if ($resultado) {
            header('Location: contraseñaActualizada.php'); 
            exit;
        } else {
            $_SESSION['error'] = "Usuario o contraseña incorrectos.";
            header('Location: cambioContraseña.php'); 
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
    <title>Cambiar Contraseña</title>
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
                        <input type="user" class="form-control" id="usuarioAntiguo" name="usuario_antiguo" required>

                    </div>
                    <div class="mb-3">
                        <label for="contrasenaAntigua" class="form-label">Contraseña Antigua</label>
                        <input type="password" class="form-control" id="contrasenaAntigua" name="contrasena_antigua" required>
                        
                    </div>
                    
                    <div class="mb-3">
                        <label for="nuevaContrasena" class="form-label">Nueva Contraseña</label>
                        <input type="password" class="form-control" id="nuevaContrasena" name="nueva_contrasena" required>
                        
                    </div>
                   
                    <div class="mb-3">
                        <label for="repetirContrasena" class="form-label">Repetir Nueva Contraseña</label>
                        <input type="password" class="form-control" id="repetirContrasena" name="repetir_contrasena" required>
                        
                    </div>
                    
                    <button type="submit" class="btn" style="background-color: rgba(117, 149, 252, 255); color: white;">Cambiar Contraseña</button>
                </form>
            </div>

            
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <img src="../img/logo.png" alt="Imagen de seguridad" class="img-fluid rounded" style="width: 550px;">
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>