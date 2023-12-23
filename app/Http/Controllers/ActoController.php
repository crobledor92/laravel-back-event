<?php

namespace App\Http\Controllers;

use App\Models\Acto;
use Illuminate\View\View;
use App\Http\Controllers\PonenteController;
use App\Http\Controllers\InscritoController;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ActoController extends Controller {
    public function getActos() {
        $actoModel = new Acto();
        $actos = $actoModel->getActos();
        return $actos;
    }
    public function showPersonalPanel(): View {
        (new SessionController())->shareData();
        $id_personal = optional(session('userInfo'))->id_persona;
        $actos = $this->getActos();
        $inscritos_controller = new InscritoController();
        $inscripciones = $inscritos_controller->getAsistenciaPersonalController($id_personal);
        $ponencias_controller = new PonenteController();
        $ponencias = $ponencias_controller->getPonenciaPersonalController($id_personal);
        return view('personal-panel',['actos' => $actos,'inscripciones' => $inscripciones,'ponencias' => $ponencias]);
    }
    
    public function addActo(Request $request) {
        
            $request->validate([
                'fecha' => 'required',
                'hora' => 'required',
                'titulo' => 'required',
                'resumen' => 'required',
                'descripcion' => 'required',
                'asistentes' => 'required',
                'tipoActo' => 'required', 
            ], [
                'fecha.required' => 'El campo Fecha es obligatorio.',
                'hora.required' => 'El campo Hora es obligatorio.',
                'titulo.required' => 'El campo Título es obligatorio.',
                'resumen.required' => 'El campo Resumen es obligatorio.',
                'descripcion.required' => 'El campo CDescripción es obligatorio.',
                'asistentes.required' => 'El campo Asistenetes es obligatorio.',
                'tipoActo.required' => 'El campo Tipo de Acto es obligatorio.',
            ]);
            $actoData = [
                'fecha' => $request->input('fecha'),
                'hora' => $request->input('hora'),
                'titulo' => $request->input('titulo'),
                'descripcion_corta' => $request->input('resumen'),
                'descripcion_larga' => $request->input('descripcion'),
                'num_asistentes' => $request->input('asistentes'),
                'id_tipo_acto' =>  $request->input('tipoActo'), 
            ];
            $actoCreated = (new Acto())->addActo($actoData);

            return redirect()->route('panel-administracion')->with('success', 'Acto creado');       

    }

    public function updateActo(Request $request) {
        return true;
    }

    public function getActoByID(Request $request){
        $id_acto = $request->input('id_acto');
        $actoModel = new Acto();
        $actoData = $actoModel->getActoByIDModel($id_acto);
        info($actoData);
        return view('update-acto',['actoData' ->  $actoData]);
    }
}
