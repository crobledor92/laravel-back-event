<?php

namespace App\Http\Controllers;

use App\Models\Acto;
use App\Models\Ponente;
use App\Models\Documentacion;
use App\Models\Inscrito;
use Illuminate\View\View;
use App\Http\Controllers\PonenteController;
use App\Http\Controllers\InscritoController;
use App\Http\Controllers\DocumentacionController;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ActoController extends Controller {

    public function getActos() {
        $actoModel = new Acto();
        $actos = $actoModel->getActos();
        return $actos;
    }

    public function filterActos(Request $request) {
        $selectedStatus = $request->input('selectedStatus');
        $actos = $request->input('actos');

        if ($selectedStatus === "todos") {
            return response()->json(['filteredActos' => $actos]);
        }

        $filteredActos = array_filter($actos, function ($acto) use ($selectedStatus) {
            return $acto["status"] === $selectedStatus;
        });
    
        return response()->json(['filteredActos' => $filteredActos]);
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

        $actoId = (new Acto())->addActo($actoData);

        $newPonentesId = $request->input('personasId');

        forEach($newPonentesId as $newPonenteId) {
            $ponenteModel = new Ponente();
            $ponenteModel->addPonente($newPonenteId, $actoId);
        }

        return redirect()->route('panel-administracion')->with('success', 'Acto creado');       
    }

    public function getActoData($id) {
        (new SessionController())->shareData();
        $tiposActoController = new TiposActoController();
        $tiposActo = $tiposActoController->getTiposActo();
        $actoModel = new Acto();
        $actoData = $actoModel->getActoByIDModel($id);
        return view('update-acto', ['tiposActo' => $tiposActo, 'actoData' => $actoData]);
    }

    public function updateActo(Request $request) {
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
            'id_acto' => $request->input('id_acto'),
            'fecha' => $request->input('fecha'),
            'hora' => $request->input('hora'),
            'titulo' => $request->input('titulo'),
            'descripcion_corta' => $request->input('resumen'),
            'descripcion_larga' => $request->input('descripcion'),
            'num_asistentes' => $request->input('asistentes'),
            'id_tipo_acto' =>  $request->input('tipoActo'), 
        ];

        $actoModel = new Acto();
        $actoModel->updateActo($actoData);

        return redirect()->route('panel-administracion')->with('success', 'Acto modificado');  
    }

    public function listadoActosHTMLController() {
        $id_persona = optional(session('userInfo'))->id_persona ?? null;
        $actos = $this->getActos();
        $getAllInscritos = (new InscritoController())->getAllInscritos();
        $getPonenciaPersonal = (new PonenteController())->getPonenciaPersonalController($id_persona);
        $getAsistenciaPersonal = (new InscritoController())->getAsistenciaPersonalController($id_persona);
        $inscritosPorActo = [];
        $ponentesPorActo = [];
        $listadoActosHTML = '';
        $certificado = csrf_field();
        function obtenerEstadoActo($id_acto, $inscritosPorActo, $ponentesPorActo) {
            if (isset($inscritosPorActo[$id_acto])) {
                return 'inscrito';
            } elseif (isset($ponentesPorActo[$id_acto])) {
                return 'ponente';
            } else {
                return 'noinscrito';
            }
        }
        foreach ($getAsistenciaPersonal as $inscripcion) {$inscritosPorActo[$inscripcion->id_acto] = 'inscrito';}
        foreach ($getPonenciaPersonal as $ponencia) {$ponentesPorActo[$ponencia->id_acto] = 'ponente';}
        foreach ($actos as $acto) {
            $estado = obtenerEstadoActo($acto->id_acto, $inscritosPorActo, $ponentesPorActo);
            $totalInscritos = array_filter($getAllInscritos, function ($inscrito) use ($acto) {
                return $inscrito->id_acto === $acto->id_acto;
            });
            $listadoActosHTML .= '<div class="acto '.$estado.'"><div class="acto-summary"><div class="acto-date"><p><b>Fecha:</b> '.$acto->fecha.'</p><p><b>Hora:</b> '.$acto->hora.'</p></div><div class="acto-title"><p>'.$acto->titulo.'</p></div><div class="acto-details"><p class="grid-item"><b>Tipo de acto:</b> '.$acto->descripcion.'</p><p class="grid-item"><b>Asistencia:</b> '.count($totalInscritos).'/'.$acto->num_asistentes.'</p></div></div>';
            $listadoActosHTML .= '<div class="acto-description"><p>'.$acto->descripcion_corta.'</p></div>'.($estado === 'ponente' ? '<div class="acto-status--ponente"><p class="grid-item">Ponente</p></div>' : ($estado === 'inscrito' ? '<div class="acto-status--inscrito"><p class="grid-item">Inscrito</p></div>' : '<div class="acto-status--noInscrito"><p class="grid-item">No inscrito</p></div>'));
            $listadoActosHTML .= $estado === 'ponente' ? '<form class="file_upload" method="post" action="' . route("addFile.post") . '" enctype="multipart/form-data"><div class="content_form">'.$certificado.'<label for="archivo">Subir archivo:</label><input type="file" name="archivo"><input type="hidden" name="id_acto" value="'.$acto->id_acto.'"><input type="hidden" name="id_persona" value="'.$id_persona.'"></div><input class="submit" type="submit" value="Subir archivo"></form>' : '';
            if($estado === 'ponente'){
                $archivos = (new DocumentacionController())->getFilesPersona($id_persona, $acto->id_acto);
                $listadoActosHTML .= '<details><summary>Archivos disponibles:</summary><ul>';
                foreach($archivos as $archivo){
                    $listadoActosHTML .= '<li><strong>'.$archivo->titulo_documento.'</strong></li>';
                }
                $listadoActosHTML .= '</ul></details>';
            }
            $listadoActosHTML .= '</div>';
        }
        return $listadoActosHTML;
    }

    public function getActosJSON() {
        try {
            $actos = $this->getActos();
            foreach ($actos as $acto) {
                $acto->url = env('APP_URL') . 'get-acto/' . strval($acto->id_acto);
                $acto->created_at = strval($acto->created_at);
                $acto->updated_at = strval($acto->updated_at);
                $acto->id_tipo_acto = strval($acto->id_tipo_acto);
                $acto->id_acto = strval($acto->id_acto);
                $acto->num_asistentes = strval($acto->num_asistentes);
            }
            $response = response()->json(['actos' => $actos], 200);
            $response->setEncodingOptions($response->getEncodingOptions() | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            return $response;
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 500);
        }
    }

    public function getActoDetails($id) {
        $actoModel = new Acto();
        $actoData = $actoModel->getActoByIDModel($id);


        $actoData->ponentes = $actoData->ponentes ? explode(',', $actoData->ponentes) : [];
        $ponenteModel = new Ponente();
        $ponentesData = [];
        foreach($actoData->ponentes as $ponenteId) {
            $ponentesData[] = $ponenteModel->getPonenteById($ponenteId);
        }
        $actoData->ponentes = $ponentesData;

        $actoData->inscritos = $actoData->inscritos ? explode(',', $actoData->inscritos) : [];
        $inscritoModel = new Inscrito();
        $inscritoData = [];
        foreach($actoData->inscritos as $inscritoId) {
            $inscritoData[] = $inscritoModel->getInscritoById($inscritoId);
        }
        $actoData->inscritos = $inscritoData;

        $actoData->documentacion = $actoData->documentacion ? explode(',', $actoData->documentacion) : [];
        $documentacionModel = new Documentacion();
        $documentosData = [];
        foreach($actoData->documentacion as $documentoId) {
            $documentosData[] = $documentacionModel->getFileDataById($documentoId);
        }
        $actoData->documentacion = $documentosData;

        return $actoData;
    }

    public function getActoDetailsJSON($id) {
            $actoData = $this->getActoDetails($id);     
            
            return response()->json(['actoData' => $actoData], 200);
    }
}