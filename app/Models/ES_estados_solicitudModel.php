<?php namespace App\Models;

use CodeIgniter\Model;

class ES_estados_solicitudModel extends Model
{
    protected $table            = 'ES_estado_solicitud';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'descripcion', 'descripcion_estado', 'activo'];
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $createdField     = '';
    protected $updatedField     = '';
    protected $deletedField     = '';

    /*
    protected $useAutoIncrement     = true;
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    */

    public function obtenerRegistros(){
        $db = \config\Database::connect();
        $query= $db->query('SELECT * FROM "ES_estado_solicitud" WHERE activo = TRUE ORDER BY "id" ASC');
        return $query->getResultArray();
    }

    public function obtenerRegistroPorId($id) {
        // return $this->where('IdUsuario', $id)->findAll();
        return $this->where('id', $id)->findAll();
    }

    public function agregarRegistro($data){
        $resultado = $this->insert($data);
        return $resultado;
    }

    public function editarRegistro($id, $data){
        return $this->update($id, $data);
    }


    public function eliminarRegistro($id){
        return $this->delete($id);
    }

}
?>