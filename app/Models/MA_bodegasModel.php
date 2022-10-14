<?php namespace App\Models;

use CodeIgniter\Model;

// class MantenedorDemoModel extends Model
class MA_bodegasModel extends Model
{

    /* protected $table            = 'ZZ_mantenedor_demo';
    protected $primaryKey       = 'IdUsuario';
    protected $allowedFields    = ['Rut', 'Nombre', 'ApellidoPaterno', 'ApellidoMaterno', 'Email', 'FechaRegistro', 'Activo']; */
    protected $table            = 'ES_bodegas';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'descripcion', 'comentario' , 'encargado_id', 'encargado_nombre'];
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
        $query= $db->query('SELECT * FROM "ES_bodegas" WHERE activo = TRUE ORDER BY "id" ASC');
        return $query->getResultArray();
    }

    public function obtenerFuncionarios(){
        $db = \config\Database::connect();
        $query= $db->query('SELECT * FROM "ES_usuarios" WHERE activo = TRUE ORDER BY id ASC');
        return $query->getResultArray();
        // print_r($query->getResultArray());
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