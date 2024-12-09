<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctores Disponibles</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold mb-6 text-center">
        Doctores disponibles para el {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}
    </h2>

    <div class="max-w-md mx-auto space-y-4">
        @foreach($doctors as $doctor)
            <div class="bg-white shadow-md rounded-lg p-4 hover:bg-blue-50 transition duration-300">
                <a
                    href="{{ route('appointments.showTimes', ['doctorId' => $doctor->id, 'date' => $date]) }}"
                    class="text-blue-600 hover:text-blue-800 font-semibold"
                >
                    Dr. {{ $doctor->name }}
                </a>
            </div>
        @endforeach

        @if(count($doctors) === 0)
            <p class="text-center text-gray-600">No hay doctores disponibles para esta fecha.</p>
        @endif
    </div>
</div>
</body>
</html>
