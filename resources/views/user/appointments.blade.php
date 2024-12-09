<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Citas Médicas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Citas Médicas Agendadas</h1>

    @if($appointments->isEmpty())
        <p class="text-center text-gray-600">No tienes citas médicas agendadas.</p>
    @else
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="w-full">
                <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">Fecha</th>
                    <th class="py-3 px-4 text-left">Hora</th>
                    <th class="py-3 px-4 text-left">Descripción</th>
                    <th class="py-3 px-4 text-left">Doctor</th> <!-- Nueva columna para el nombre del doctor -->
                </tr>
                </thead>
                <tbody>
                @foreach($appointments as $appointment)
                    <tr class="border-b hover:bg-blue-50 transition duration-300">
                        <td class="py-3 px-4">{{ $appointment->appointment_date }}</td>
                        <td class="py-3 px-4">{{ $appointment->start_time }}</td>
                        <td class="py-3 px-4">{{ $appointment->reason }}</td>
                        <td class="py-3 px-4">{{ $appointment->doctor->name }}</td> <!-- Mostrar el nombre del doctor -->
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- Botón para agendar citas -->
    <div class="mt-6 text-center">
        <a href="{{ route('appointments.selectDate') }}" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-300">
            Agendar Cita
        </a>
    </div>
</div>
</body>
</html>
