<?php namespace App\Models;

use CodeIgniter\Model;

class GRLCargoModel extends Model
{
    protected $table                = 'GRL_cargo';
    protected $primarykey           = 'id';

    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;

    protected $allowedFields        = ['descripcion', 'activo'];

    protected $useTimestamps        = true;
    protected $createdField         = 'fecha_registro';
    protected $updatedField         = '';
    protected $deletedField         = '';

    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    
    
    public function obtenerCargoPorId($id) 
    {
        return $this->where("id", $id)->findAll();
    }
    
    public function obtenerDatosCargos() {
        $db = \config\Database::connect();
        $query= $db->query('SELECT * FROM public."GRL_cargo" ORDER BY id ASC');
        return $query->getResultArray();
    }

    public function insertarDatos($data) {
        return $this->insert($data);
    }

    public function actualizarDatosPorId($id, $data) {
        return $this->update($id, $data);
    }

    public function eliminarDatosPorId($id) {
        return $this->delete($id);
    }
}
?>