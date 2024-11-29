<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Aerolíneas Admin">
    <title>Panel de Administrador - Vuelos</title>
    <link rel="stylesheet" href="../Pagina/css/my-login.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="bg-light">
    <section class="h-100">
        <div class="container">
            <!-- Header -->
            <header class="text-white text-center py-4 mb-4" style="background-color: rgba(117, 149, 252, 255);">
                <img src="../img/logo.png" alt="Logo" class="img-fluid mb-3" style="max-width: 150px;">
                <h1 class="h3 mb-2">Bienvenido, Administrador</h1>
                <h2 class="h5">Panel de Gestión de Vuelos</h2>
                
                <nav class="nav__cambio">
                    <ul class="ul__cambio">
                        <li class="li__cambio"><a class="button__cambio" href="../Pagina/cambioUsuario.php">Cambiar email</a></li>
                    </ul>
                    <ul class="ul__cambio">
                        <li class="li__cambio"><a class="button__cambio" href="../Pagina/cambioContraseña.php">Cambiar contraseña</a></li>
                    </ul>
                </nav>
            </header>

            <!-- Form Sections -->
            <div class="row">
                <!-- Crear Vuelos -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-sm" style="border-color: rgba(117, 149, 252, 255);">
                        <div class="card-body">
                            <h4 class="card-title" style="color: rgba(117, 149, 252, 255);">Crear Vuelo</h4>
                            <form method="POST" action="/crear_vuelo">
                                <div class="form-group">
                                    <label for="empresa">Empresa</label>
                                    <input id="empresa" type="text" class="form-control" name="empresa" placeholder="Nombre de la empresa" required>
                                </div>
                                <div class="form-group">
                                    <label for="origen">Aeropuerto de Origen</label>
                                    <input id="origen" type="text" class="form-control" name="aeropuerto_origen" placeholder="Ejemplo: Aeropuerto Madrid-Barajas" required>
                                </div>
                                <div class="form-group">
                                    <label for="destino">Aeropuerto de Destino</label>
                                    <input id="destino" type="text" class="form-control" name="aeropuerto_destino" placeholder="Ejemplo: Aeropuerto Barcelona-El Prat" required>
                                </div>
                                <div class="form-group">
                                    <label for="tiempo">Tiempo Estimado (hh:mm:ss)</label>
                                    <input id="tiempo" type="time" step="1" class="form-control" name="tiempo_estimado" required>
                                </div>
                                <div class="form-group">
                                    <label for="max_pasajeros">Máx. Pasajeros (máx. 100)</label>
                                    <input id="max_pasajeros" type="number" class="form-control" name="max_pasajeros" max="100" required>
                                </div>
                                <div class="form-group">
                                    <label for="precio">Precio (€)</label>
                                    <input id="precio" type="number" step="0.01" class="form-control" name="precio" required>
                                </div>
                                <div class="form-group">
                                    <label for="fecha">Fecha</label>
                                    <input id="fecha" type="date" class="form-control" name="fecha" required>
                                </div>
                                <div class="form-group">
                                    <label for="hora">Hora</label>
                                    <input id="hora" type="time" class="form-control" name="hora" required>
                                </div>
                                <button type="submit" class="btn" style="background-color: rgba(117, 149, 252, 255); color: white; width: 100%;">Crear Vuelo</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Ver Vuelos -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-sm" style="border-color: rgba(117, 149, 252, 255);">
                        <div class="card-body">
                            <h4 class="card-title" style="color: rgba(117, 149, 252, 255);">Buscar Vuelos</h4>
                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="criterio">Buscar por:</label>
                                    <select id="criterio" class="form-control" name="criterio" required>
                                        <option value="empresa">Empresa</option>
                                        <option value="aeropuerto_origen">Aeropuerto de Origen</option>
                                        <option value="aeropuerto_destino">Aeropuerto de Destino</option>
                                        <option value="fecha">Fecha</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="valor">Valor</label>
                                    <input id="valor" type="text" class="form-control" name="valor" placeholder="Introduce el valor de búsqueda" required>
                                </div>
                                <button type="submit" class="btn" style="background-color: rgba(117, 149, 252, 255); color: white; width: 100%;">Buscar Vuelos</button>
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
                                    <input id="vuelo_id" type="number" class="form-control" name="vuelo_id" placeholder="Introduce el ID del vuelo" required>
                                </div>
                                <button type="submit" class="btn btn-danger btn-block">Eliminar Vuelo</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>