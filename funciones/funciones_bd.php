
<?php



$erro = false;
$pdo;
/**
 * funcion de conexion a la base de datos . 
 * @global PDO  $pdo objeto global de conexion a la base de datos . 
 */
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
/**
 * llamada a la funcion conexion . 
 */
conexion();


/**
 * comprueba si existe una fila en la base datos en la tabal usuarios con ese usuario y esa contraseña y dependiendo del usuario redireciona  a la pagina . 
 * @param  [type] $user
 * @param  [type] $password
 * @return void
 * @global $pdo para la conexion 
 * @global $erro para el control de errores es decir si existe o no existe 
 */
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
            $erro = true;
        }
    } catch (PDOException $e) {
        echo 'Error en la consulta: ' . $e->getMessage();
    }
}

/**
 * Control de errores del formulario de inicio en index.php.
 *
 * Esta función muestra mensajes de error en el formulario de inicio de sesión.
 *
 * @global bool $erro Indica si hay un error en el inicio de sesión.
 * @return void
 */

function mostrarerroresuser()
{
    global $erro;
    if ($erro == false) {
        print "   <span class='error'>  </span>";
    } else {
        print "   <span class='error'>  Usuario iniexistente  . </span>";
    }
};
/**
 * Obtiene el correo electrónico del usuario.
 *
 * @global PDO $pdo Objeto de conexión a la base de datos.
 * @return void
 */

function correo()
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombre = :user ");
    $stmt->bindParam(':user', $_SESSION["user"]);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $rol = $row['email'];
        print "$rol";
    }
}




$registrvacios = null;
$gmailerror = null;
$yaexisteuser = null;
$superar = null;
/**
 * Inserta un nuevo usuario en la base de datos tanto el gmail debe ser valido y el nombre como la contraseña no debe de pasar lso 30 acaracteres 
 *
 * @global PDO $pdo Objeto de conexión a la base de datos.
 * @global bool|null $registrvacios Indica si hay campos vacíos en el formulario de registro.
 * @global bool|null $gmailerror Indica si hay un error en el formato del correo electrónico.
 * @global bool|null $yaexisteuser Indica si el usuario ya existe en la base de datos.
 * @global bool|null $superar Indica si los campos del formulario superan el límite de caracteres.
 * @return void
 */


function insertuser()
{
    global $pdo;
    global $registrvacios;
    global $gmailerror;
    global $yaexisteuser;
    global $superar;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['registerr'])) {


            if (!empty($_POST['passwd']) && !empty($_POST['gmail']) && !empty($_POST['nom'])) {
                $registrvacios = false;
                if (filter_var($_POST['gmail'], FILTER_VALIDATE_EMAIL)) {
                    $gmailerror = false;
                    if (strlen($_POST['nom']) < 30 && strlen($_POST['passwd']) < 30) {

                        $nombre = $_POST['nom'];
                        $passww = $_POST['passwd'];
                        $ggmail = $_POST['gmail'];


                        $superar = false;


                        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombre = :nombre and email = :email");
                        $stmt->bindParam(':nombre', $nombre);
                        $stmt->bindParam(':email', $ggmail);
                        $stmt->execute();

                        if ($stmt->rowCount() ==  0) {
                            $yaexisteuser = false;
                            $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, contraseña , rol) VALUES (:nombre, :email, :password , 'B')");
                            $stmt->bindParam(':nombre', $nombre);
                            $stmt->bindParam(':email', $ggmail);
                            $stmt->bindParam(':password', $passww);
                            $stmt->execute();
                            alertacambio();
                        } else {
                            $yaexisteuser = true;
                        }
                    } else {
                        $superar = true;
                    }
                } else {
                    $gmailerror = true;
                }
            } else {
                $registrvacios = true;
            }
        }
    }
}
insertuser();

