<?php namespace App\Models;

use CodeIgniter\Model;

class ETperfilModel extends Model
{
    protected $table                = 'ET_perfil';
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
    
    
    public function obtenerDatosPerfil() {
        $db = \config\Database::connect();
        $query= $db->query('select * from public."ET_perfil" order by id asc');

        return $query->getResultArray();
    }

    public function obtenerDatosPerfilActivo() {
        $db = \config\Database::connect();
        $query= $db->query('select * from public."ET_perfil" where activo = true order by id asc');

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