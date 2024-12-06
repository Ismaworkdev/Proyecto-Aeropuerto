
<?php


session_start();
$erro = false;
$pdo;
function conexion()
{
    global $pdo;
    try {
        $pdo = new PDO('mysql:host=localhost:3307;dbname=proyecto-aeropuerto', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('SET NAMES "utf8"');
    } catch (PDOException $e) {
        echo 'Error en la conexión: ' . $e->getMessage();
    }
}

conexion();

function comprobaruser($user, $password)
{
    global $pdo;
    global $erro;
    try {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombre = :user AND contraseña = :password");
        $stmt->bindParam(':user', $user);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $rol = $row['rol'];
            $erro = false;
            if ($rol == 'A') {
                header("Location:Vistaadmin/admin.php");
            } else {

                header("Location:Vistauser/user.php");
            }
        } else {
            echo "El usuario $user no existe.";
            $erro = true;
        }
    } catch (PDOException $e) {
        echo 'Error en la consulta: ' . $e->getMessage();
    }
}
function mostrarerroresuser()
{
    global $erro;
    if ($erro == false) {
        print "   <span class='error'>  </span>";
    } else {
        print "   <span class='error'>  Usuario iniexistente  . </span>";
    }
};








function insertuser($nombre, $correo, $password, $rol)
{
    global $pdo;

    try {

        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombre = :nombre and email = :email");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $correo);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            return false;
            exit();
        } else {

            $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, contraseña , rol) VALUES (:nombre, :email, :password , :rol)");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':email', $correo);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':rol', $rol);

            if ($stmt->execute()) {
                echo "Usuario registrado exitosamente.";
                return true;
            } else {
                echo "Error al registrar el usuario.";
                return false;
            }
        }
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
        return false;
    }
}



function cambiarContrasena($usuario, $gmail, $nuevaContrasena)
{
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombre = :usuario");
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuarioData['email'] == $gmail) {
            $updateStmt = $pdo->prepare("UPDATE usuarios SET contraseña = :nueva_contrasena WHERE nombre = :usuario");
            $updateStmt->bindParam(':nueva_contrasena', $nuevaContrasena);
            $updateStmt->bindParam(':usuario', $usuario);
            $updateStmt->execute();

            return true;
        }
    }

    return false;
}



//no hace falta 
function cambiarUsuario($usuarioAntiguo, $contrasena, $usuarioNuevo)
{
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombre = :usuarioAntiguo");
    $stmt->bindParam(':usuarioAntiguo', $usuarioAntiguo);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuarioData['contraseña'] === $contrasena) {
            $updateStmt = $pdo->prepare("UPDATE usuarios SET nombre = :usuarioNuevo WHERE nombre = :usuarioAntiguo");
            $updateStmt->bindParam(':usuarioNuevo', $usuarioNuevo);
            $updateStmt->bindParam(':usuarioAntiguo', $usuarioAntiguo);
            $updateStmt->execute();
            return true;
        }
    }

    return false;
}


//admin
$bacio = null;
$menor = null;
function crearVuelo()
{
    global  $bacio;
    global $menor;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['submitcrearvuelo'])) {


            if (!empty($_POST['empresa']) && !empty($_POST['aeropuerto_origen']) && !empty($_POST['aeropuerto_destino']) && !empty($_POST['tiempo_estimado']) && !empty($_POST['max_pasajeros']) && !empty($_POST['precio']) && !empty($_POST['fecha']) && !empty($_POST['hora'])) {
                $empresa = $_POST['empresa'];
                $aeropuerto_origen = $_POST['aeropuerto_origen'];
                $aeropuerto_destino = $_POST['aeropuerto_destino'];
                $max_pasajeros = $_POST['max_pasajeros'];
                $tiempo_estimado = $_POST['tiempo_estimado'];
                $precio = $_POST['precio'];
                $fecha = $_POST['fecha'];
                $hora = $_POST['hora'];


                $fecha_actual = date('Y-m-d');
                $bacio = false;
                if (strtotime($fecha) < strtotime($fecha_actual)) {
                    $menor = true;
                } else {
                    $menor = false;
                    insertvuelo($empresa, $aeropuerto_origen, $aeropuerto_destino, $max_pasajeros, $tiempo_estimado, $precio, $fecha, $hora);
                }
            } else {
                $bacio = true;
            }
        }

        $_POST['empresa'] = null;
        $_POST['aeropuerto_origen'] = null;
        $_POST['aeropuerto_destino'] = null;
        $_POST['max_pasajeros'] = null;
        $_POST['tiempo_estimado'] = null;
        $_POST['precio'] = null;
        $_POST['fecha'] = null;
        $_POST['hora'] = null;
    }
}
crearVuelo();
function errores()
{
    global  $bacio;
    global $menor;
    if ($bacio !== null) {
        if ($bacio) {
            print "<span class='error'>Formulario incompleto , completa todos los campos </span>";
        } else {
            print "<span class='error'></span>";
        }
    }
    if ($menor !== null) {
        if ($menor) {
            print "<span class='error'> Fecha inválida, pon una fecha correcta.</span>";
        } else {
            print "<span class='error'></span>";
        }
    }
}