/**
 * Muestra mensajes de error en el formulario de registro.
 *
 * @global bool|null $registrvacios Indica si hay campos vacíos en el formulario de registro.
 * @global bool|null $gmailerror Indica si hay un error en el formato del correo electrónico.
 * @global bool|null $yaexisteuser Indica si el usuario ya existe en la base de datos.
 * @global bool|null $superar Indica si los campos del formulario superan el límite de caracteres.
 * @return void
 */


function insertaerrores()
{
    global $registrvacios;
    global $gmailerror;
    global $yaexisteuser;
    global $superar;

    if ($registrvacios !== null) {
        if ($registrvacios) {
            print "<span class='error'> Rellene todos lo campos .</span>";
        } else {
            print "<span class='error'></span>";
        }
    }
    if ($gmailerror !== null) {
        if ($gmailerror) {
            print "<span class='error'> Formato de gmail incorrecto .</span>";
        } else {
            print "<span class='error'></span>";
        }
    }
    if ($yaexisteuser !== null) {
        if ($yaexisteuser) {
            print "<span class='error'> Este nombre de usuario ya existe prueba otro nombre .</span>";
        } else {
            print "<span class='error'></span>";
        }
    }
    if ($superar !== null) {
        if ($superar) {
            print "<span class='error'> Usuario o contraseña invalidas prueba una mas corta .</span>";
        } else {
            print "<span class='error'></span>";
        }
    }
}


//cambiar contraseña 
$camposvacios = null;
$gmailerroneo = null;
$contraseñaserrones = null;
$userincorecto = null;
/**
 * Cambia la contraseña del usuario que tenga solamente iniciada la session 
 *
 * @global bool|null $camposvacios Indica si hay campos vacíos en el formulario.
 * @global bool|null $gmailerroneo Indica si el correo electrónico es incorrecto.
 * @global bool|null $contraseñaserrones Indica si las contraseñas no coinciden.
 * @global bool|null $userincorecto Indica si el usuario actual es incorrecto.
 * @return void
 */

function cambiarContrasena()
{
    global $camposvacios;
    global  $gmailerroneo;
    global  $contraseñaserrones;
    global  $userincorecto;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['cambiocontraseña'])) {


            if (!empty($_POST['usu_actual']) && !empty($_POST['gmail']) && !empty($_POST['nueva_contrasena']) && !empty($_POST['repetir_contrasena'])) {
                $camposvacios = false;
                if ($_POST['usu_actual'] == $_SESSION['user']) {
                    $userincorecto = false;
                    $user_actual =   $_POST['usu_actual'];
                    $gmail =  $_POST['gmail'];
                    $newpasswd = $_POST['nueva_contrasena'];
                    $newpasswd1  =  $_POST['repetir_contrasena'];
                    if ($newpasswd == $newpasswd1) {
                        $contraseñaserrones = false;
                        global $pdo;

                        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombre = :usuario");
                        $stmt->bindParam(':usuario', $user_actual);
                        $stmt->execute();

                        if ($stmt->rowCount() > 0) {
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);

                            if ($row['email'] == $gmail) {
                                $gmailerroneo = false;
                                $updateStmt = $pdo->prepare("UPDATE usuarios SET contraseña = :nueva_contrasena WHERE nombre = :usuario");
                                $updateStmt->bindParam(':nueva_contrasena', $newpasswd);
                                $updateStmt->bindParam(':usuario', $user_actual);
                                $updateStmt->execute();
                                alertacambio();
                            } else {
                                $gmailerroneo = true;
                            }
                        }
                    } else {
                        $contraseñaserrones = true;
                    }
                } else {
                    $userincorecto = true;
                }
            } else {
                $camposvacios = true;
            }
        }
    }
}

cambiarContrasena();


