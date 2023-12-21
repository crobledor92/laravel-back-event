<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Usuario extends Model{
    #Este metodo retorna todos los valores del registro que coindica con username.
    public function getuserInfoByUSERNAMEModel($username){
        return DB::table('usuarios')->where('username', $username)->first();
    }
    #Este metodo registra a un nuevo usuario, añadiendo primero el registro como persona.
    public function registerModel($data){
        $id_persona = DB::table('personas')->insertGetId([
            'nombre' => $data['nombre'],
            'apellido1' => $data['apellido1'],
            'apellido2' => $data['apellido2'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $id_user = DB::table('usuarios')->insertGetId([
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => $data['password'],
            'id_persona' => $id_persona,
            'id_tipo_usuario' => $data['user_type'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return $id_user > 0;
    }
    #Este metodo logea a un usuario.
    public function loginModel($data){
        $user = $this->getuserInfoByUSERNAMEModel($data['username']);
        if ($user && Hash::check($data['password'], $user->password)) {
            return $this->getuserInfoByUSERNAMEModel($data['username']);
        }
        return null;
    }
    #Este metodo actualiza dos datos de usuario.
    public function updateModel($data){
        $user = $this->getuserInfoByUSERNAMEModel($data['username']);
        if ($user && Hash::check($data['old_password'], $user->password)){
            $updateData = [
                'username' => $data['username'],
                'email' => $data['email'],
                'updated_at' => now(),
            ];
            if ($data['new_password'] !== null) {
                $updateData['password'] = Hash::make($data['new_password']);
            }
            DB::table('usuarios')->where('id_usuario', $data['id_usuario'])->update($updateData);
            return $this->getuserInfoByUSERNAMEModel($data['username']);
        }
        return null;
    }
}