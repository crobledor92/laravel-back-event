<?php

namespace App\Http\Controllers;

use App\Models\Ponente;
use App\Models\Persona;
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

    public function getActoPonentes($idActo) {
        (new SessionController())->shareData();
        $ponentes = $this->getPonentes()->toArray();
        $actoPonentes = array_filter($ponentes, function ($ponente) use ($idActo) {
            return $ponente->id_acto === intval($idActo);
        });

        $actoPonentesOrdenados = collect($actoPonentes)->sortBy('orden')->values()->all();

        $personaModel = new Persona();
        $personas = $personaModel->getPersonas();

        $notPonentes = [];
        foreach($personas as $persona) {
            $isPonente = array_filter($actoPonentes, function ($actoPonente) use ($persona) {
                return $actoPonente->id_persona === $persona->id_persona;
            });
            if(count($isPonente) === 0) {
                $notPonentes[] = $persona;
            }
        }



        return view('update-acto-ponentes',['ponentes' => $actoPonentesOrdenados, 'personas' => $notPonentes, 'idActo' => $idActo]);
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

    public function updatePonentes(Request $request) {
        try {
            (new SessionController())->shareData();
            $newPonentes = $request->input('ponentesData');
            $idActo = $request->input('idActo');

            $allPonentes = $this->getPonentes()->toArray();
            $actoPonentes = array_filter($allPonentes, function ($ponente) use ($idActo) {
                return $ponente->id_acto === intval($idActo);
            });

            $ponenteModel = new Ponente();

            // Loop para eliminar ponentes
            foreach($actoPonentes as $actoPonente) {
                $deletePonente = true;

                foreach($newPonentes as $newPonente) {
                    if ($actoPonente->id_persona === intval($newPonente['id_persona'])) {
                        $deletePonente = false;
                    }
                }

                if ($deletePonente) {
                    \Log::info("se elimina ponente");
                    $ponenteModel->deletePonente($actoPonente->id_persona, $idActo);
                }
            }
            
            // Loop para crear nuevos ponentes o actualizar su orden
            foreach ($newPonentes as $ponente) {
                $ponenteExists = null;
                
                foreach($actoPonentes as $actoPonente) {
                    if ($actoPonente->id_persona === intval($ponente['id_persona'])) {
                        $ponenteExists = $actoPonente;
                        break;
                    }
                }

                if ($ponenteExists) {
                    \Log::info("se ordena ponente, ya existe");
                    $ponenteModel->updatePonenteOrden($ponenteExists->id_ponente, $ponente['orden'] + 1);
                } else {
                    \Log::info("se crea ponente");
                    $ponenteModel->addPonente($ponente['id_persona'], $idActo, $ponente['orden'] + 1);
                }
            }

            return response()->json(["success" => true,'message' => 'Ponentes actualizados correctamente.']);
    
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

            return response()->json(['success' => true, 'message' => 'Ponente eliminado con éxito']);
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['success' => false, 'message' => 'Error al eliminar ponente', 'error' => $e->getMessage()], 500);
        }
    }
}