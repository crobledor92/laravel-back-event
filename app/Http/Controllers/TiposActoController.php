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

    public function addTipoActo(Request $request) {
        try {
            $descripcion = $request->input('descripcion');

            $actoModel = new TipoActo();
            $actoModel->addTipoActo($descripcion);

            return redirect()->back()->with('success', 'Tipo de acto creado con exito!');
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['error' => $e], 500);
        }
    }

    public function updateTipoActo(Request $request) {
        try {
            $id_tipo_acto = $request->input('Id_tipo_acto');
            $descripcion = $request->input('Descripcion');
            $actoModel = new TipoActo();
            $actoModel->updateTipoActo($id_tipo_acto, $descripcion);
            return response()->json(['success' => true, 'message' => 'Tipo de acto actualizado con exito!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'No se ha posido actualizar el tipo!'], 500);
        }
    }

    public function deleteTipoActo(Request $request) {
        try {
            $id_tipo_acto = $request->input('Id_tipo_acto');
            $actoModel = new TipoActo();
            $actoModel->deleteTipoActo($id_tipo_acto);
            return response()->json(['success' => true, 'message' => 'Tipo de acto eliminado con exito!']);
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['success' => false, 'message' => 'No se puede eliminar, esta en uso.'], 500);
        }
    }
}