<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class CalendarController extends Controller{
    public function obtenerEventos(){
        $eventos = [
            (object)['nombre' => 'Evento 1', 'descripcion' => 'Descripción del Evento 1'],
            (object)['nombre' => 'Evento 2', 'descripcion' => 'Descripción del Evento 2'],
        ];
        return $eventos;
    }
}