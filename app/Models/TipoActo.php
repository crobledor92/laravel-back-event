<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TipoActo extends Model {

    public function getTiposActo() {
        $tiposActo = DB::table('tipo_acto')->get();
        return $tiposActo;
    }

    public function addTiposActo($descripcionTipoActo) {
        DB::table('tipo_acto')->insert([
            'descripcion' => $descripcionTipoActo,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function updateTipoActo($idTipoActo, $descripcion) {
        DB::table('tipo_acto')
            ->where('id_tipo_acto', $idTipoActo)
            ->update([
                'descripcion' => $descripcion,
                'updated_at' => now(),
        ]);
    }

    public function deleteTipoActo($idTipoActo) {
        DB::table('tipo_acto')->where('id_tipo_acto', $idTipoActo)->delete();
    }
}