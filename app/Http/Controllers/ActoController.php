<?php

namespace App\Http\Controllers;

use App\Models\Acto;
use Illuminate\View\View;
use App\Http\Controllers\PonenteController;
use App\Http\Controllers\InscritoController;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ActoController extends Controller {
    public function getActos() {
        $actoModel = new Acto();
        $actos = $actoModel->getActos();
        return $actos;
    }
    public function showPersonalPanel(): View {
        (new SessionController())->shareData();
        $id_personal = optional(session('userInfo'))->id_persona;
        $actos = $this->getActos();
        $inscritos_controller = new InscritoController();
        $inscripciones = $inscritos_controller->getAsistenciaPersonalController($id_personal);
        $ponencias_controller = new PonenteController();
        $ponencias = $ponencias_controller->getPonenciaPersonalController($id_personal);
        return view('personal-panel',['actos' => $actos,'inscripciones' => $inscripciones,'ponencias' => $ponencias]);
    }
    public function addActo(Request $request) {
        return true;
    }
}

