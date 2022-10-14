<?php namespace App\Models;

use CodeIgniter\Model;

class ETPerfilPermisoModel extends Model
{
    protected $table                = 'ET_perfil_permiso';
    protected $primarykey           = 'id';

    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;

    protected $allowedFields        = ['perfil_id', 'permiso_id'];

    protected $useTimestamps        = false;
    protected $createdField         = '';
    protected $updatedField         = '';
    protected $deletedField         = '';

    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    
    
    public function obtenerDatosPermisoPorPerfilId($perfil_id) {
        $db = \config\Database::connect();
        $query= $db->query('
        select 
            ET_permiso.id as permiso_id,
            ET_permiso.descripcion as permiso_descripcion,
            ET_perfil_permiso.id
        from public."ET_permiso"  as ET_permiso
        left join public."ET_perfil_permiso" as ET_perfil_permiso
            on  ET_permiso.id = ET_perfil_permiso.permiso_id
                and ET_perfil_permiso.perfil_id = '.$perfil_id.'
        order by ET_permiso.id asc');

        return $query->getResultArray();
    }
    
    public function insertarDatos($data) {
        if ($this->insert($data)) {
			return $this->insertID();
		} else {
			return "Error: ".$this->errors();
		}
    }
    public function eliminarDatosPorId($id) {
        return $this->delete($id);
    }
}
?>