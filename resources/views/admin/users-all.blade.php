@extends('layouts.layoutClinic')

@section('contenido')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div>
        <table class="table">
            <thead>

            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Tipo de usuario</th>
                <th>Direccion</th>
                <th>Documento</th>
                <th>Especialidad</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>

                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    {{ in_array($user->roles->first()->name, ['patient', 'doctor', 'admin']) ?
                    ($user->hasRole('patient') ? 'Paciente' :
                    ($user->hasRole('doctor') ? 'Doctor' :
                    ($user->hasRole('admin') ? 'Administrador' : 'No especificado')))
                : 'No especificado' }}
                </td>
                    <td>{{$user->address ?? 'Desconocido'}}</td>
                    <td>{{$user->document ?? 'Desconocido'}}</td>
                    <td>
                        @if(in_array($user->roles->first()->name, ['patient', 'admin']))
                            No aplica
                        @else
                            {{ $user->speciality ?? 'No especificado' }}
                        @endif
                    </td>
                <td>

                    <a href="{{route('users.edit',$user->id)}}" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="{{route('users.destroy', $user->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('esta seguro que desea elminar el usuario')">Eliminar</button>
                    </form>
                </td>

            </tr>
            @endforeach
            </tbody>
            <a type="button" class="btn btn-success" href="{{route('users.create')}}">Crear usuario</a>
        </table>
        <div>
            {{$users->onEachSide(1)->links('pagination::bootstrap-4')}}
        </div>
    </div>
@endsection
