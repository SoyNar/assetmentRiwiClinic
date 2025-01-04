<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Atención - Tu Clínica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Detalles de la cita</h2>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h4>Nombre del paciente: <span class="fw-normal">{{ $appointment->user->name }}</span></h4>
                </div>
                <div class="col-md-6">
                    <h4>Motivo: <span class="fw-normal">{{ $appointment->reason }}</span></h4>
                </div>
            </div>

            <h3 class="mb-3">Registrar otros datos de la atención</h3>
            <form action="{{ route('appointment.registerAttention', ['appointmentId' => $appointment->id]) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="symptoms" class="form-label">Síntomas</label>
                    <textarea class="form-control" id="symptoms" name="symptoms" rows="3" placeholder="Registra los síntomas"></textarea>
                </div>

                <div class="mb-3">
                    <label for="medications" class="form-label">Medicamentos enviados</label>
                    <input type="text" class="form-control" id="medications" name="medications" placeholder="Receta médica">
                </div>

                <div class="mb-3">
                    <label for="treatment" class="form-label">Recomendaciones</label>
                    <input type="text" class="form-control" id="treatment" name="treatment" placeholder="Registra las recomendaciones">
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Fecha de atención</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>

                <button type="submit" class="btn btn-primary">Registrar atención</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