//control de errores de cambio contraseña 
/**
 * Control de errores en el cambio de contraseña.
 *
 * @global bool|null $camposvacios Indica si hay campos vacíos en el formulario.
 * @global bool|null $gmailerroneo Indica si el correo electrónico es incorrecto.
 * @global bool|null $contraseñaserrones Indica si las contraseñas no coinciden.
 * @global bool|null $userincorecto Indica si el usuario actual es incorrecto.
 * @return void
 */

function Cambiocontraseñaerrores()
{
    global $camposvacios;
    global  $gmailerroneo;
    global  $contraseñaserrones;
    global  $userincorecto;

    if ($camposvacios !== null) {
        if ($camposvacios) {
            print "<span class='error'> Rellene todos lo campos .</span>";
        } else {
            print "<span class='error'></span>";
        }
    }
    if ($gmailerroneo !== null) {
        if ($gmailerroneo) {
            print "<span class='error'> Gmail incorrecto .</span>";
        } else {
            print "<span class='error'></span>";
        }
    }
    if ($contraseñaserrones !== null) {
        if ($contraseñaserrones) {
            print "<span class='error'> Las contraseñas no coinciden  repitelas correctamente.</span>";
        } else {
            print "<span class='error'></span>";
        }
    }
    if ($userincorecto !== null) {
        if ($userincorecto) {
            print "<span class='error'> Usuario invalido escribe el usuario de la Session.</span>";
        } else {
            print "<span class='error'></span>";
        }
    }
}

//cambio contraseña sin iniciar session 
//cambiar contraseña 
/**
 * Cambia la contraseña sin iniciar sesion para todos los usuarios 
 *
 * @global bool|null $camposvacios1 Indica si hay campos vacíos en el formulario.
 * @global bool|null $gmailerroneo1 Indica si el correo electrónico es incorrecto.
 * @global bool|null $contraseñaserrones1 Indica si las contraseñas no coinciden.
 * @global bool|null $userygmailincorrecto Indica si el usuario o el correo electrónico son incorrectos.
 * @return void
 */

$camposvacios1 = null;
$gmailerroneo1 = null;
$contraseñaserrones1 = null;
$userygmailincorrecto = null;
function cambiarContrasenasinsession()
{
    global $camposvacios1;
    global  $gmailerroneo1;
    global  $contraseñaserrones1;
    global $userygmailincorrecto;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['cambiocontraseñasinsession'])) {


            if (!empty($_POST['usu_actual']) && !empty($_POST['gmail']) && !empty($_POST['nueva_contrasena']) && !empty($_POST['repetir_contrasena'])) {
                $camposvacios1 = false;

                $user_actual =   $_POST['usu_actual'];
                $gmail =  $_POST['gmail'];
                $newpasswd = $_POST['nueva_contrasena'];
                $newpasswd1  =  $_POST['repetir_contrasena'];
                if ($newpasswd == $newpasswd1) {
                    $contraseñaserrones1 = false;
                    global $pdo;

                    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombre = :usuario AND email = :ggmail");
                    $stmt->bindParam(':usuario', $user_actual);
                    $stmt->bindParam(':ggmail', $gmail);
                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                        $userygmailincorrecto = false;
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($row['email'] == $gmail) {
                            $gmailerroneo1 = false;
                            $updateStmt = $pdo->prepare("UPDATE usuarios SET contraseña = :nueva_contrasena WHERE nombre = :usuario");
                            $updateStmt->bindParam(':nueva_contrasena', $newpasswd);
                            $updateStmt->bindParam(':usuario', $user_actual);
                            $updateStmt->execute();
                            alertacambio();
                        } else {
                            $gmailerroneo1 = true;
                        }
                    } else {
                        $userygmailincorrecto = true;
                    }
                } else {
                    $contraseñaserrones1 = true;
                }
            } else {
                $camposvacios1 = true;
            }
        }
    }
}

cambiarContrasenasinsession();

