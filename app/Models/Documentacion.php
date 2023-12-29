<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Documentacion extends Model {
    public function getFilesModel() {
        return DB::table('documentacion')->get();
    }
    public function getFilesPersonaModel($id_persona) {
        return DB::table('documentacion')->where('id_persona', $id_persona)->get();
    }
    public function getNameFilesByIDModel($id_presentacion) {
        return DB::table('documentacion')->where('id_presentacion', $id_presentacion)->value('nombre_documento');
    }        
    public function addFileModel($data) {
        return DB::table('documentacion')->insert(['id_acto' => $data['id_acto'],'nombre_documento' => $data['nombre_documento'],'id_persona' => $data['id_persona'],'titulo_documento' => $data['titulo_documento'],'created_at' => now(),'updated_at' => now(),]);
    }
    public function deleteFileModel($id_file) {
        return DB::table('documentacion')->where('id_presentacion', $id_file)->delete();
    }
}