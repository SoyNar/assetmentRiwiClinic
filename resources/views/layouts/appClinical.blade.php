<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Document')</title> <!-- Título de la página, por defecto 'Document' -->
    <!-- Puedes incluir CSS aquí -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Si tienes un archivo CSS principal -->
</head>
<body>
<!-- Header -->
<header>
    <nav>
        <ul>
            <li><a href="{{ route('home') }}">Inicio</a></li>
            <li><a href="{{ route('user.appointments') }}">Citas Médicas</a></li>
            <!-- Agrega más enlaces según lo necesites -->
        </ul>
    </nav>
</header>

<!-- Contenido principal -->
<div class="container">
    @yield('content') <!-- Aquí se insertará el contenido de las vistas -->
</div>

<!-- Footer -->
<footer>
    <p>&copy; {{ date('Y') }} Mi Sitio Web. Todos los derechos reservados.</p>
</footer>

<!-- Puedes incluir JS aquí -->
<script src="{{ asset('js/app.js') }}"></script> <!-- Si tienes un archivo JS principal -->
</body>
</html>

