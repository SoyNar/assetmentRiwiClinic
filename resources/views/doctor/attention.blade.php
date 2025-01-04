<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas Agendadas - Tu Clínica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h1 class="mb-0">Citas Agendadas</h1>
            <img src="{{ asset('ruta/a/tu/logo.png') }}" alt="Logo de la Clínica" height="50">
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-light">
                <tr>
                    <th>Nombre</th>
                    <th>Motivo</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->user->name }}</td>
                        <td>{{ $appointment->reason }}</td>
                        <td>{{ $appointment->status }}</td>

                        <td>
                            <a href="{{ route('appointment.showRegisterAttention', ['appointmentId' => $appointment->id]) }}"
                               class="btn btn-primary btn-sm {{ $appointment->status === 'attended' ? 'disabled' : '' }}"
                                {{ $appointment->status === 'attended' ? 'aria-disabled="true" tabindex="-1"' : '' }}>
                                Registrar Atención
                            </a>
                            <form action="{{ route('appointment.cancel', ['appointmentId' => $appointment->id]) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit"
                                        class="btn btn-danger btn-sm {{ $appointment->status === 'attended' ? 'disabled' : '' }}"
                                        {{ $appointment->status === 'attended' ? 'disabled' : '' }}
                                        onclick="return confirm('¿Estás seguro de que deseas cancelar esta cita?')">
                                    Cancelar Cita
                                </button>
                            </form>
                            <a href="" type="button" class="btn btn-primary">Ver historial</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
