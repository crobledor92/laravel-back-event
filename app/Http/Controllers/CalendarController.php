<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class CalendarController extends Controller
{
    public function generarCalendario()
    {
        $mesActual = date('m');
        $anioActual = date('Y');
        $listaActos = obtenerListaActos();
        $userInfo = obtenerUserInfo();
        $listaInscripcionesActos = obtenerListaInscripcionesActos();

        return view('calendar', compact('mesActual', 'anioActual', 'listaActos', 'userInfo', 'listaInscripcionesActos'));
    }
}