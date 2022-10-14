<?php namespace App\Models;

use CodeIgniter\Model;

class ES_serviciosModel extends Model
{
    protected $table                = 'GRL_servicio';
    protected $primarykey           = 'id';

    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;

    protected $allowedFields        = ['descripcion', 'activo_et', 'activo_av', 'activo_es', 'cod_deis'];

    protected $useTimestamps        = true;
    protected $createdField         = 'fecha_registro';
    protected $updatedField         = '';
    protected $deletedField         = '';

    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    
    
    public function obtenerRegistros() {
        $db = \config\Database::connect();
        $query= $db->query('SELECT * FROM public."GRL_servicio" ORDER BY id ASC');
        return $query->getResultArray();
    }

    public function obtenerFuncionarios(){
        $db = \config\Database::connect();
        $query= $db->query('SELECT * FROM "ES_usuarios" WHERE activo = TRUE ORDER BY id ASC');
        return $query->getResultArray();
    }

    public function obtenerRegistroPorId($id) {
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