<!-- resources/views/admin/generate_schedule.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Horario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Generar Horario para Médico</h1>
    <form action="{{ route('show.allschedule') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="doctor_id" class="form-label">Seleccionar Médico</label>
            <select name="doctor_id" id="doctor_id" class="form-select" required>
                <option value="">Seleccione un médico</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="start_time" class="form-label">Hora de Inicio</label>
            <input type="time" name="start_time" id="start_time" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">Hora de Fin</label>
            <input type="time" name="end_time" id="end_time" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="duration" class="form-label">Duración de la Cita (en minutos)</label>
            <input type="number" name="duration" id="duration" class="form-control" min="5" required>
        </div>

        <button type="submit" class="btn btn-primary">Generar Horarios</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
