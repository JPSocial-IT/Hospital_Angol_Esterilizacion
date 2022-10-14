<?php namespace App\Models;

use CodeIgniter\Model;

class GRLDotacionModel extends Model
{
    protected $table                = 'GRL_dotacion';
    protected $primarykey           = 'id';

    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;

    protected $allowedFields        = ['rut', 'dv', 'nombres', 'apellido_uno', 'apellido_dos', 'estamento_id', 'profesion_id', 'servicio_id', 'email', 'clave', 'activo'];

    protected $useTimestamps        = true;
    protected $createdField         = 'fecha_registro';
    protected $updatedField         = '';
    protected $deletedField         = '';

    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    
    
    public function obtenerDotacion() {
        $db = \config\Database::connect();
        $query= $db->query('SELECT * FROM entrega_turno ORDER BY id ASC');
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