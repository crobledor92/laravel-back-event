<?php

namespace App\Http\Controllers;

use App\Models\Acto;
use Illuminate\View\View;

class ActoController extends Controller {

    public function getActos() {
        $actoModel = new Acto();
        $actos = $actoModel->getActos();
        return $actos;
    }

    public function showPersonalPanel(): View {
        (new SessionController())->shareData();
        $actoController = new ActoController();
        $actos = $this->getActos();
        return view('personal-panel', ['actos' => $actos]);
    }
}