<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Usuario extends Model{
    protected $table = 'usuarios'; // Specify the table name

    protected $fillable = ['mail', 'username', 'password', 'id_persona', 'id_tipo_usuario'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->connection = config('database.default'); // Use the default connection
    }

    // Automatically hash the password when setting it
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function addUser($userData)
    {
        // Insert into Personas
        $personaId = DB::table('personas')->insertGetId([
            'nombre' => $userData['nombre'],
            'apellido1' => $userData['apellido1'],
            'apellido2' => $userData['apellido2'],
        ]);

        // Insert into Usuarios
        $userId = $this->create([
            'mail' => $userData['email'],
            'username' => $userData['username'],
            'password' => $userData['password'],
            'id_persona' => $personaId,
            'id_tipo_usuario' => $userData['tipoUser'],
        ])->id;

        return $userId > 0;
    }

    public function getUser($username)
    {
        return $this->where('username', $username)->get();
    }

    public function userExists($username)
    {
        return $this->where('username', $username)->exists();
    }

    public function updateUser($userData)
    {
        $updateData = [
            'mail' => $userData['email'],
            'username' => $userData['username'],
        ];

        if ($userData['password'] !== null) {
            $updateData['password'] = bcrypt($userData['password']);
        }

        return $this->where('id_usuario', $userData['id_usuario'])->update($updateData);
    }

    public function getPersonas()
    {
        return DB::table('personas')->get();
    }
}