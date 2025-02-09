<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //metodo para mostrar todos los usuatios
    public function index()

    {
       $users = User::paginate(5);
        return view('admin.users-all',compact('users'));
    }


    public function edit($id)

    {
        //obtener el usuario que se va a editar
        $user  = User::findOrFail($id);
        return view('admin.edit-user',compact('user'));
    }

    // metodo para editar un usuario
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'address' => 'nullable|string|max:255',
            'document' => 'nullable|string|max:255',
            'role' => 'required|string|in:patient,doctor',
            'speciality' => 'nullable|string|max:255'
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->address = $request->address;
        $user->document = $request->document;
        $user->speciality = $request->speciality;
        $user->syncRoles([$request->input('role')]);        $user->save();

        return redirect()->route('users.index')->with('success','usuario actualizado correctamente');
    }



    public function create()

    {
        return view('admin.create-users');
    }

    //metodo para crear un nuevo usuario
    public  function store(Request $request)
    {

        // Validación de los datos recibidos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:patient,doctor',
            'address' => 'nullable|string|max:255',
            'document' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);


        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->address = $request->input('address');
        $user->document = $request->input('document');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        $user->assignRole($request->input('role'));


        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente');

    }

    //metodo para eliminar un usuario
 public function destroy($id)
 {
     //buscar usuario por id
     $user = User::findOrFail($id);
     //eliminar al usuario
     $user->delete();
   return redirect()->route('users.index')->with('success', 'usuario eliminado correctamente');
 }

}
