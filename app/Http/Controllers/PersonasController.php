<?php

namespace App\Http\Controllers;

use App\Models\Personas;
use Illuminate\View\View;

class PersonasController extends Controller {
    public function getPersonas() {
        $personasModel = new Personas();
        $personas = $personasModel->getPersonas();
        return $personas;
    }
}