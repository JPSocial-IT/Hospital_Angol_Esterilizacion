<?php namespace App\Models;

use CodeIgniter\Model;

class MantenedorDemoModel extends Model
{

    protected $table            = 'ZZ_mantenedor_demo';
    protected $primaryKey       = 'IdUsuario';
    protected $allowedFields    = ['Rut', 'Nombre', 'ApellidoPaterno', 'ApellidoMaterno', 'Email', 'FechaRegistro', 'Activo'];
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
        $query= $db->query('SELECT * FROM "ZZ_mantenedor_demo" ORDER BY "ApellidoPaterno", "ApellidoMaterno" ASC');
        return $query->getResultArray();
    }


    public function obtenerRegistroPorId($id) {
        return $this->where('IdUsuario', $id)->findAll();
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