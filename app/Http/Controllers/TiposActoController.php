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
    
            // Your update logic here
            //TODO: No consigo logear las variables para ver si llegan correctamente
            
    
            return response()->json(['message' => 'Update successful']);
        } catch (\Exception $e) {
            // Log the exception for debugging
            \Log::error($e);
    
            // Return an error response
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function deleteTipoActo() {
    }
}