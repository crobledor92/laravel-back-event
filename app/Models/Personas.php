<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Personas extends Model {

    public function getPersonas() {
        $personas = DB::table('personas')
            ->select('personas.*')
            ->get();
        return $personas;
    }
}