/**
 * Control de errores en el cambio de contraseña sin iniciar sesión.
 *
 * @global bool|null $camposvacios1 Indica si hay campos vacíos en el formulario.
 * @global bool|null $gmailerroneo1 Indica si el correo electrónico es incorrecto.
 * @global bool|null $contraseñaserrones1 Indica si las contraseñas no coinciden.
 * @global bool|null $userygmailincorrecto Indica si el usuario o el correo electrónico son incorrectos.
 * @return void
 */


//control de errores de cambio contraseña 
function Cambiocontraseñaerroressinsession()
{
    global $camposvacios1;
    global  $gmailerroneo1;
    global  $contraseñaserrones1;
    global $userygmailincorrecto;

    if ($camposvacios1 !== null) {
        if ($camposvacios1) {
            print "<span class='error'> Rellene todos lo campos .</span>";
        } else {
            print "<span class='error'></span>";
        }
    }
    if ($gmailerroneo1 !== null) {
        if ($gmailerroneo1) {
            print "<span class='error'> Gmail incorrecto .</span>";
        } else {
            print "<span class='error'></span>";
        }
    }
    if ($contraseñaserrones1 !== null) {
        if ($contraseñaserrones1) {
            print "<span class='error'> Las contraseñas no coinciden  repitelas correctamente.</span>";
        } else {
            print "<span class='error'></span>";
        }
    }
    if ($userygmailincorrecto !== null) {
        if ($userygmailincorrecto) {
            print "<span class='error'> El usuario o email no coinciden en un mismo usuario.</span>";
        } else {
            print "<span class='error'></span>";
        }
    }
}



//admin


$bacio = null;
$menor = null;
/**
 * Crea un nuevo vuelo y lo inserta a la base de datos 
 *
 * @global bool|null $bacio Indica si hay campos vacíos en el formulario.
 * @global bool|null $menor Indica si la fecha del vuelo es anterior a la fecha actual.
 * @return void
 */

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
/**
 * Control de errores en la creación de vuelos.
 *
 * @global bool|null $bacio Indica si hay campos vacíos en el formulario.
 * @global bool|null $menor Indica si la fecha del vuelo es anterior a la fecha actual.
 * @return void
 */

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


//insertrar vuelo 
/**
 * Inserta un nuevo vuelo en la base de datos.
 *
 * @global PDO $pdo Objeto de conexión a la base de datos.
 * @param string $empresa Nombre de la empresa.
 * @param string $aeropuerto_origen Aeropuerto de origen.
 * @param string $aeropuerto_destino Aeropuerto de destino.
 * @param int $max_pasajeros Número máximo de pasajeros.
 * @param string $tiempo_estimado Tiempo estimado de vuelo.
 * @param float $precio Precio del vuelo.
 * @param string $fecha Fecha del vuelo.
 * @param string $hora Hora del vuelo.
 * @return void
 */

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
    $stmt->execute();
    alertacambio();
}

//reservar_vuelos user

$nada = null;
$erroneo = null;
$yaexiste = null;
/**
 * Reserva un vuelo.
 *
 * @global bool|null $nada Indica si el campo de ID del vuelo está vacío.
 * @global bool|null $erroneo Indica si el ID del vuelo es incorrecto.
 * @global bool|null $yaexiste Indica si el usuario ya ha reservado este vuelo.
 * @return void
 */

