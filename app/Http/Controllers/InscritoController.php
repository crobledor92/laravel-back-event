<?php

namespace App\Http\Controllers;

use App\Models\Inscrito;
use App\Models\Persona;
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
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => true]);
        }
    }

    public function getActoInscritos($id) {
        (new SessionController())->shareData();
        $InscritoModel = new Inscrito();
        $actoInscritos = $InscritoModel->getInscritosActo($id)->toArray();
        $personasModel = new Persona();
        $personas = $personasModel->getPersonas();
        $personasAInscribir = [];

        foreach ($personas as $persona) {
            $isSuscribed = array_filter($actoInscritos, function ($inscrito) use ($persona) {
                return $inscrito->id_persona === $persona->id_persona;
            });

            if (count($isSuscribed) == 0) {
                $personasAInscribir[] = $persona;
            }
        }

        return view('update-inscritos', ['inscritos' => $actoInscritos, 'personas' => $personasAInscribir, 'actoId' => $id]);
    }

    public function deleteActoInscrito(Request $request) {
        (new SessionController())->shareData();
        $id_inscripcion = $request->input('id_inscripcion');
        $id_acto = $request->input('id_acto');
        $InscritoModel = new Inscrito();
        $actoInscritos = $InscritoModel->deleteActoInscrito($id_inscripcion);

        return $this->getActoInscritos($id_acto);
    }

    public function addInscripcion(Request $request) {
        (new SessionController())->shareData();
        $data = [
            'id_acto' => $request->input('id_acto'),
            'id_persona' => $request->input('id_persona'),
            'fecha_inscripcion' => now(),
        ];

        $InscritoModel = new Inscrito();
        $actoInscritos = $InscritoModel->addInscrito($data);

        return $this->getActoInscritos($request->input('id_acto'));
    }
}