@extends('layouts.layoutClinic')

@section('contenido')

    <h2 class="text-center">Crear usuario</h2> <br>

   <form action="{{route('users.store')}}" method="POST" >

       @csrf
       @method('POST')
       <div class="form-group">
           <label for="name">
               Nombre
           </label>
           <input name="name" id="name" type="text" class="form-control" placeholder="nombre en letras" required>
       </div>
        <div class="form-group">
        <label for="email" class="text-black">Correo electronico</label>
        <input name="email" id="email"  class="form-control" type="email" placeholder="escribe el correo electronico" required>
        </div>
       <div class="form-group">
           <label for="role" class="text-black">Tipo de usuario</label>
             <select   name="role" class="form-control">
                 <option value="patient">Paciente</option>
                 <option value="doctor">Doctor</option>

             </select>
       </div>

       <div class="form-group">
           <label for="password" class="text-black">Contraseña</label>
           <input name="password" id="password" class="form-control" type="password" placeholder="Crea una contraseña" required>
       </div>

       <div class="form-group">
           <label for="password_confirmation" class="text-black">Confirmar Contraseña</label>
           <input name="password_confirmation" id="password_confirmation" class="form-control" type="password" placeholder="Confirma tu contraseña" required>
       </div>


       <div class="form-group">
           <label for="address" class="text-black">Direccion</label>
           <input name="address" id="address"  class="form-control" type="text" placeholder="escribe tu direccion">
       </div>
       <div class="form-group">
           <label for="document" class="text-black">Documento</label>
           <input name="document" id="document"  class="form-control" type="text" placeholder="escribe numero de documento">
       </div>

       <button type="submit" class="btn btn-dark">Crear usuario</button>
   </form>
@endsection
