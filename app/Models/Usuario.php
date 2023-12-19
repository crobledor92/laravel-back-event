<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Usuario extends Model
{
    protected $table = 'Usuarios'; // Specify the table name

    protected $fillable = ['mail', 'Username', 'Password', 'Id_persona', 'Id_tipo_usuario'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->connection = config('database.default'); // Use the default connection
    }

    // Automatically hash the password when setting it
    public function setPasswordAttribute($value)
    {
        $this->attributes['Password'] = bcrypt($value);
    }

    public function addUser($userData)
    {
        // Insert into Personas
        $personaId = DB::table('Personas')->insertGetId([
            'Nombre' => $userData['nombre'],
            'Apellido1' => $userData['apellido1'],
            'Apellido2' => $userData['apellido2'],
        ]);

        // Insert into Usuarios
        $userId = $this->create([
            'mail' => $userData['email'],
            'Username' => $userData['username'],
            'Password' => $userData['password'],
            'Id_persona' => $personaId,
            'Id_tipo_usuario' => $userData['tipoUser'],
        ])->id;

        return $userId > 0;
    }

    public function getUser($username)
    {
        return $this->where('Username', $username)->get();
    }

    public function userExists($username)
    {
        return $this->where('Username', $username)->exists();
    }

    public function updateUser($userData)
    {
        $updateData = [
            'mail' => $userData['email'],
            'Username' => $userData['username'],
        ];

        if ($userData['password'] !== null) {
            $updateData['Password'] = bcrypt($userData['password']);
        }

        return $this->where('Id_usuario', $userData['Id_usuario'])->update($updateData);
    }

    public function getPersonas()
    {
        return DB::table('Personas')->get();
    }
}