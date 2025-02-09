<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <!-- Aquí puedes agregar tus enlaces de estilos, como Bootstrap o tu propio CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    @yield('extra-css') <!-- Para agregar CSS adicional en páginas específicas -->
</head>
<body>
<!-- Barra de navegación común -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Gestión de Usuarios</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="">Usuarios</a>
            </li>
            <!-- Agregar más enlaces si es necesario -->

            <!-- Verifica si el usuario está autenticado antes de mostrar el botón de logout -->
            @if (Auth::check())
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Cerrar sesión</button>
                    </form>
                </li>
            @endif
        </ul>
    </div>
</nav>


<!-- Contenedor principal -->
<div class="container mt-4">
    <!-- Aquí se cargará el contenido específico de cada página -->
    @yield('contenido')
</div>

<!-- Pie de página -->
<footer class="bg-light text-center py-3 mt-4">
    <p>&copy; 2025 Gestión de Usuarios</p>
</footer>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@yield('extra-js') <!-- Para agregar scripts adicionales en páginas específicas -->
</body>
</html>
