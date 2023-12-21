<?php

namespace App\Http\Controllers;

use App\Models\Acto;
use Illuminate\View\View;
use App\Http\Controllers\PonenteController;
use App\Http\Controllers\InscritoController;
use Illuminate\Support\Facades\Session;

class ActoController extends Controller {
    public function getActos() {
        $actoModel = new Acto();
        $actos = $actoModel->getActos();
        return $actos;
    }
    public function showPersonalPanel(): View {
        (new SessionController())->shareData();
        $inscritos_controller = new InscritoController();
        $actos = $this->getActos();
        $id_personal = optional(session('userInfo'))->id_persona;
        $inscritos = $inscritos_controller->getAsistenciaPersonalController($id_personal);
        return view('personal-panel',['actos' => $actos,'inscritos' => $inscritos]);
    }
}