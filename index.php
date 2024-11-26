<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>My Login Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="./Pagina/css/my-login.css">
</head>
<?php
print "hola";
session_start();

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
	try {
		$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombre = :user AND contraseña = :password");
		$stmt->bindParam(':user', $user);
		$stmt->bindParam(':password', $password);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			echo "El usuario $user existe.";
		} else {
			echo "El usuario $user no existe.";
		}
	} catch (PDOException $e) {
		echo 'Error en la consulta: ' . $e->getMessage();
	}
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$user = $_POST["user"];
	$password = $_POST["password"];
	comprobaruser($user, $password);
}
?>

<body class="my-login-page">
	<br>
	<br>
	<h1 class="text-center">Aeropuerto Internacional Adolfo Suárez Madrid-Barajas</h1>
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="./img/logo.png" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Iniciar sesión</h4>
							<form method="POST" class="my-login-validation" novalidate="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
								<div class="form-group">
									<label for="user">Usuario </label>
									<input id="user" type="text" class="form-control" name="user" required autofocus>
								</div>

								<div class="form-group">
									<label for="password">Contraseña
										<a href="forgot.html" class="float-right">
											¿Olvidaste tu contraseña?
										</a>
									</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
								</div>
								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										Iniciar sesión
									</button>
								</div>
								<div class="mt-4 text-center">
									¿No tienes usuario? <a href="register.html">Crear usuario</a>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2024 &mdash; Aeropuerto Internacional Adolfo Suárez Madrid-Barajas
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
		crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
		integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
		crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
		integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
		crossorigin="anonymous"></script>

</body>

</html>