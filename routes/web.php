<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ActoController;

Route::get('/', function () {
    (new SessionController())->shareData();
    return view('landing');
})->name('landing');

Route::get('/registrarse', function () {
    (new SessionController())->shareData();
    return view('register');
})->name('registrarse');
Route::post('/registrarse', [UsuarioController::class, 'registerController'])->name('register.post');

Route::get('/iniciar-sesion', function () {
    (new SessionController())->shareData();
    return view('login');
})->name('iniciar-sesion');
Route::post('/iniciar-sesion', [UsuarioController::class, 'loginController'])->name('login.post');

Route::get('/cerrar-sesion', function () {
    (new SessionController())->clearSessionData();
    session()->flash('success', 'Cerraste sesión.');
    return redirect()->route('iniciar-sesion');
})->name('cerrar-sesion');

Route::get('/panel-personal', function () {
    (new SessionController())->shareData();
    $actoController = new ActoController();
    $actos = $actoController->getActos();
    return view('personal-panel', ['actos' => $actos]);
})->name('panel-personal');

Route::get('/editar-perfil', function () {
    (new SessionController())->shareData();
    return view('edit-profile');
})->name('editar-perfil');
Route::post('/editar-perfil', [UsuarioController::class, 'updateController'])->name('update.post');

Route::get('/panel-administracion', function () {
    (new SessionController())->shareData();
    return view('admin-panel');
})->name('panel-administracion');