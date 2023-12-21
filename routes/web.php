<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ActoController;
use App\Http\Controllers\TiposActoController;
use App\Http\Controllers\PonenteController;
use App\Http\Controllers\PersonasController;

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

Route::get('/panel-personal' , [ActoController::class, 'showPersonalPanel'])->name('panel-personal');

Route::get('/editar-perfil', function () {
    (new SessionController())->shareData();
    return view('edit-profile');
})->name('editar-perfil');

Route::post('/editar-perfil', [UsuarioController::class, 'updateController'])->name('update.post');

Route::get('/panel-administracion', function () {
    (new SessionController())->shareData();
    $actoController = new ActoController();
    $actos = $actoController->getActos();
    $tiposActoController = new TiposActoController();
    $tiposActo = $tiposActoController->getTiposActo();
    $ponenteController = new PonenteController();
    $ponentes = $ponenteController->getPonentes();
    $personasController = new PersonasController();
    $personas = $personasController->getPersonas();
    
    return view('admin-panel', ['actos' => $actos, 'tiposActo' => $tiposActo, 'ponentes' => $ponentes, 'personas' => $personas]);
})->name('panel-administracion');

Route::match(['put', 'delete'], '/tipo-acto/{id}', [TiposActoController::class, 'handleTipoActo'])->name('handle-tipo-acto.route');

Route::put('/update-tipo-acto', [TiposActoController::class, 'updateTipoActo'])->name('update-tipo-acto.post');

