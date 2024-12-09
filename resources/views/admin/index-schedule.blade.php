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
        <div class="flex justify-between mb-4">
            <button
                onclick="fetchDeletedSchedules()"
                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition"
            >
                Ver Horarios Eliminados
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-blue-100">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Médico</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hora de Inicio</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hora de Fin</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duración de Consulta</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Disponibilidad</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
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
                        <td class="px-4 py-4 flex space-x-2">
                            <button
                                onclick="openModal('edit', {{ $horario->id }}, '{{ $horario->start_time }}', '{{ $horario->end_time }}', {{ $horario->consultation_duration }}, {{ $horario->available ? 'true' : 'false' }})"
                                class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition"
                            >
                                Editar
                            </button>
                            <button
                                onclick="openModal('delete', {{ $horario->id }})"
                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition"
                            >
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500">No hay horarios creados.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para horarios eliminados -->
<div id="deletedModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-4xl">
        <div class="text-xl font-bold mb-4">Horarios Eliminados</div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-red-100">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Médico</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hora de Inicio</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hora de Fin</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duración de Consulta</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
                </thead>
                <tbody id="deletedSchedules" class="bg-white divide-y divide-gray-200">
                <!-- Aquí se cargan los horarios eliminados dinámicamente -->
                </tbody>
            </table>
        </div>
        <div class="flex justify-end mt-4">
            <button
                onclick="closeDeletedModal()"
                class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300"
            >
                Cerrar
            </button>
        </div>
    </div>
</div>

<script>
    function fetchDeletedSchedules() {
        fetch('{{ route('schedule.restore', '') }}')
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('deletedSchedules');
                tbody.innerHTML = '';
                data.forEach(horario => {
                    const row = `
                        <tr class="hover:bg-red-50 transition duration-300">
                            <td class="px-4 py-4">${horario.user?.name ?? 'No asignado'}</td>
                            <td class="px-4 py-4">${horario.start_time}</td>
                            <td class="px-4 py-4">${horario.end_time}</td>
                            <td class="px-4 py-4">${horario.consultation_duration} minutos</td>
                            <td class="px-4 py-4">
                                <button
                                    onclick="restoreSchedule(${horario.id})"
                                    class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition"
                                >
                                    Restaurar
                                </button>
                            </td>
                        </tr>
                    `;
                    tbody.innerHTML += row;
                });
                document.getElementById('deletedModal').classList.remove('hidden');
            })
            .catch(() => alert('Error al cargar los horarios eliminados.'));
    }

    function restoreSchedule(id) {
        fetch(`{{ route('schedule.restore', '') }}/${id}`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
        }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Horario restaurado con éxito');
                    fetchDeletedSchedules(); // Actualizar lista de horarios eliminados
                } else {
                    alert('Error al restaurar el horario');
                }
            }).catch(() => alert('Error al restaurar el horario'));
    }

    function closeDeletedModal() {
        document.getElementById('deletedModal').classList.add('hidden');
    }
</script>
</body>
</html>
