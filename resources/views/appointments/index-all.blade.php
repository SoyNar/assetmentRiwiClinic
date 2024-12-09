@extends('layouts.appClinical') <!-- Extiende el layout -->

@section('title', 'Mis Citas Médicas') <!-- Sobrescribe el título de la página -->

@section('content') <!-- Define el contenido principal -->
<h1>Citas Médicas Agendadas</h1>

<!-- Aquí puedes mostrar las citas o cualquier otra información -->
@if($appointments->isEmpty())
    <p>No tienes citas médicas agendadas.</p>
@else
    <table>
        <thead>
        <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Descripción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($appointments as $appointment)
            <tr>
                <td>{{ $appointment->appointment_date }}</td>
                <td>{{ $appointment->start_date }}</td>
                <td>{{ $appointment->reason }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
@endsection
