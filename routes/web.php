<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\InscritoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ActoController;
use App\Http\Controllers\TiposActoController;
use App\Http\Controllers\PonenteController;
use App\Http\Controllers\PersonasController;
use App\Http\Controllers\DocumentacionController;
use Carbon\Carbon;

Route::get('/', function () {
    (new SessionController())->shareData();
    return view('landing');
})->name('landing');

// NAVBAR

Route::get('/listado-actos', function () {
    (new SessionController())->shareData();
    $idPersona = optional(session('userInfo'))->id_persona ?? null;

    $actoController = new ActoController();
    $listadoActos = $actoController->getActos()->toArray();
    $ponenteController = new PonenteController();
    $actosPonente = $idPersona ? $ponenteController->getPonenciaPersonalController($idPersona)->toArray() : null;
    $inscritosController = new InscritoController();
    //Total de inscripciones del usuario conectado
    $actosInscrito = $idPersona ? $inscritosController->getAsistenciaPersonalController($idPersona)->toArray() : null;
    //Total de inscripciones
    $inscritos = $inscritosController->getAllInscritos();
    $documentacionController = new DocumentacionController();
    $documentos = $documentacionController->getFiles()->toArray();

    // dd($actosInscrito);

    foreach($listadoActos as $acto) {
        if ($actosPonente !== null) {
            $isPonente = array_filter($actosPonente, function ($ponente) use ($acto) {
                return $ponente->id_acto === $acto->id_acto;
            });
            
            if ($isPonente) {
                $acto->status = 'ponente';
                continue;
            }
        }

        if ($actosInscrito !== null) {
            $isInscrito = Arr::first($actosInscrito, function ($inscrito) use ($acto) {
                return $inscrito->id_acto === $acto->id_acto;
            });

            if ($isInscrito !== null) {
                $acto->status = 'inscrito';
                $acto->id_inscripcion = $isInscrito->id_inscripcion;
                continue;
            }
        }

        $acto->status = 'noInscrito';
    
    }

    foreach($listadoActos as $acto) {
        $combinedDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $acto->fecha . ' ' . $acto->hora);

        if ($combinedDateTime->isBefore(Carbon::now())) {
            $acto->isFinished = true;
        } else {
            $acto->isFinished = false;
        }

        $totalInscritos = array_filter($inscritos, function ($inscrito) use ($acto) {
            return $inscrito->id_acto === $acto->id_acto;
        });

        $acto->totalInscritos = count($totalInscritos);

        $documentosActo = array_filter($documentos, function ($documento) use ($acto) {
            return $documento->id_acto === $acto->id_acto;
        });

        // if(count($documentosActo) > 0) {
        //     dd($documentosActo);
        // }

        $documentosOrdenados = collect($documentosActo)->sortBy('orden')->values()->all();
        
        $acto->documentos = $documentosOrdenados;
    }

    return view('actos-list',['actos' => $listadoActos, 'idPersona' => $idPersona]);
})->name('listado-actos.get');

Route::post('/addFile', [DocumentacionController::class, 'addFile'])->name('addFile.post');

Route::post('/update-files-order', [DocumentacionController::class, 'updateFilesOrder'])->name('updateFilesOrder.post');

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

Route::get('/panel-personal', [ActoController::class, 'showPersonalPanel'])->name('panel-personal');

Route::post('/panel-personal', [InscritoController::class, 'HandleGoAssistanceController'])->name('HandleGoAssistance.post');

Route::get('/editar-perfil', function () {
    (new SessionController())->shareData();
    return view('edit-profile');
})->name('editar-perfil');

Route::post('/editar-perfil', [UsuarioController::class, 'updateController'])->name('update.post');

//LISTADO ACTOS VIEW

Route::get('/actos-filtrados', [ActoController::class, 'filterActos'])->name('actos-filtrados.get');


//ADMIN PANEL ROUTES
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

//Add Actos routes
Route::get('/incluir-nuevo-acto', function () {
    (new SessionController())->shareData();
    $tiposActoController = new TiposActoController();
    $tiposActo = $tiposActoController->getTiposActo();
    $personasController = new PersonasController();
    $personas = $personasController->getPersonas();
    return view('add-acto', ['listaTiposActos' => $tiposActo,'personas' => $personas]);
})->name('add-acto');

Route::post('/incluir-nuevo-acto', [ActoController::class, 'addActo'])->name('add-acto.post');

//Modify actos routes
Route::get('/udpateActo/{id}', [ActoController::class, 'getActoData'])->name('get-acto-data.get');

Route::post('/update-acto', [ActoController::class, 'updateActo'])->name('update-acto.post');

// Inscritos routes
Route::get('/panel-administracion/handleInscritos/{id}', [InscritoController::class, 'getActoInscritos'])->name('get-acto-inscritos.get');

Route::post('/addInscripcion', [InscritoController::class, 'addInscripcion'])->name('add-inscrito.post');

Route::delete('/deleteActoInscrito', [InscritoController::class, 'deleteActoInscrito'])->name('delete-inscrito.delete');


// Tipo acto routes
Route::post('/panel-administracion/addTipoActo', [TiposActoController::class, 'addTipoActo'])->name('add-tipo-acto.post');

Route::put('/panel-administracion/updateTipoActo', [TiposActoController::class, 'updateTipoActo'])->name('update-tipo-acto.put');

Route::delete('/panel-administracion/deleteTipoActo', [TiposActoController::class, 'deleteTipoActo'])->name('delete-tipo-acto.delete');

//Ponente routes
Route::post('/panel-administracion/addPonente', [PonenteController::class, 'addPonente'])->name('add-ponente.post');

Route::delete('/panel-administracion/deletePonente', [PonenteController::class, 'deletePonente'])->name('delete-ponente.delete');

// PRUEBAS:

Route::get('/listado-actos2', function () {
    (new SessionController())->shareData();
    $listadoActosHTML = (new ActoController())->listadoActosHTMLController();
    return view('actos-lista',['listadoActosHTML' => $listadoActosHTML]);
})->name('listado-actos2.get');
