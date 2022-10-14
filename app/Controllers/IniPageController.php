<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GRLDotacionModel;
use App\Models\ESDotacionPerfilModel;
use App\Models\ESMenuModel;

class IniPageController extends BaseController
{	
	protected $grl_dotacion_model;
	protected $es_dotacion_perfil_model;
	protected $es_menu_model;
    protected $session;

	public function __construct()
	{
		$this->grl_dotacion_model = new GRLDotacionModel();
		$this->es_dotacion_perfil_model = new ESDotacionPerfilModel();
		$this->es_menu_model = new ESMenuModel();
        	$this->session = \Config\Services::session();
        	$this->session->start();
	}

	public function index()
	{
		$user_id 		= $this->request->getPost('user_id');
		$user_nombres 	= $this->request->getPost('user_nombres');
		
		$data = [
			'title_meta' 	=> view('partials/title-meta', ['title' => 'Cargando modulo']),
			'page_title' 	=> view('partials/page-title', ['title_meta' => 'Cargando modulo','title' => 'Cargando modulo', 'pagetitle' => 'Cargando modulo']),
			'user_id' 		=> $user_id,
			'user_nombres' 	=> $user_nombres
		];
		return view('ini_page',$data);
	}
	
	public function ObtenerDatosUsuarioLogeado()
	{
		$txt_user_id 	= $this->request->getPost('txt_user_id');	

		$resultado = $this->grl_dotacion_model->obtenerDotacionPorId($txt_user_id);

		$estado 	= false;
		$icono 		= '';
		$validacion = '';
		$mensaje 	= '';

		if(count($resultado) == 0)
		{
			$estado		= false;
			$icono 		= 'warning';
			$validacion = 'Usuario no existe en el sistema';
			$mensaje 	= 'Preparando acceso';
		} 
		else if ($resultado[0]['activo'] == "f")
		{
			$estado		= false;
			$icono 		= 'warning';
			$validacion = 'Usuario no activo';
			$mensaje 	= 'Preparando acceso';
		} else {
			$session_data = [
                'datos_usuario_logeado' => json_encode($resultado[0])
			];

			$this->session->set($session_data);
			$estado = true;
		}

		$datos = [
			'estado' 		=> $estado,
			'icono' 		=> $icono,
			'validacion' 	=> $validacion,
			'mensaje' 		=> $mensaje
		];

		return json_encode($datos);
	}

	public function ObtenerOpcionMenu()
	{
		$txt_user_id 	= $this->request->getPost('txt_user_id');	

		$resultado_es = $this->es_dotacion_perfil_model->obtenerPerfilPorDotacionId($txt_user_id);

		$estado 	= false;
		$icono 		= '';
		$validacion = '';
		$mensaje 	= '';

		if(count($resultado_es) == 0)
		{
			$estado		= false;
			$icono 		= 'warning';
			$validacion = 'Usuario no tiene opciones del sistema';
			$mensaje 	= 'Preparando acceso';
		} else {

			$resultado_es_menu_model = $this->es_menu_model->obtenerOpcionMenuPorPerfilId($resultado_es[0]['perfil_id']);
			
			if(count($resultado_es_menu_model) == 0)
			{
				$estado		= false;
				$icono 		= 'warning';
				$validacion = 'Usuario no tiene opciones del sistema';
				$mensaje 	= 'Preparando acceso';
			} else {
	
				$session_data = [
					'perfil_usuario_logeado' 	=> json_encode($resultado_es[0]),
					'menu_usuario_logeado' 		=> json_encode($resultado_es_menu_model)
				];
	
				$this->session->set($session_data);

				$estado = true;
			}
		}

		$datos = [
			'estado' 		=> $estado,
			'icono' 		=> $icono,
			'validacion' 	=> $validacion,
			'mensaje' 		=> $mensaje
		];

		return json_encode($datos);
	}
}
