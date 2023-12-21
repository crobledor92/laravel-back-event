<?php

namespace App\Http\Controllers;

use App\Models\TipoActo;
use Illuminate\View\View;

class TiposActoController extends Controller {

    public function getTiposActo() {
        $tiposActoModel = new TipoActo();
        $tiposActo = $tiposActoModel->getTiposActo();
        return $tiposActo;
    }

    public function handleTipoActo($tipoActoId) {
        $discripcion = request('descripcion');
        dd($descripcion);

        dd('llegaaaaa');

        return route('panel-administracion');
    }

    public function deleteTipoActo() {
    }
}