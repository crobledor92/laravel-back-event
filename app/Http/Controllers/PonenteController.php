<?php

namespace App\Http\Controllers;

use App\Models\Ponente;
use Illuminate\View\View;

class PonenteController extends Controller {

    public function getPonentes() {
        $ponenteModel = new Ponente();
        $ponente = $ponenteModel->getPonentes();
        return $ponente;
    }

    public function getPonenciaPersonalController($id_persona) {
        $ponenteModel = new Ponente();
        $ponencias = $ponenteModel->getPonenciaPersonalModel($id_persona);
        return $ponencias;
    }
}