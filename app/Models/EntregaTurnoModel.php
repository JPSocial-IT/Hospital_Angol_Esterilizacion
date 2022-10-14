<?php namespace App\Models;

use CodeIgniter\Model;

class EntregaTurnoModel extends Model
{
    protected $table                = 'entrega_turno';
    protected $primarykey           = 'id';

    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;

    protected $allowedFields        = ['comentario'];

    protected $useTimestamps        = true;
    protected $createdField         = 'fecha_registro';
    protected $updatedField         = '';
    protected $deletedField         = '';

    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    
    
    public function obtenerDatos() {
        $db = \config\Database::connect();
        $query= $db->query('SELECT * FROM entrega_turno ORDER BY id ASC');
        return $query->getResultArray();
    }
    
    /*
    public function obtenerDatos() {
        $db = \config\Database::connect();
        $builder= $db->table('entrega_turno');
        $builder->select("id, fecha_registro, comentario");
        $builder->join('comments', 'comments.id = entrega_turno.id', 'left');
        $builder->where("entrega_turno.id=1");
        $builder->orWhereIn("entrega_turno.id=1");
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function obtenerDatos() {
        return $this->orderBy("id", "asc")->findAll();
    }
    */

    public function obtenerDatosPorId($id) {
        //return $this->find($id);
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