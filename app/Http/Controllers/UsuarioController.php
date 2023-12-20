<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class UsuarioController extends Controller{
    public function registerController(Request $request){
        $request->validate([
            'nombre' => 'required',
            'apellido1' => 'required',
            'apellido2' => 'required',
            'user_type' => 'required',
            'email' => 'required|email',
            'username' => 'required|unique:usuarios,username',
            'password' => 'required|min:8',
            'passwordRepeat' => 'required|same:password',
        ], [
            'nombre.required' => 'El campo Nombre es obligatorio.',
            'apellido1.required' => 'El campo Primer Apellido es obligatorio.',
            'apellido2.required' => 'El campo Segundo Apellido es obligatorio.',
            'user_type.required' => 'El campo Tipo de Usuario es obligatorio.',
            'email.required' => 'El campo Correo Electrónico es obligatorio.',
            'email.email' => 'Por favor, ingresa una dirección de correo electrónico válida.',
            'username.required' => 'El campo Usuario es obligatorio.',
            'username.unique' => 'El nombre de usuario ya está en uso.',
            'password.required' => 'El campo Contraseña es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'passwordRepeat.required' => 'El campo Repetir Contraseña es obligatorio.',
            'passwordRepeat.same' => 'Las contraseñas no coinciden.',
        ]);

        $userData = [
            'nombre' => $request->input('nombre'),
            'apellido1' => $request->input('apellido1'),
            'apellido2' => $request->input('apellido2'),
            'user_type' => $request->input('user_type') == 'usuario' ? 1 : ($request->input('user_type') == 'ponente' ? 2 : 3),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
        ];

        $userModel = new Usuario();
        $userCreated = $userModel->registerModel($userData);

        if ($userCreated) {
            return redirect()->route('login')->with('success', '¡Registro exitoso! Ahora puedes iniciar sesión.');
        } else {
            return redirect()->back()->withErrors(['Ha habido un error inesperado, vuelva a intentar el registro']);
        }
    }
    public function loginController(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:8',
        ], [
            'username.required' => 'El campo Usuario es obligatorio.',
            'password.required' => 'El campo Contraseña es obligatorio.',
            'password.min' => 'La contraseña debe tener un formato correcto.',
            'password.required' => 'El campo Contraseña es obligatorio.',
        ]);

        $userData = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        $userModel = new Usuario();
        $userLogin = $userModel->loginModel($userData);

        if ($userLogin) {
            session(['userInfo' => $userLogin]);
            $login = '¡Bienvenido, ' . $userLogin->username . '!';
            return redirect()->route('panel-personal')->with('success', $login);
        } else {
            return redirect()->back()->withErrors(['Parece que el usuario o la contraseña no son correctos.']);
        }
    }
    public function updateController(Request $request){
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|email',
            'old_password' => 'required|string',
            'new_password' => 'nullable|string|min:8',
            'new_passwordRepeat' => 'nullable|string|min:8|same:new_password',
        ], [
            'username.required' => 'El campo nombre de usuario es obligatorio.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'Por favor, introduce un correo electrónico válido.',
            'old_password.required' => 'El campo contraseña actual es obligatorio.',
            'new_password.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
            'new_passwordRepeat.same' => 'La confirmación de la nueva contraseña no coincide.',
        ]);

        $userInfo = $request->session()->get('userInfo');
        $userData = [
            'id_usuario' => $userInfo->id_usuario,
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'old_password' => $request->input('old_password'),
            'new_password' => $request->input('new_password'),
        ];

        $userModel = new Usuario();
        $userUpdate = $userModel->updateModel($userData);

        if ($userUpdate) {
            session(['userInfo' => $userUpdate]);
            $update = 'Se han actualizado tus datos ' . $userUpdate->username . '!';
            return redirect()->route('panel-personal')->with('success', $update);
        } else {
            return redirect()->back()->withErrors(['No se han podido actualizar tus datos.']);
        }
    }
}