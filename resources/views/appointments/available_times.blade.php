<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar Cita - Dr. {{ $doctor->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold mb-6 text-center">Horarios disponibles con Dr. {{ $doctor->name }} el {{ $date }}</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if(count($availableTimes) > 0)
        <form action="{{ route('appointments.bookAppointment') }}" method="POST" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
            @csrf
            <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
            <input type="hidden" name="date" value="{{ $date }}">

            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-4">Selecciona un horario:</h3>
                <div class="space-y-2">
                    @foreach($availableTimes as $time)
                        <div class="flex items-center">
                            <input
                                type="radio"
                                name="start_time"
                                id="time_{{ $loop->index }}"
                                value="{{ $time['start_time'] }}"
                                class="mr-2"
                                required
                            >
                            <label for="time_{{ $loop->index }}" class="flex-grow">
                                {{ $time['start_time'] }} - {{ $time['end_time'] }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-6">
                <label for="reason" class="block mb-2 font-semibold">Motivo de la cita:</label>
                <textarea
                    name="reason"
                    id="reason"
                    rows="4"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Ingresa el motivo de tu cita..."
                    required
                ></textarea>
            </div>

            <div class="text-center">
                <button
                    type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300"
                >
                    Reservar cita
                </button>
            </div>
        </form>
    @else
        <p class="text-center text-gray-600">No hay horarios disponibles para esa fecha.</p>
    @endif
</div>
</body>
</html>
