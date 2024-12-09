<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterDoctorRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorAuthController extends Controller
{
    public function showFormRegister()
    {
         return view('doctor.register');
    }

    public function registerDoctor(RegisterDoctorRequest $request)
    {



        $doctor = User::create([
            'name'=> $request->validated()['name'],
            'email' => $request->validated()['email'],
            'password' => Hash::make($request->validated()['password']),
            'spelciality' => $request->validated()['spelciality'],
            'address' => $request->validated()['address'],
            'document' => $request->validated()['document'],
        ]);

        $doctor->assignRole('doctor');

        return redirect()->route('login')->with('success', 'Registro exitoso. Ahora puedes iniciar sesión.');

    }
}
