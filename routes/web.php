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

Route::post('/panel-administracion', [ActoController::class, 'getActoByID'])->name('update-acto.post');

Route::post('/modificar-acto', [ActoController::class, 'updateActo'])->name('update-acto.post');

Route::get('/incluir-nuevo-acto', function () {
    (new SessionController())->shareData();
    $tiposActoController = new TiposActoController();
    $tiposActo = $tiposActoController->getTiposActo();
    $personasController = new PersonasController();
    $personas = $personasController->getPersonas();
    return view('add-acto', ['listaTiposActos' => $tiposActo,'personas' => $personas]);
})->name('add-acto');

Route::post('/incluir-nuevo-acto', [ActoController::class, 'addActo'])->name('add-acto.post');

Route::get('/modificar-acto', function () {
    (new SessionController())->shareData();
    $tiposActoController = new TiposActoController();
    $tiposActo = $tiposActoController->getTiposActo();
    $personasController = new PersonasController();
    $personas = $personasController->getPersonas();
    return view('update-acto', ['listaTiposActos' => $tiposActo]);
})->name('update-acto');

Route::put('/panel-administracion', [TiposActoController::class, 'updateTipoActo'])->name('update-tipo-acto.put');

Route::delete('/panel-administracion', [TiposActoController::class, 'deleteTipoActo'])->name('delete-tipo-acto.delete');

Route::post('/panel-administracion', [TiposActoController::class, 'addTipoActo'])->name('add-tipo-acto.post');

Route::delete('/panel-administracion', [PonenteController::class, 'deletePonente'])->name('delete-ponente.delete');