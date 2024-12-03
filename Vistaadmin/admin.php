<?php
include('../funciones/funciones_bd.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Aerolíneas Admin">
    <title>Panel de Administrador - Vuelos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Pagina/css/my-login.css">
    <link rel="stylesheet" href="../Pagina/css/my-login.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="bg-light">


    <!-- Header -->
    <header class="text-white text-center py-4 mb-4" style="background-color: rgba(117, 149, 252, 255); ">
        <img src="../img/logo.png" alt="Logo" class="img-fluid mb-3" style="max-width: 150px;">
        <h1 class="h3 mb-2">Bienvenido, <?php
                                        print $_SESSION["user"] ?></h1>
        <h2 class="h5">Panel de Gestión de Vuelos</h2>

        <nav class="nav__cambio">

            <ul class="ul__cambio">
                <li class="li__cambio"><a class="button__cambio" href="../Pagina/cambioContraseña.php">Cambiar contraseña</a></li>

            </ul>
        </nav>
    </header>

    <!-- Form Sections -->
    <main class="container my-5">
        <div class="row">

            <!-- Ver Vuelos -->
            <div class="container mt-5">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-plane"></i> Información de Vuelos
                    </div>
                    <?php mostrarvuelos() ?>
                </div>
            </div>



            <!-- Crear Vuelos -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm" style="border-color: rgba(117, 149, 252, 255);">
                    <div class="card-body">
                        <h4 class="card-title" style="color: rgba(117, 149, 252, 255);">Crear Vuelo</h4>
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="empresa">Empresa</label>
                                <input id="empresa" type="text" class="form-control" name="empresa" placeholder="Nombre de la empresa">
                            </div>
                            <div class="form-group">
                                <label for="origen">Aeropuerto de Origen</label>
                                <input id="origen" type="text" class="form-control" name="aeropuerto_origen" placeholder="Ejemplo: Aeropuerto Madrid-Barajas">
                            </div>
                            <div class="form-group">
                                <label for="destino">Aeropuerto de Destino</label>
                                <input id="destino" type="text" class="form-control" name="aeropuerto_destino" placeholder="Ejemplo: Aeropuerto Barcelona-El Prat">
                            </div>
                            <div class="form-group">
                                <label for="tiempo">Tiempo Estimado (hh:mm:ss)</label>
                                <input id="tiempo" type="time" step="1" class="form-control" name="tiempo_estimado">
                            </div>
                            <div class="form-group">
                                <label for="max_pasajeros">Máx. Pasajeros (máx. 100)</label>
                                <input id="max_pasajeros" type="number" class="form-control" name="max_pasajeros" max="100">
                            </div>
                            <div class="form-group">
                                <label for="precio">Precio (€)</label>
                                <input id="precio" type="number" step="0.01" class="form-control" name="precio">
                            </div>
                            <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input id="fecha" type="date" class="form-control" name="fecha">
                            </div>
                            <div class="form-group">
                                <label for="hora">Hora</label>
                                <input id="hora" type="time" class="form-control" name="hora">
                            </div>
                            <?php errores() ?>
                            <button type="submit" class="btn" style="background-color: rgba(117, 149, 252, 255); color: white; width: 100%;">Crear Vuelo</button>
                        </form>
                    </div>
                </div>
            </div>








            <!-- Eliminar Vuelo -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm" style="border-color: rgba(117, 149, 252, 255);">
                    <div class="card-body">
                        <h4 class="card-title text-danger">Eliminar Vuelo</h4>
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="vuelo_id">ID del Vuelo</label>
                                <input id="vuelo_id" type="number" class="form-control" name="vuelo_id" placeholder="Introduce el ID del vuelo">
                            </div>
                            <button type="submit" class="btn btn-danger btn-block">Eliminar Vuelo</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>


    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>