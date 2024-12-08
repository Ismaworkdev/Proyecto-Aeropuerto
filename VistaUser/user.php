<?php
session_start();
include('../funciones/funciones_bd.php');
include('../funciones/funciones.php');


/**Vista de los usuarios donde los usuarios pueden ver los vuelos y reservarlos y ver sus vuelso reservados . 
 * comprueba si se a iniciado session con el token si no no podra ver la pagina 
 */
if (isset($_SESSION['token']) && isset($_SESSION['validaciontoken']) && $_SESSION["user"] !== "admin") {
    if ($_SESSION['validaciontoken'] !== $_SESSION['token']) {
        Errorpermiso();
    } else {

?>


        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <link rel="stylesheet" href="../Pagina/css/my-login.css">
        </head>

        <body>
            <header class="text-white text-center py-4 mb-4" style="background-color: rgba(117, 149, 252, 255);">
                <div class="container">
                    <img src="../img/logo.png" alt="Logo" class="img-fluid mb-3 rounded-circle" style="max-width: 150px;">
                    <h1 class="h4">Bienvenido, <span id="user-name" value=""><?php print $_SESSION["user"] ?></span></h1>
                    <h2 class="h6">Correo: <span id="user-email"></span><?php correo(); ?></h2>
                </div>

                <nav class="nav__cambio">
                    <ul class="ul__cambio">
                        <li class="li__cambio"><a class="button__cambio" style="color:rgba(117, 149, 252, 255);" href="../Pagina/cambioContraseña.php">Cambiar contraseña</a></li>
                    </ul>
                </nav>
            </header>

            <main class="container_ ">
                <div class=" container_vuelos">
                    <div class="container d-block justify-content-center align-items-center ">

                        <!-- Ver Vuelos -->
                        <div class="container mt-5 justify-content-center align-items-center d-flex">



                            <?php mostrarVuelos() ?>

                        </div>

                        <br> <br>
                        <!-- reservar vuelos  Vuelos -->

                        <?php vuelosreservados() ?>

                        <br> <br>
                        <div class="row w-100">

                            <div class="container mt-5 ">
                                <h2 class="align-items-center d-flex ">Reserva de Vuelo</h2>
                                <form method="post">
                                    <br>
                                    <div class="form-group">
                                        <input name="idvueloreserva" type="number" class="form-control" id="numeroPasajeros" placeholder="Introduce el ID ">
                                    </div>
                                    <?php errorreserva() ?>
                                    <button id="reservar_vuelo" name="reservar_vuelo" type="submit" class="btn  btn-block">Reservar vuelo</button>
                                </form>
                            </div>

                            <!--  Vuelos reservados  -->

                        </div>



                    </div>


                </div>

                <form action="../Pagina/logaut.php" method="post">
                    <button type="submit" class="logout-button">Cerrar sesión</button>
                </form>
            </main>
            <script src="../Pagina/js/reenvio.js"></script>
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