//insertrar buelo 
function insertVuelo($empresa, $aeropuerto_origen, $aeropuerto_destino, $max_pasajeros, $tiempo_estimado, $precio, $fecha, $hora)
{
    global $pdo;

    // Obtener el id más grande y sumarle 1
    $sql = "SELECT COALESCE(MAX(id), 0) + 1 AS new_id FROM vuelos";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $new_id = $row['new_id'];

    // Insertar el nuevo vuelo
    $sql = "INSERT INTO vuelos (id, empresa, aeropuerto_origen, aeropuerto_destino, tiempo_estimado, max_pasajeros, precio, fecha, hora) VALUES
            (:id, :empresa, :aeropuerto_origen, :aeropuerto_destino, :tiempo_estimado, :max_pasajeros, :precio, :fecha, :hora)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $new_id);
    $stmt->bindParam(':empresa', $empresa);
    $stmt->bindParam(':aeropuerto_origen', $aeropuerto_origen);
    $stmt->bindParam(':aeropuerto_destino', $aeropuerto_destino);
    $stmt->bindParam(':tiempo_estimado', $tiempo_estimado);
    $stmt->bindParam(':max_pasajeros', $max_pasajeros);
    $stmt->bindParam(':precio', $precio);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':hora', $hora);

    if ($stmt->execute()) {
        //echo "Nuevo vuelo insertado correctamente.";
    } else {
        //echo "Error al insertar el vuelo.";
    }
}
function correo($conexion, $nombreUsuario)
{

    $sql = "SELECT email FROM usuarios WHERE nombre = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $nombreUsuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $email = $resultado->fetch_assoc()['email'];
    $stmt->close();

    return $email;
}


function obtenerVuelosDisponibles($conexion)
{
    $sql = "SELECT aeropuerto_origen, aeropuerto_destino, tiempo_estimado, precio, fecha, hora FROM vuelos";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        return $resultado->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}



function mostrarVuelos()
{
    global $pdo;
    $stmt = $pdo->query("SELECT id, empresa, aeropuerto_origen, aeropuerto_destino, tiempo_estimado, precio, fecha, hora FROM vuelos");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $id = $row['id'];
        $empresa = $row['empresa'];
        $Aero_origen = $row['aeropuerto_origen'];
        $Aero_destino = $row['aeropuerto_destino'];
        $tiempo_estimado = $row['tiempo_estimado'];
        $precio = $row['precio'];
        $fecha = $row['fecha'];
        $hora = $row['hora'];

        echo '
       
                <h5 class="card-title" style="color:rgba(117, 149, 252, 255)"><span id="empresa">Vuelo ' . $id . ' de ' . $empresa . '</span></h5>
                <div class="card-body">
                    <div class="card-body-div">
                        <p class="card-text" style="color:rgba(117, 149, 252, 255)">Salida: <span id="aeropuerto-salida">' . $Aero_origen . '</span></p>
                        <p class="card-text" style="color:rgba(117, 149, 252, 255)">Llegada: <span id="aeropuerto-llegada">' . $Aero_destino . '</span></p>
                        <p class="card-text" style="color:rgba(117, 149, 252, 255)">Precio: <span id="precio">' . $precio . ' € </span></p>
                    </div>
                    <div class="card-body-div">
                        <p class="card-text" style="color:rgba(117, 149, 252, 255)">Fecha y Hora: <span id="fecha-hora">' . $fecha . ' : ' . $hora . '</span></p>
                        <p class="card-text" style="color:rgba(117, 149, 252, 255)">Tiempo Estimado: <span id="tiempo-estimado">' . $tiempo_estimado . ' horas</span></p>
                    </div>
                </div>
          
        <br><br>';
    }
}

//borrar 
$existe = null;
$vacio = null;
function borrarvuelo()
{
    global  $existe;
    global   $vacio;
    global $pdo;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['submiteliminarvuelo'])) {
            if (!empty($_POST['vuelo_id'])) {
                $ide = $_POST['vuelo_id'];
                $vacio = false;




                try {
                    $stmt = $pdo->prepare("SELECT id FROM vuelos WHERE id = :id ");
                    $stmt->bindParam(':id', $ide);

                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                        $existe = true;

                        // $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        //$rol = $row['rol'];
                        try {
                            $stmt = $pdo->prepare("DELETE FROM viajes WHERE vuelo_id = :id");
                            $stmt->bindParam(':id', $ide);

                            $stmt->execute();
                        } catch (\Throwable $e) {
                            echo 'Error en la consulta: ' . $e->getMessage();
                        }
                        try {
                            $stmt = $pdo->prepare("DELETE FROM vuelos WHERE id = :id");
                            $stmt->bindParam(':id', $ide);

                            $stmt->execute();
                        } catch (\Throwable $e) {
                            echo 'Error en la consulta: ' . $e->getMessage();
                        }
                    } else {

                        $existe = false;
                    }
                } catch (PDOException $e) {
                    echo 'Error en la consulta: ' . $e->getMessage();
                }

                //fin consulta 
            } else {
                $vacio = true;
            }
        }
    }
}
borrarvuelo();
function erroreseliminar()
{
    global  $existe;
    global   $vacio;

    if ($existe !== null) {

        if ($existe) {
            print "<span class='error'>  </span>";
        } else {
            print "<span class='error'> ID de vuelo inexistente </span>";
        }
    }
    if ($vacio !== null) {
        if ($vacio) {
            print "<span class='error'> Campo vacio , rellene campo </span>";
        } else {
            print "<span class='error'>  </span>";
        }
    }
}
