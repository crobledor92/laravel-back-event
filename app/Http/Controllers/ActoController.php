<?php

namespace App\Http\Controllers;

use App\Models\Acto;

class ActoController extends Controller {

    public function getActos() {
        $actoModel = new Acto();
        $actos = $actoModel->getActos();

        return $actos;
    }
}