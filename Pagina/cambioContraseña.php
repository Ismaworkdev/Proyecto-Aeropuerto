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
            <!-- Sección del formulario -->
            <div class="col-md-6">
                <h2 class="mb-4">Cambiar Contraseña</h2>
                <form action="comprobarCambioContraseña.php" method="POST" class="needs-validation" novalidate>
                    <!-- Contraseña Antigua -->
                    <div class="mb-3">
                        <label for="contrasenaAntigua" class="form-label">Contraseña Antigua</label>
                        <input type="password" class="form-control" id="contrasenaAntigua" name="contrasena_antigua" required>
                        <div class="invalid-feedback">
                            Por favor, ingresa tu contraseña antigua.
                        </div>
                    </div>
                    <!-- Nueva Contraseña -->
                    <div class="mb-3">
                        <label for="nuevaContrasena" class="form-label">Nueva Contraseña</label>
                        <input type="password" class="form-control" id="nuevaContrasena" name="nueva_contrasena" required>
                        <div class="invalid-feedback">
                            Por favor, ingresa una nueva contraseña.
                        </div>
                    </div>
                    <!-- Repetir Nueva Contraseña -->
                    <div class="mb-3">
                        <label for="repetirContrasena" class="form-label">Repetir Nueva Contraseña</label>
                        <input type="password" class="form-control" id="repetirContrasena" name="repetir_contrasena" required>
                        <div class="invalid-feedback">
                            Por favor, repite la nueva contraseña.
                        </div>
                    </div>
                    <!-- Botón de Enviar -->
                    <button type="submit" class="btn" style="background-color: rgba(117, 149, 252, 255); color: white;">Cambiar Contraseña</button>
                </form>
            </div>

            <!-- Sección de la imagen -->
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <img src="../img/logo.png" alt="Imagen de seguridad" class="img-fluid rounded" style="width: 550px;">
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>