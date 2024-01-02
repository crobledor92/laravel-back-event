<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Inscrito extends Model {

    public function getInscritos() {
        return DB::table('inscritos')->get();
    }

    public function getInscritoById($idInscrito) {
        $inscrito = DB::table('inscritos')
            ->where('id_inscripcion', $idInscrito)
            ->join('personas', 'inscritos.id_persona', '=', 'personas.id_persona')
            ->select('inscritos.*', 'personas.nombre', 'personas.apellido1', 'personas.apellido2')
            ->first();
        return $inscrito;
    }



    public function getInscritosActo($idActo) {
        return DB::table('inscritos')
            ->join('personas', 'inscritos.id_persona', '=', 'personas.id_persona')
            ->select('personas.*', 'inscritos.*')
            ->where('id_acto', $idActo)
            ->get();
    }

    public function addInscrito($data) {
        DB::table('inscritos')->insert(['id_persona' => $data['id_persona'],'id_acto' => $data['id_acto'],'fecha_inscripcion' => $data['fecha_inscripcion'],'created_at' => now(),'updated_at' => now(),]);
    }

    public function deleteInscrito($id_inscripcion, $id_persona) {
        DB::table('inscritos')->where('id_inscripcion', $id_inscripcion)->where('id_persona', $id_persona)->delete();
    }

    public function deleteActoInscrito($id_inscripcion) {
        DB::table('inscritos')->where('id_inscripcion', $id_inscripcion)->delete();
    }

    public function getAsistenciaPersonalModel($id_persona) {
        return DB::table('inscritos')->where('id_persona', $id_persona)->get();
    }

    public function HandleGoAssistanceModel($data) {
        $exist = DB::table('inscritos')->where('id_persona', $data['id_persona'])->where('id_acto', $data['id_acto'])->get();
        if ($exist->count() > 0) {
            DB::table('inscritos')->where('id_persona', $data['id_persona'])->where('id_acto', $data['id_acto'])->delete();
            return 'Inscripcion eliminada con éxito.';
        } else {
            DB::table('inscritos')->insert(['id_persona' => $data['id_persona'], 'id_acto' => $data['id_acto'],'fecha_inscripcion' => now(),'created_at' => now(),'updated_at' => now(),]);
            return 'Inscripcion creada con éxito.';
        }
        return false;
    }
}