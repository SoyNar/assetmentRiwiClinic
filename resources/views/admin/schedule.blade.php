<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Horario - Administrador</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen flex items-center justify-center">
<div class="w-full max-w-md bg-white shadow-2xl rounded-xl overflow-hidden">
    <div class="bg-blue-600 text-white text-center py-6">
        <h1 class="text-3xl font-bold">Generar Horario Médico</h1>
    </div>

    <form action="{{ route('show.allschedule') }}" method="POST" class="p-8 space-y-6">
        @csrf
        <div>
            <label for="doctor_id" class="block text-gray-700 font-semibold mb-2">Seleccionar Médico</label>
            <select
                name="doctor_id"
                id="doctor_id"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            >
                <option value="">Seleccione un médico</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label for="start_time" class="block text-gray-700 font-semibold mb-2">Hora de Inicio</label>
                <input
                    type="time"
                    name="start_time"
                    id="start_time"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                >
            </div>
            <div>
                <label for="end_time" class="block text-gray-700 font-semibold mb-2">Hora de Fin</label>
                <input
                    type="time"
                    name="end_time"
                    id="end_time"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                >
            </div>
        </div>

        <div>
            <label for="consultation_duration" class="block text-gray-700 font-semibold mb-2">Duración de la Cita (minutos)</label>
            <input
                type="number"
                name="consultation_duration"
                id="consultation_duration"
                min="5"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            >
        </div>

        <div class="text-center">
            <button
                type="submit"
                class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition duration-300 font-semibold"
            >
                Generar Horarios
            </button>
        </div>
    </form>
</div>
</body>
</html>
