<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica Amateur - Agenda de Citas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<header class="bg-blue-600 text-white p-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-2xl font-bold">Clínica Amateur</h1>
        @auth
            <div class="flex items-center space-x-4">
                <span>Bienvenido, {{ Auth::user()->name }}</span>
                <span>{{ Auth::user()->email }}</span>

                <!-- Agregar el formulario de logout -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-300">
                        Logout
                    </button>
                </form>
            </div>
        @endauth
    </div>
</header>

<main class="container mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-3xl font-semibold mb-6 text-center">Agenda tu Cita</h2>

    <form action="{{ route('appointments.showDoctors') }}" method="GET" class="max-w-md mx-auto">
        <div class="mb-4">
            <label for="date" class="block text-gray-700 font-bold mb-2">Selecciona una fecha:</label>
            <input
                type="date"
                name="date"
                id="date"
                value="{{ $selectedDate ?? now()->toDateString() }}"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div class="text-center">
            <button
                type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300"
            >
                Buscar Doctores
            </button>
        </div>
    </form>
</main>
</body>
</html>
