<?php
session_start();
include('../funciones/funciones_bd.php');
include('../funciones/funciones.php');


/** Vista del administrado donde puede ver vuelos crearlos y eliminarlos 
 * comprueba si se a iniciado session con el token si no no podra ver la pagina 
 */
if (isset($_SESSION['token']) && isset($_SESSION['validaciontoken']) && $_SESSION["user"] == "admin") {
    if ($_SESSION['validaciontoken'] !== $_SESSION['token']) {
        Errorpermiso();
    } else {






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

            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        </head>

        <body>


            <!-- Header -->
            <header class="text-white text-center py-4 mb-4" style="background-color: rgba(117, 149, 252, 255); ">
                <img src="../img/logo.png" alt="Logo" class="img-fluid mb-3" style="max-width: 150px;">
                <h1 class="h3 mb-2">Bienvenido, <?php
                                                print $_SESSION["user"] ?> </h1>
                <h2 class="h5">Panel de Gestión de Vuelos</h2>

                <nav class="nav__cambio">

                    <ul class="ul__cambio">
                        <li class="li__cambio"><a class="button__cambio" style="color:rgba(117, 149, 252, 255);" href="../Pagina/cambioContraseña.php">Cambiar contraseña</a></li>

                    </ul>
                </nav>
            </header>

            <!-- Form Sections -->
            <main class="container_ ">
                <div class=" container_vuelos">
                    <div class="container d-block justify-content-center align-items-center ">

                        <!-- Ver Vuelos -->
                        <div class="container mt-5 justify-content-center align-items-center d-flex">



                            <?php mostrarVuelos() ?>

                        </div>

                        <br> <br>
                        <!-- Crear Vuelos -->

                        <!-- Crear Vuelo -->
                        <div class=" form-container">

                            <div class="card-body">
                                <h4 class="card-title" style="color: rgba(117, 149, 252, 255);">Crear Vuelo</h4>
                                <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                                    <div class="form-group">
                                        <label for="origen">Aeropuerto de Origen</label>
                                        <input id="origen" type="text" class="form-control" name="aeropuerto_origen" placeholder="Ejemplo: Aeropuerto Madrid-Barajas">
                                    </div>
                                    <div class="form-group">
                                        <label for="destino">Aeropuerto de Destino</label>
                                        <input id="destino" type="text" class="form-control" name="aeropuerto_destino" placeholder="Ejemplo: Aeropuerto Barcelona-El Prat">
                                    </div>
                                    <div class="form-group">
                                        <label for="empresa">Empresa</label>
                                        <input id="empresa" type="text" class="form-control" name="empresa" placeholder="Airbus">
                                    </div>
                                    <div class="form-group">
                                        <label for="tiempo">Tiempo Estimado (hh:mm:ss)</label>
                                        <input id="tiempo" type="time" step="1" class="form-control" name="tiempo_estimado">
                                    </div>
                                    <div class="form-group">
                                        <label for="max_pasajeros">Máx. Pasajeros</label>
                                        <input id="max_pasajeros" type="number" class="form-control" name="max_pasajeros">
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
                                    <button type="submit" name="submitcrearvuelo" class="btn" style="background-color: rgba(117, 149, 252, 255); color: white; width: 100%;">Crear Vuelo</button>
                                </form>
                            </div>

                        </div>

                        <!-- Eliminar Vuelo -->
                        <div class=" form-container">
                            <div class="card-body">
                                <h4 class="card-title text-danger">Eliminar Vuelo</h4>
                                <form method="post" action="">
                                    <div class="form-group">
                                        <label for="vuelo_id">ID del Vuelo</label>
                                        <input id="vuelo_id" type="number" class="form-control" name="vuelo_id" placeholder="Introduce el ID del vuelo" value="<?php echo isset($_POST['vuelo_id']) && !empty($_POST['vuelo_id']) ? $_POST['vuelo_id'] : ''; ?>">
                                    </div>
                                    <?php erroreseliminar() ?>
                                    <button name="submiteliminarvuelo" type="submit" class="btn btn-danger btn-block">Eliminar Vuelo</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- CAMBIAR PRECIO -->
                <div class="form-container">
                    <h2 class="mb-4 text-center">Cambiar precio Vuelo. </h2>
                    <form method="POST">
                        <div class="form-group">
                            <label for="texto">ID Vuelo</label>
                            <input type="text" class="form-control" name="IDvuelo" id="texto" placeholder="ID">
                        </div>
                        <div class="form-group">
                            <label for="numero">Nuevo precio </label>
                            <input type="number" class="form-control" name="precioo" id="numero" placeholder="Introduce el precio ">
                        </div>
                        <?php controldecambiarprecio() ?>
                        <button type="submit" id="vuelooo" name="precioVuelo" class="btn   btn-block">Enviar</button>
                    </form>
                </div>



                <form action="../Pagina/logaut.php" method="post">
                    <button type="submit" class="logout-button">Cerrar sesión</button>
                </form>

            </main>
            <script src="../Pagina/js/reenvio.js"></script>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>

        </html>

<?php
        /**
         * llamada de la funcion para mostrar la alerta . 
         */
    }
} else {
    Errorpermiso();
}

?>