<?php

namespace App\Http\Controllers;

use App\Models\Ponente;
use Illuminate\View\View;
use Illuminate\Http\Request;

class PonenteController extends Controller {

    public function getPonentes() {
        $ponenteModel = new Ponente();
        $ponentes = $ponenteModel->getPonentes();
        return $ponentes;
    }

    public function getPonenciaPersonalController($id_persona) {
        $ponenteModel = new Ponente();
        $ponencias = $ponenteModel->getPonenciaPersonalModel($id_persona);
        return $ponencias;
    }

    public function addPonente(Request $request) {
        try {
            $idPersona = $request->input('id_persona');
            $idActo = $request->input('id_acto');

            $ponenteModel = new Ponente();
            $ponenteModel->addPonente($idPersona, $idActo);

            return response()->json(['success' => true, 'message' => 'Ponente añadido con éxito']);
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['success' => false, 'message' => 'Error al añadir ponente', 'error' => $e->getMessage()], 500);
        }
    }
    public function deletePonente(Request $request) {
        try {
            $idPersona = $request->input('id_persona');
            $idActo = $request->input('id_acto');

            $ponenteModel = new Ponente();
            $ponenteModel->deletePonente($idPersona, $idActo);

            return response()->json(['success' => true, 'message' => 'Ponente eliminado con éxito']);
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['success' => false, 'message' => 'Error al eliminar ponente', 'error' => $e->getMessage()], 500);
        }
    }
}