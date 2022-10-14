<?php namespace App\Models;

use CodeIgniter\Model;

class GRLServicioModel extends Model
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

    /* protected $table                = 'GRL_servicio';
    protected $primarykey           = 'id';
    protected $allowedFields        = ['descripcion', 'activo_es', 'cod_deis'];
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $useTimestamps        = true;
    protected $createdField         = 'fecha_registro';
    protected $updatedField         = '';
    protected $deletedField         = '';
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;     */
    
    public function obtenerDatosServicio() {
        $db = \config\Database::connect();
        $query= $db->query('SELECT * FROM public."GRL_servicio" ORDER BY id ASC');
        return $query->getResultArray();
    }

    public function obtenerDotacionPorRut($rut) {
        return $this->where("rut", $rut)->findAll();
    }

    public function obtenerDotacionPorId($id) {
        return $this->where("id", $id)->findAll();
    }
    
    public function insertarDatos($data) {
        /*$response = "";
        try{
			$this->insert($data);
            $response = "success";
		}catch(Exception $ex){
			$response = $ex->getMessage();
            
		}

        return $response;*/
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