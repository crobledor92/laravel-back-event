<?php

namespace App\Http\Controllers;

use App\Models\Inscrito;
use Illuminate\View\View;

class InscritoController extends Controller {
    public function getAsistenciaPersonalController($id_persona) {
        $inscritoModel = new Inscrito();
        $inscripciones = $inscritoModel->getAsistenciaPersonalModel($id_persona);
        return $inscripciones;
    }
}