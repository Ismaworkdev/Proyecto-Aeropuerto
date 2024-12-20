<?php
//pagina inicial con formulario de inicio . 

//inicio token 
session_start();
$session_id = session_id();
$num_rand = mt_rand(0, 999999999999999);
$caracteres_random = bin2hex(random_bytes(100000));

$tokenn = $caracteres_random . $num_rand . $session_id;
$token = hash('sha256', $tokenn);
$_SESSION['token'] = $token;

//fin token 
include('./funciones/funciones_bd.php');
include('./funciones/funciones.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>My Login Page</title>
	<link rel="stylesheet" href="./Pagina/css/my-login.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="./Pagina/css/my-login.css">
</head>



<body class="my-login-page">
	<br>
	<br>
	<h1 class="text-center">Aeropuerto Internacional MORT-JIMENEZ</h1>
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
								<?php
								mostrarerrores();
								mostrarerroresuser();
								?>
								<div class="form-group">
									<label for="password">Contraseña
										<a href="./Pagina/cambiocontraseñasinsession.php" class="float-right">
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
									¿No tienes usuario? <a href="./Pagina/register.php">Crear usuario</a>
								</div>
								<input type="hidden" name="token" value="<?php $_SESSION['token']; ?>">

							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2024 &mdash; Aeropuerto Internacional MORT-JIMENEZ
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
	<script src="./Pagina/js/reenvio.js"></script>
</body>

</html>