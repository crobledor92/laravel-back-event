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

            return redirect()->back();
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['error' => $e], 500);
        }
    }

    public function deletePonente(Request $request) {
        try {
            $idPersona = $request->input('id_persona');
            $idActo = $request->input('id_acto');

            $ponenteModel = new Ponente();
            $ponenteModel->deletePonente($idPersona, $idActo);

            return redirect()->back();
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['error' => $e], 500);
        }
    }
}