function reservarvuelo()
{
    global $nada;
    global $erroneo;
    global $yaexiste;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['reservar_vuelo'])) {
            if (!empty($_POST['idvueloreserva'])) {
                $idvuelo = $_POST['idvueloreserva'];
                $nada = false;

                global $pdo;

                $sql = "SELECT * FROM vuelos WHERE id = :idd";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':idd', $idvuelo);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($stmt->rowCount() > 0) {
                    $ide = $row['id'];
                    $erroneo = false;

                    $sql1 = "SELECT * FROM viajes WHERE vuelo_id = :idd AND usuario_nombre = :userr";
                    $stmt1 = $pdo->prepare($sql1);
                    $stmt1->bindParam(':idd', $ide);
                    $stmt1->bindParam(':userr', $_SESSION['user']);
                    $stmt1->execute();
                    $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
                    if ($stmt1->rowCount() == 0) {
                        insertarviaje($ide, $_SESSION['user']);
                        alertacambio();
                        $yaexiste = false;
                    } else {
                        $yaexiste = true;
                    }


                    //  $rol = $row['rol'];
                } else {

                    $erroneo = true;
                }
            } else {
                $nada = true;
            }
        }
    }
}
reservarvuelo();
/**
 * Control de errores en la reserva de vuelos.
 *
 * @global bool|null $nada Indica si el campo de ID del vuelo está vacío.
 * @global bool|null $erroneo Indica si el ID del vuelo es incorrecto.
 * @global bool|null $yaexiste Indica si el usuario ya ha reservado este vuelo.
 * @return void
 */

function errorreserva()
{
    global $nada;
    global $erroneo;
    global   $yaexiste;
    if ($nada !== null) {

        if ($nada) {
            print "<span class='error'>  rellene el formulario  </span>";
        } else {
            print "<span class='error'> </span>";
        }
    }
    if ($erroneo !== null) {
        if ($erroneo) {
            print "<span class='error'> ID vuelo inexistente  </span>";
        } else {
            print "<span class='error'>  </span>";
        }
    }
    if ($yaexiste !== null) {
        if ($yaexiste) {
            print "<span class='error'> Solo puedes reservar el mismo vuelo una vez .   </span>";
        } else {
            print "<span class='error'>  </span>";
        }
    }
}

//mostar vuelos reservados 
/**
 * Muestra los vuelos reservados por el usuario en una tabla . 
 *
 * @global PDO $pdo Objeto de conexión a la base de datos.
 * @return void
 */
function vuelosreservados()
{
    global $pdo;
    $sql = "SELECT * FROM viajes WHERE usuario_nombre = :userr";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':userr', $_SESSION['user']);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        print "  
            <h2>Vuelos reservados </h2>
            <table class='table table-bordered custom-table'>
                <thead>
                    <tr>
                        <th>Vuelo</th>
                        <th>Empresa</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Precio</th>
                        <th>Fecha y hora</th>
                        <th>Tiempo estimado</th>
                    </tr>
                </thead>
                <tbody>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $viajeid = $row['vuelo_id'];

            $sql1 = "SELECT * FROM vuelos WHERE id = :viajeid";
            $stmt1 = $pdo->prepare($sql1);
            $stmt1->bindParam(':viajeid', $viajeid);
            $stmt1->execute();

            while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                $id = $row1['id'];
                $empresa = $row1['empresa'];
                $Aero_origen = $row1['aeropuerto_origen'];
                $Aero_destino = $row1['aeropuerto_destino'];
                $tiempo_estimado = $row1['tiempo_estimado'];
                $precio = $row1['precio'];
                $fecha = $row1['fecha'];
                $hora = $row1['hora'];

                echo "
                    <tr>
                        <td>$id</td>
                        <td>$empresa</td>
                        <td>$Aero_origen</td>
                        <td>$Aero_destino</td>
                        <td>$precio €</td>
                        <td>$fecha / $hora</td>
                        <td>$tiempo_estimado</td>
                    </tr>";
            }
        }

        print " </tbody>
            </table>";
    } else {
        print "<span class='error'> No hay reservas aún.</span>";
    }
}


//insertar viajes 
/**
 * Inserta un nuevo viaje en la base de datos.
 *
 * @global PDO $pdo Objeto de conexión a la base de datos.
 * @param int $ide ID del vuelo.
 * @param string $usuario Nombre del usuario.
 * @return void
 */

