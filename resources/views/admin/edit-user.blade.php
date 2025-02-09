@extends('layouts.layoutClinic')

@section('contenido')
    <h2 class="text-center mb-4">Editar usuario</h2>

    <!-- Tarjeta con los datos del usuario -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Detalles del usuario</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input name="name" id="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="email" class="text-black">Correo electrónico</label>
                    <input name="email" id="email" class="form-control" type="email" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="role" class="text-black">Tipo de usuario</label>
                    <select name="role" class="form-control">
                        <option value="patient" {{ old('role', $user->hasRole('patient') ? 'selected' : '') }}>Paciente</option>
                        <option value="doctor" {{ old('role', $user->hasRole('doctor') ? 'selected' : '') }}>Doctor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="speciality" class="text-black">Especialidad</label>
                    <input name="speciality" id="speciality" class="form-control" type="text" value="{{ old('speciality', $user->speciality ?? 'no definida') }}" >
                </div>

                <div class="form-group">
                    <label for="password" class="text-black">Contraseña</label>
                    <input name="password" id="password" class="form-control" type="password" placeholder="Deja en blanco si no deseas cambiar la contraseña">
                </div>

                <div class="form-group">
                    <label for="address" class="text-black">Dirección</label>
                    <input name="address" id="address" class="form-control" type="text" value="{{ old('address', $user->address ?? 'sin direccion') }}">
                </div>

                <div class="form-group">
                    <label for="document" class="text-black">Documento</label>
                    <input name="document" id="document" class="form-control" type="text" value="{{ old('document', $user->document) }}">
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-dark" onclick="return confirm('Esta seguro que desea actualizar los datos?')">Actualizar usuario</button>
                </div>
            </form>

            <a href="{{route('users.index')}}" class="btn btn-success">Volver</a>
        </div>
    </div>
@endsection
