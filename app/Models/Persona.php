<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Persona extends Model {

    public function getPersonas() {
        $personas = DB::table('personas')->get();
        return $personas;
    }
}