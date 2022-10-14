<?php namespace App\Models;

use CodeIgniter\Model;

class GRLDotacionModel extends Model
{
    protected $table                = 'GRL_dotacion';
    protected $primarykey           = 'id';

    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;

    protected $allowedFields        = ['rut', 'dv', 'nombres', 'apellido_uno', 'apellido_dos', 'cargo_id', 'servicio_id', 'dotacion_id', 'email', 'clave', 'activo'];

    protected $useTimestamps        = true;
    protected $createdField         = 'fecha_registro';
    protected $updatedField         = '';
    protected $deletedField         = '';

    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    
    
    public function obtenerDatosDotacion() {
        $db = \config\Database::connect();
        $query= $db->query('
        select 
        GRL_dotacion.id as id,
        GRL_dotacion.rut as rut,
        GRL_dotacion,dv as dv,
        GRL_dotacion,nombres as nombres,
        GRL_dotacion.apellido_uno as apellido_uno,
        GRL_dotacion.apellido_dos as apellido_dos,
        GRL_dotacion.cargo_id as cargo_id,
        GRL_dotacion.servicio_id as servicio_id,
        GRL_dotacion.email as email,
        GRL_dotacion.clave as clave,
        GRL_dotacion.activo as activo,
        GRL_cargo.descripcion as descripcion_cargo,
        GRL_servicio.descripcion as descripcion_servicio,
        ET_perfil.descripcion as descripcion_perfil,
        ET_perfil.id as perfil_id
        from public."GRL_dotacion"  as GRL_dotacion
            left join public."GRL_cargo" as GRL_cargo
                    on  GRL_dotacion.cargo_id = GRL_cargo.id
        left join public."GRL_servicio" as GRL_servicio
                 on  GRL_dotacion.servicio_id = GRL_servicio.id
        left join public."ET_perfil" as ET_perfil
                 on  ET_perfil.id = GRL_dotacion.dotacion_id     

            
        ORDER BY GRL_dotacion.id ASC');


        return $query->getResultArray();
    }

    public function obtenerDotacionPorRut($rut) {
        return $this->where("rut", $rut)->findAll();
    }

    public function obtenerDotacionPorId($id) {
        return $this->where("id", $id)->findAll();
    }
    public function insertarDatos($data) {
       if ($this->insert($data))
       {
            return $this->insertID();
       }
       else
       {
            return "Error: " .$ex->getMessage();
       }
       
    }

    public function actualizarDatosPorId($id, $data) {
        return $this->update($id, $data);
    }

    public function eliminarDatosPorId($id) {
        return $this->delete($id);
    }
   
}
?>