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
        ]);

        $nombre = $request->input('nombre');
        $apellido1 = $request->input('apellido1');
        $apellido2 = $request->input('apellido2');
        $tipoUser = $request->input('tipoUser') == 'usuario' ? 1 : ($request->input('tipoUser') == 'ponente' ? 2 : 3);
        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password');
        $passwordHash = Hash::make($password);

        $userData = [
            'nombre' => $nombre,
            'apellido1' => $apellido1,
            'apellido2' => $apellido2,
            'tipoUser' => $tipoUser,
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