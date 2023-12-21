<?php

namespace App\Http\Controllers;

use App\Models\TipoActo;
use Illuminate\View\View;
use Illuminate\Http\Request;

class TiposActoController extends Controller {

    public function getTiposActo() {
        $tiposActoModel = new TipoActo();
        $tiposActo = $tiposActoModel->getTiposActo();
        return $tiposActo;
    }

    public function updateTipoActo(Request $request) {
        try {
            $id_tipo_acto = $request->input('Id_tipo_acto');
            $descripcion = $request->input('Descripcion');
    
            $actoModel = new TipoActo();
            $actoModel->updateTipoActo($id_tipo_acto, $descripcion);
    
            return response()->json(['message' => 'Update successful']);
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['error' => $e], 500);
        }
    }

    public function deleteTipoActo(Request $request) {
        try {
            $id_tipo_acto = $request->input('Id_tipo_acto');
    
            $actoModel = new TipoActo();
            $actoModel->deleteTipoActo($id_tipo_acto);
    
            return response()->json(['message' => 'Delete successful']);
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}