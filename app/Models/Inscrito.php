<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Inscrito extends Model {

    public function getInscritos() {
        $inscritos = DB::table('inscritos')->get();
        return $inscritos;
    }

    public function addInscrito($inscritoData) {
        DB::table('inscritos')->insert([
            'id_persona' => $inscritoData['id_persona'],
            'id_acto' => $inscritoData['id_acto'],
            'fecha_inscripcion' => $inscritoData['fecha_inscripcion'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function deleteInscrito($id_inscripcion, $id_persona) {
        DB::table('inscritos')
            ->where('id_inscripcion', $id_inscripcion)
            ->where('id_persona', $id_persona)
            ->delete();
    }
}