<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ponente extends Model {

    public function getPonentes() {
        $ponentes = DB::table('lista_ponentes')
            ->join('personas', 'lista_ponentes.id_persona', '=', 'personas.id_persona')
            ->join('actos', 'lista_ponentes.id_acto', '=', 'actos.id_acto')
            ->select('lista_ponentes.*', 'personas.*', 'actos.*')
            ->get();
        return $ponentes;
    }

    public function getPonenteById($idPonente) {
        $ponentes = DB::table('lista_ponentes')
            ->where('id_ponente', $idPonente)
            ->join('personas', 'lista_ponentes.id_persona', '=', 'personas.id_persona')
            ->select('lista_ponentes.*', 'personas.nombre', 'personas.apellido1', 'personas.apellido2')
            ->first();
        return $ponentes;
    }

    public function addPonente($idPersona, $idActo, $orden = null) {
        DB::table('lista_ponentes')->insert([
            'id_persona' => $idPersona,
            'id_acto' => $idActo,
            'orden' => $orden,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function updatePonente($idPonente, $idPersona, $idActo, $orden = null) {
        DB::table('lista_ponentes')
            ->where('id_ponente', $idPonente)
            ->update([
                'id_persona' => $idPersona,
                'id_acto' => $idActo,
                'orden' => $orden,
                'updated_at' => now(),
        ]);
    }

    public function updatePonenteOrden($idPonente, $orden) {
        
        DB::table('lista_ponentes')
            ->where('id_ponente', $idPonente)
            ->update([
                'orden' => $orden,
                'updated_at' => now(),
        ]);
    }



    public function deletePonente($idPersona, $idActo) {
        DB::table('lista_ponentes')
            ->where('id_persona', $idPersona)
            ->where('id_acto', $idActo)
            ->delete();
    }
    public function getPonenciaPersonalModel($id_persona) {
        return DB::table('lista_ponentes')->where('id_persona', $id_persona)->get();
    }
}