<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Acto extends Model
{
    private $conexion;
    private $actos;
    public function __construct() {
        $this->actos = array();
        $this->tiposActo = array();
        $this->conexion = new Conexion();
    }
    public function getActos() {
        $sql = "SELECT * FROM actos";
        $query = $this->conexion->prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        if(count($results) > 0) {
            foreach($results as $result) {
                $this->actos[] = $result;
            }
        }
        return $this->actos;
    }
    #Se usa para añadirse a la tabla de inscripciones como asistente al acto o evento.
    public function asitenciaActo($data) {
        $sql = "INSERT INTO inscritos (id_persona, id_acto, fecha_inscripcion) VALUES (:id_persona, :id_acto, :fecha_inscripcion)";
        $params = [':id_persona' => $data['id_persona'],':id_acto' => $data['id_acto'],':fecha_inscripcion' => $data['fecha_inscripcion'],];
        try {
            $query = $this->conexion->prepare($sql);
            $query->execute($params);
            return true;
        } catch (PDOException $e) {
            echo 'Error en la inserción: ' . $e->getMessage();
            return false;
        }
    }
    #Se usa para eliminarse de la tabla de inscripciones como asistente al acto o evento.
    public function eliminarAsistenciaActo($data) {
        $sql = "DELETE FROM inscritos WHERE id_persona = :id_persona AND id_acto = :id_acto";
        $params = [':id_persona' => $data['id_persona'], ':id_acto' => $data['id_acto']];
        try {
            $query = $this->conexion->prepare($sql);
            $query->execute($params);
            return true;
        } catch (PDOException $e) {
            echo 'Error en la inserción: ' . $e->getMessage();
            return false;
        }
    }
    #Devuelve las inscripciones de los actos.
    public function obtenerAsistenciaActo() {
        $sql = "SELECT * FROM inscritos";
        try {
            $query = $this->conexion->prepare($sql);
            $query->execute();
            $registros = $query->fetchAll(PDO::FETCH_OBJ);
            return $registros;
        } catch (PDOException $e) {
            echo 'Error al obtener registros: ' . $e->getMessage();
            return false;
        }
    }
    #Devuelve los tipos de actos disponibles.
    public function getTipoActo() {
        $sql = "SELECT * FROM tipo_acto";
        $query = $this->conexion->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }
    #Añadimos un nuevo tipo de acto.
    public function addTipoActo($data) {
        $sql = "INSERT  INTO tipo_acto (descripcion) VALUES (:descripcion)";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':descripcion',$data['descripcion'],PDO::PARAM_STR, 100);
        $query->execute();
        $userId = $query->rowCount();
        if ($userId>0) {
            return true;
        } else {
            return false;
        }
    }
    #Actualizamos la descripcion del tipo de acto.
    public function updateTipoActo($updateData) {
        $sql = "UPDATE Tipo_acto SET Descripcion = :descripcion WHERE Id_tipo_acto = :id";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':descripcion',$updateData['Descripcion'],PDO::PARAM_STR, 100);
        $query->bindParam(':id',$updateData['Id_tipo_acto'],PDO::PARAM_STR, 100);
        $query->execute();
        $userId = $query->rowCount();
        if ($userId>0) {
            return true;
        } else {
            return false;
        }
    }
    #Eliminamos el tipo de acto si es posible.
    public function deleteTipoActo($deleteData) {
        try{
            $sql = "DELETE FROM Tipo_acto WHERE Id_tipo_acto = :id";      
            $query = $this->conexion->prepare($sql); 
            $query->bindParam(':id', $deleteData['Id_tipo_acto'], PDO::PARAM_STR, 100);
            $query->execute();
            $rowCount = $query->rowCount();
        } catch (Exception $e){
            throw $e;
        }
    }
    public function addActo($actoData) {
        $sql = "INSERT into Actos(Fecha, Hora, Titulo, Descripcion_corta, Descripcion_larga, Num_asistentes, Id_tipo_acto)
        values(:Fecha, :Hora, :Titulo, :Descripcion_corta, :Descripcion_larga, :Num_asistentes, :Id_tipo_acto)";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':Fecha',$actoData['fecha'],PDO::PARAM_STR, 100);
        $query->bindParam(':Hora',$actoData['hora'],PDO::PARAM_STR, 100);
        $query->bindParam(':Titulo',$actoData['titulo'],PDO::PARAM_STR, 100);
        $query->bindParam(':Descripcion_corta',$actoData['resumen'],PDO::PARAM_STR, 100);
        $query->bindParam(':Descripcion_larga',$actoData['descripcion'],PDO::PARAM_STR, 100);
        $query->bindParam(':Num_asistentes',$actoData['asistentes'],PDO::PARAM_STR, 100);
        $query->bindParam(':Id_tipo_acto',$actoData['idTipoActo'],PDO::PARAM_STR, 100);
        $query->execute();
        $actoId = $this->conexion->lastInsertId();
        return $actoId;
    }
    public function updateActo($actoData) {
        $sql = "UPDATE Actos SET Fecha = :Fecha, Hora = :Hora, Titulo = :Titulo, Descripcion_corta = :Descripcion_corta, Descripcion_larga = :Descripcion_larga, Num_asistentes = :Num_asistentes, Id_tipo_acto = :Id_tipo_acto";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':Fecha',$actoData['fecha'],PDO::PARAM_STR, 100);
        $query->bindParam(':Hora',$actoData['hora'],PDO::PARAM_STR, 100);
        $query->bindParam(':Titulo',$actoData['titulo'],PDO::PARAM_STR, 100);
        $query->bindParam(':Descripcion_corta',$actoData['resumen'],PDO::PARAM_STR, 100);
        $query->bindParam(':Descripcion_larga',$actoData['descripcion'],PDO::PARAM_STR, 100);
        $query->bindParam(':Num_asistentes',$actoData['asistentes'],PDO::PARAM_STR, 100);
        $query->bindParam(':Id_tipo_acto',$actoData['idTipoActo'],PDO::PARAM_STR, 100);
        $query->execute();
        $userId = $query->rowCount();
        if ($userId>0) {
            return true;
        } else {
            return false;
        }
    }
}