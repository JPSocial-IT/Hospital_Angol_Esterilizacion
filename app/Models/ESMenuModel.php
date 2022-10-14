<?php namespace App\Models;

use CodeIgniter\Model;

class ESMenuModel extends Model
{
    protected $table                = 'ES_menu';
    protected $primarykey           = 'id';

    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;

    protected $allowedFields        = ['nombre_opcion', 'icono', 'controlador', 'accion', 'menu_id', 'orden', 'activo'];

    protected $useTimestamps        = false;
    protected $createdField         = '';
    protected $updatedField         = '';
    protected $deletedField         = '';

    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    
    
    public function obtenerOpcionMenuPorPerfilId($perfil_id) {
        $db = \config\Database::connect();
        $query= $db->query('select ES_menu.* from public."ES_menu" as  ES_menu join public."ES_menu_perfil"  as ES_menu_perfil on ES_menu_perfil.menu_id = ES_menu.id where ES_menu_perfil.perfil_id = '.$perfil_id.' order by ES_menu.id asc, ES_menu.menu_id asc ');

        return $query->getResultArray();
    }
}
?>