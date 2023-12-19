<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class SessionController extends Controller{
    public function shareData(){
        $userInfo = Session::get('userInfo', null);
        $actos = Session::get('actos', null);
        $listaInscripcionesActos = Session::get('listaInscripcionesActos', null);
        $listaTiposActos = Session::get('listaTiposActos', null);
        $personas = Session::get('personas', null);
        View::share('userInfo', $userInfo);
        View::share('actos', $actos);
        View::share('listaInscripcionesActos', $listaInscripcionesActos);
        View::share('listaTiposActos', $listaTiposActos);
        View::share('personas', $personas);
    }
}
