<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Usuario extends Model{
    public function addUser($data){
        $id_persona = DB::table('personas')->insertGetId([
            'nombre' => $data['nombre'],
            'apellido1' => $data['apellido1'],
            'apellido2' => $data['apellido2'],
        ]);
        $id_user = DB::table('usuarios')->insertGetId([
            'mail' => $data['email'],
            'username' => $data['username'],
            'password' => $data['password'],
            'id_persona' => $id_persona,
            'id_tipo_usuario' => $data['user_type'],
        ]);
        return $id_user > 0;
    }
}
//     public function setPasswordAttribute($value){
//         $this->attributes['password'] = bcrypt($value);
//     }
//     public function getUser($username){
//         return $this->where('username', $username)->get();
//     }

//     public function userExists($username){
//         return $this->where('username', $username)->exists();
//     }

//     public function updateUser($data){
//         $updateData = [
//             'mail' => $data['email'],
//             'username' => $data['username'],
//         ];
//         if ($data['password'] !== null) {
//             $updateData['password'] = bcrypt($data['password']);
//         }
//         return $this->where('id_usuario', $data['id_usuario'])->update($updateData);
//     }

//     public function getPersonas(){
//         return DB::table('personas')->get();
//     }
// }