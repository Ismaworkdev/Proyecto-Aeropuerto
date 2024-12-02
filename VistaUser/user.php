<?php
include("../funciones/funciones_bd.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../Pagina/css/my-login.css">
</head>

<body class="bg-light">
    <header class="text-white text-center py-4 mb-4" style="background-color: rgba(117, 149, 252, 255);">
        <div class="container">
            <img src="../img/logo.png" alt="Logo" class="img-fluid mb-3 rounded-circle" style="max-width: 150px;">
            <h1 class="h4">Bienvenido, <span id="user-name" value=""><?php print $_SESSION["user"] ?></span></h1>
            <h2 class="h6">Correo: <span id="user-email"></span></h2>
            <p class="">Rol: Usuario</p>
        </div>

        <nav class="nav__cambio">
            <ul class="ul__cambio">
                <li class="li__cambio"><a class="button__cambio" href="../Pagina/cambioUsuario.php">Cambiar usuario</a></li>
            </ul>
            <ul class="ul__cambio">
                <li class="li__cambio"><a class="button__cambio" href="../Pagina/cambioContraseña.php">Cambiar contraseña</a></li>
            </ul>
        </nav>
    </header>

    <main class="container my-5">
        <div class="row">
            <!-- Vuelos Reservados  git fetch origin git merge origin/main-->
            <div class="col-md-6">
                <div class="card" style="border: 2px solid rgba(117, 149, 252, 255);">
                    <div class="card-header" style="background-color: rgba(117, 149, 252, 255); color: white;">
                        <h3 class="card-title h5">Vuelos Reservados</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <!-- Ejemplo -->
                            <li class="list-group-item">Vuelo a Madrid - 12/12/2024</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Reservar Vuelos -->
            <div class="col-md-6">
                <div class="card" style="border: 2px solid rgba(117, 149, 252, 255);">
                    <div class="card-header" style="background-color: rgba(117, 149, 252, 255); color: white;">
                        <h3 class="card-title h5">Reservar Vuelos Disponibles</h3>
                    </div>
                    <div class="card-body">
                        <div class="card">
                        <h4 class="h5">Aeropuerto Origen: </h4>
                        <h4 class="h5">Aeropuerto Destino: </h4>
                        <h4 class="h5">Tiempo estimado: </h4>
                        <h4 class="h5">Precio: </h4>
                        <h4 class="h5">Fecha: </h4>
                        <h4 class="h5">Hora: </h4>
                        <button>Reservar</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>