function insertarviaje($ide, $usuario)
{
    try {
        global $pdo;

        $stmt = $pdo->prepare("INSERT INTO viajes (usuario_nombre, vuelo_id) VALUES 
        (:usuario, :vuelo)");
        $stmt->bindParam(':vuelo', $ide);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}



/**
 * Muestra todos los vuelos disponibles tanto al admin como al user. 
 *
 * @global PDO $pdo Objeto de conexión a la base de datos.
 * @return void
 */

function mostrarVuelos()
{
    global $pdo;
    $stmt = $pdo->query("SELECT id, empresa, aeropuerto_origen, aeropuerto_destino, tiempo_estimado, precio, fecha, hora FROM vuelos");

    if ($stmt->rowCount() > 0) {


        print "     <table class='table table-bordered custom-table'>
                        <thead>
                            <tr>
                                <th>Vuelo</th>
                                <th>Empresa</th>
                                <th>Origen</th>
                                <th>Destino</th>
                                <th>Precio</th>
                                <th>Fecha y hora </th>
                                <th>Tiempo estimado </th>
                            </tr>
                        </thead>
                        <tbody>";
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
             <tr>
                                <td>' . $id . '</td>
                                <td>' . $empresa . '</td>
                                <td>' . $Aero_origen . '</td>
                                <td>' . $Aero_destino . '</td>
                                <td>' . $precio . ' € </td>
                                <td>' . $fecha . ' /  ' . $hora . '</td>
                                <td>' . $tiempo_estimado . '</td>
                            </tr>
        ';
        }
        print " </tbody>
                    </table>";
    } else {
        print "<span class='error'> No hay vuelos disponibles</span> ";
    }
}

//borrar 
/**
 * Borra un vuelo de la base de datos.
 *
 * @global bool|null $existe Indica si el vuelo existe en la base de datos.
 * @global bool|null $vacio Indica si el campo de ID del vuelo está vacío.
 * @global PDO $pdo Objeto de conexión a la base de datos.
 * @return void
 */

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
                        alertacambio();
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
/**
 * Control de errores en la eliminación de vuelos.
 *
 * @global bool|null $existe Indica si el vuelo existe en la base de datos.
 * @global bool|null $vacio Indica si el campo de ID del vuelo está vacío.
 * @return void
 */

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





// modificar precio vuelos . 
$estanvacios = null;
$vuelonoexiste = null;

function modificarprecio()
{
    global $estanvacios;
    global $vuelonoexiste;
    global $pdo;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['precioVuelo'])) {
            if (!empty($_POST['IDvuelo']) && !empty($_POST['precioo'])) {
                $idee = $_POST['IDvuelo'];
                $dinero = $_POST['precioo'];
                $estanvacios = false;

                $stmt = $pdo->prepare("SELECT * FROM vuelos WHERE id = :id ");
                $stmt->bindParam(':id', $idee);

                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $vuelonoexiste = false;
                    $stmt = $pdo->prepare("UPDATE vuelos SET precio = :dinero WHERE id = :id");
                    $stmt->bindParam(':id', $idee);
                    $stmt->bindParam(':dinero', $dinero);

                    $stmt->execute();
                    alertacambio();
                } else {
                    $vuelonoexiste = true;
                }
            } else {
                $estanvacios = true;
            }
        }
    }
}
modificarprecio();

function controldecambiarprecio()
{
    global $estanvacios;
    global $vuelonoexiste;

    if ($estanvacios !== null) {

        if ($estanvacios) {
            print "<span class='error'>rellene los campos .   </span>";
        } else {
            print "<span class='error'>  </span>";
        }
    }
    if ($vuelonoexiste !== null) {
        if ($vuelonoexiste) {
            print "<span class='error'> ID vuelo inexistente  </span>";
        } else {
            print "<span class='error'>  </span>";
        }
    }
}




//alerta 
/**
 * Muestra una alerta indicando que los cambios se han guardado correctamente.
 *
 * @return void
 */

function alertacambio()
{
    print '
    
        <script>

        alert("Los cambios se han guardado correctamente .");

    </script>
    
    ';
}
