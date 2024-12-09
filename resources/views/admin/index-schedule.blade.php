<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horarios de Médicos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen p-8">
<div class="max-w-4xl mx-auto bg-white shadow-2xl rounded-xl overflow-hidden">
    <div class="bg-blue-600 text-white text-center py-6">
        <h1 class="text-3xl font-bold">Horarios de los Médicos</h1>
    </div>

    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-blue-100">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Médico</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hora de Inicio</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hora de Fin</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duración de Consulta</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Disponibilidad</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse($horarios as $horario)
                    <tr class="hover:bg-blue-50 transition duration-300">
                        <td class="px-4 py-4">{{ $horario->user->name ?? 'No asignado' }}</td>
                        <td class="px-4 py-4">{{ $horario->start_time }}</td>
                        <td class="px-4 py-4">{{ $horario->end_time }}</td>
                        <td class="px-4 py-4">{{ $horario->consultation_duration }} minutos</td>
                        <td class="px-4 py-4">
                                    <span class="{{ $horario->available ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $horario->available ? 'Disponible' : 'No disponible' }}
                                    </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">No hay horarios creados.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
