<?php namespace App\Models;

use CodeIgniter\Model;

class ETDotacionPerfilModel extends Model
{
    protected $table                = 'ET_dotacion_perfil';
    protected $primarykey           = 'id';

    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;

    protected $allowedFields        = ['dotacion_id', 'perfil_id'];

    protected $useTimestamps        = false;
    protected $createdField         = '';
    protected $updatedField         = '';
    protected $deletedField         = '';

    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    

    public function obtenerPerfilPorDotacionId($dotacion_id) {
        return $this->where("dotacion_id", $dotacion_id)->findAll();
    }
   
    public function insertarDatos($data) {
        return $this->insert($data);
    }
    public function eliminarDatosPorId($id) {
        return $this->delete($id);
    }
    public function actualizarDatosPorId($id, $data) {
        return $this->update($id, $data);
    }
}
?>