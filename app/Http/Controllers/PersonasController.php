<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\View\View;

class PersonasController extends Controller {
    public function getPersonas() {
        $personasModel = new Persona();
        $personas = $personasModel->getPersonas();
        return $personas;
    }
}