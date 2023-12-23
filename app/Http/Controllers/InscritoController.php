<?php

namespace App\Http\Controllers;

use App\Models\Inscrito;
use Illuminate\View\View;
use Illuminate\Http\Request;

class InscritoController extends Controller {
    public function getAsistenciaPersonalController($id_persona) {
        return (new Inscrito())->getAsistenciaPersonalModel($id_persona);
    }
    public function HandleGoAssistanceController(Request $request) {
        $data=[
            'id_persona' => $request->input('id_persona'),
            'id_acto' => $request->input('id_acto'),
        ];
        $inscripciones = (new Inscrito())->HandleGoAssistanceModel($data);
        if ($inscripciones) {
            return response()->json(['success' => true, 'mensaje' => 'hola']);
        } else {
            return response()->json(['success' => true]);
        }
    }
}