<?php
include("../funciones/funciones_bd.php");

$conexion = new mysqli("localhost", "root", "", "proyecto-aeropuerto");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$emailUsuario = correo($conexion, $_SESSION["user"]);
$vuelos = obtenerVuelosDisponibles($conexion);





if (!isset($_SESSION['reservas'][$_SESSION['user']])) {
    $_SESSION['reservas'][$_SESSION['user']] = array();
}

$vuelosReservados = $_SESSION['reservas'][$_SESSION['user']];



if (isset($_SESSION['mensaje'])) {
    echo "<div class='alert " . $_SESSION['mensaje']['tipo'] . "'>" . $_SESSION['mensaje']['texto'] . "</div>";
    unset($_SESSION['mensaje']);
}



if (isset($_POST['reservar'])) {
    if (isset($_POST['vuelo_id']) && is_numeric($_POST['vuelo_id'])) {
        $vuelo_id = intval($_POST['vuelo_id']);
        $usuario = $_SESSION['user'];

        if (!in_array($vuelo_id, $_SESSION['reservas'][$usuario])) {
            $_SESSION['reservas'][$usuario][] = $vuelo_id;
            $_SESSION['mensaje'] = array('tipo' => 'alert-success', 'texto' => "Vuelo reservado con éxito.");
        } else {
            $_SESSION['mensaje'] = array('tipo' => 'alert-danger', 'texto' => "Este vuelo ya ha sido reservado.");
        }
    } else {
        $_SESSION['mensaje'] = array('tipo' => 'alert-danger', 'texto' => "Error: No se ha especificado un vuelo válido.");
    }
}



if (isset($_POST['eliminar'])) {
    if (isset($_POST['eliminar_id']) && is_numeric($_POST['eliminar_id'])) {
        $vuelo_id = intval($_POST['eliminar_id']);
        $usuario = $_SESSION['user'];

        if (in_array($vuelo_id, $_SESSION['reservas'][$usuario])) {
            $_SESSION['reservas'][$usuario] = array_diff($_SESSION['reservas'][$usuario], array($vuelo_id));
            $_SESSION['mensaje'] = array('tipo' => 'alert-success', 'texto' => "Vuelo eliminado de las reservas.");
        } else {
            $_SESSION['mensaje'] = array('tipo' => 'alert-danger', 'texto' => "Este vuelo no está en tus reservas.");
        }
    }
}
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
            <h2 class="h6">Correo: <span id="user-email"></span><?php print($emailUsuario); ?></h2>
        </div>

        <nav class="nav__cambio">
            <ul class="ul__cambio">
                <li class="li__cambio"><a class="button__cambio" style="color:rgba(117, 149, 252, 255);" href="../Pagina/cambioContraseña.php">Cambiar contraseña</a></li>
            </ul>
        </nav>
    </header>

    <main class="container my-5">
        <div class="row">

            <div class="col-md-6">
                <div class="card" style="border: 2px solid rgba(117, 149, 252, 255);">
                    <div class="card-header" style="background-color: rgba(117, 149, 252, 255); color: white;">
                        <h3 class="card-title h5">Vuelos Reservados</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        if (count($vuelosReservados) > 0) {
                            foreach ($vuelosReservados as $vuelo_id) {

                                $consulta = "SELECT * FROM vuelos WHERE id = $vuelo_id";
                                $resultado = $conexion->query($consulta);
                                $vuelo = $resultado->fetch_assoc();
                        ?>

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-text" style="color:rgba(117, 149, 252, 255);">Vuelo a <?php echo $vuelo['aeropuerto_destino']; ?></h5>
                                        <p class="card-text">Fecha: <?php echo $vuelo['fecha']; ?>, Hora: <?php echo $vuelo['hora']; ?></p>

                                        <form action="user.php" method="POST" style="display:inline;">
                                            <input type="hidden" name="eliminar_id" value="<?php echo $vuelo_id; ?>">
                                            <button type="submit" name="eliminar" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </div>

                        <?php
                            }
                        } else {
                            echo "<p>No has reservado vuelos aún.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card vuelos-disponibles" style="border: 2px solid rgba(117, 149, 252, 255);">
                    <div class="card-header" style="background-color: rgba(117, 149, 252, 255); color: white;">
                        <h3 class="card-title h5">Reservar Vuelos Disponibles</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        $consulta = "SELECT * FROM vuelos";
                        $resultado = $conexion->query($consulta);

                        if ($resultado->num_rows > 0) {
                            while ($vuelo = $resultado->fetch_assoc()) {

                        ?>
                                <div class="card cards-vuelos">
                                    <p><strong class="strong"> Aeropuerto Origen:</strong> <?php echo $vuelo['aeropuerto_origen']; ?></p>
                                    <p><strong class="strong"> Aeropuerto Destino:</strong> <?php echo $vuelo['aeropuerto_destino']; ?></p>
                                    <p><strong class="strong"> Tiempo Estimado:</strong> <?php echo $vuelo['tiempo_estimado']; ?></p>
                                    <p><strong class="strong"> Precio:</strong> $<?php echo $vuelo['precio']; ?></p>
                                    <p><strong class="strong"> Fecha:</strong> <?php echo $vuelo['fecha']; ?></p>
                                    <p><strong class="strong"> Hora:</strong> <?php echo $vuelo['hora']; ?></p>

                                    <form action="user.php" method="POST">
                                        <input type="hidden" name="vuelo_id" value="<?php echo $vuelo['id']; ?>">
                                        <button type="submit" name="reservar" class="btn" style="background-color: rgba(117, 149, 252, 255); color: white;">Reservar</button>
                                    </form>
                                </div>
                        <?php
                            }
                        } else {
                            echo "No hay vuelos disponibles.";
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <script src="../Pagina/js/reenvio.js"></script>
</body>

</html>