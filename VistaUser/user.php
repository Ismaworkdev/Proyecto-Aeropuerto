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
            <h1 class="h4">Bienvenido, <span id="user-name">Usuario</span></h1>
            <h2 class="h6">Correo: <span id="user-email">usuario@gmail.com</span></h2>
            <p class="">Rol: Usuario</p>
        </div>

        <nav class="nav__cambio">
            <ul class="ul__cambio">
                <li class="li__cambio"><a class="button__cambio" href="../Pagina/cambioUsuario.php">Cambiar email</a></li>
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
                        <form>
                            <div class="mb-3">
                                <label for="destination" class="form-label">Destino</label>
                                <input type="text" class="form-control" id="destination" placeholder="Introduce un destino">
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Fecha</label>
                                <input type="date" class="form-control" id="date">
                            </div>
                            <div class="mb-3">
                                <label for="passengers" class="form-label">Número de Pasajeros</label>
                                <input type="number" class="form-control" id="passengers" placeholder="Introduce el número de pasajeros">
                            </div>
                            <button type="submit" class="btn" style="background-color: rgba(117, 149, 252, 255); color: white; width: 100%;">Buscar Vuelos</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>