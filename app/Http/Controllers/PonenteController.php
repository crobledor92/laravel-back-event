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
}