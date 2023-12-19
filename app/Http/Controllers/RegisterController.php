<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller{
    public function showForm(){
        return view('register_view');
    }
    public function register(Request $request){
        $request->validate([
            'nombre' => 'required',
            'apellido1' => 'required',
            'apellido2' => 'required',
            'tipoUser' => 'required',
            'email' => 'required|email',
            'username' => 'required|unique:usuarios,username',
            'password' => 'required|min:8',
            'passwordRepeat' => 'required|same:password',
        ], [
            'nombre.required' => 'El campo Nombre es obligatorio.',
            'apellido1.required' => 'El campo Primer Apellido es obligatorio.',
            'apellido2.required' => 'El campo Segundo Apellido es obligatorio.',
            'tipoUser.required' => 'El campo Tipo de Usuario es obligatorio.',
            'email.required' => 'El campo Correo Electrónico es obligatorio.',
            'email.email' => 'Por favor, ingresa una dirección de correo electrónico válida.',
            'username.required' => 'El campo Usuario es obligatorio.',
            'username.unique' => 'El nombre de usuario ya está en uso.',
            'password.required' => 'El campo Contraseña es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'passwordRepeat.required' => 'El campo Repetir Contraseña es obligatorio.',
            'passwordRepeat.same' => 'Las contraseñas no coinciden.',
        ]);

        $nombre = $request->input('nombre');
        $apellido1 = $request->input('apellido1');
        $apellido2 = $request->input('apellido2');
        $user_type = $request->input('user_type') == 'usuario' ? 1 : ($request->input('user_type') == 'ponente' ? 2 : 3);
        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password');
        $passwordHash = Hash::make($password);

        $userData = [
            'nombre' => $nombre,
            'apellido1' => $apellido1,
            'apellido2' => $apellido2,
            'user_type' => $user_type,
            'email' => $email,
            'username' => $username,
            'password' => $passwordHash,
        ];

        try {
            $userCreated = Usuario::addUser($userData);

            if ($userCreated) {
                // Redireccionar a la página de inicio de sesión o realizar alguna acción después de registrar al usuario
                return redirect()->route('login.form');
            } else {
                return redirect()->back()->withErrors(['Ha habido un error inesperado, vuelva a intentar el registro']);
            }
        } catch (\Exception $e) {
            // Manejar excepciones, por ejemplo, si hay un problema con la base de datos
            return redirect()->back()->withErrors(['Ha habido un error inesperado, vuelva a intentar el registro']);
        }
    }
}