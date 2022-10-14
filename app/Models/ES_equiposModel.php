<?php namespace App\Models;

use CodeIgniter\Model;

class ES_equiposModel extends Model
{
    protected $table            = 'ES_equipos';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'area_id', 'descripcion_area', 'centro_costo', 'valor', 'descripcion', 'descripcion_equipo', 'activo', 'tipo_id', 'tipo_descripcion'];
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
        $query= $db->query('SELECT * FROM "ES_equipos" WHERE activo = TRUE ORDER BY "id" ASC');
        return $query->getResultArray();
    }

    public function obtenerAreas(){
        $db = \config\Database::connect();
        $query= $db->query('SELECT * FROM "ES_areas_esterilizacion" WHERE activo = TRUE ORDER BY id ASC');
        return $query->getResultArray();
    }

    public function obtenerTipos(){
        $db = \config\Database::connect();
        $query= $db->query('SELECT * FROM "ES_tipo_equipos" ORDER BY id ASC');
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