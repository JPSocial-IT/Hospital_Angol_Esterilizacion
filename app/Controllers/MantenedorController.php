<?php namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\GRLServicioModel;
use App\Models\ETPerfilModel;
use App\Models\ETPerfilPermisoModel;
use App\Models\ETFarmacoModel;
use App\Models\GRLdotacionModel;
use App\Models\ETDotacionPerfilModel;
use App\Models\GRLCargoModel;
use App\Models\ETInsumoModel;
use App\Models\ETInstrumentalModel;
use App\Models\ETCarroParoModel;
use App\Models\ETCarroParoInsumoModel;
use App\Models\ETTipoFallaModel;
use App\Models\ETTipoRotativaModel;
use App\Models\ETFarmaciaModel;
use App\Models\ETMenuPerfilModel;
use App\Models\ETFallaRecursoFisicoEstadoModel;

class MantenedorController extends BaseController
{	
    protected $session;
	protected $grl_sercicio_model;
	protected $et_perfil_model;
	protected $et_perfil_permiso_model;
	protected $et_farmaco_model;
	protected $grl_dotacion_model;
	protected $et_dotacion_perfil_model;
	protected $grl_cargo_model;
	protected $et_insumo_model;
	protected $et_instrumental_model;
	protected $et_carro_paro_model;
	protected $et_carro_paro_insumo_model;
	protected $et_tipo_falla_model;
	protected $et_tipo_rotativa_model;
	protected $et_farmacia_model;
	protected $et_menu_perfil_model;
	protected $et_falla_recurso_fisico_estado_model;
	
	public function __construct()
	{
		$this->grl_sercicio_model 					= new GRLServicioModel();
		$this->et_perfil_model 						= new ETPerfilModel();
		$this->et_perfil_permiso_model 				= new ETPerfilPermisoModel();
		$this->et_farmaco_model 					= new ETFarmacoModel();
		
		$this->grl_dotacion_model 					= new GRLdotacionModel();
		$this->et_dotacion_perfil_model 			= new ETDotacionPerfilModel();
		$this->grl_cargo_model 						= new GRLCargoModel();
		$this->et_insumo_model 						= new ETInsumoModel();
		$this->et_instrumental_model 				= new ETInstrumentalModel();
		$this->et_carro_paro_model 					= new ETCarroParoModel();
		$this->et_carro_paro_insumo_model 			= new ETCarroParoInsumoModel();
		$this->et_tipo_falla_model 					= new ETTipoFallaModel();
		$this->et_tipo_rotativa_model 				= new ETTipoRotativaModel();
		$this->et_farmacia_model 					= new ETFarmaciaModel();
		$this->et_menu_perfil_model 				= new ETMenuPerfilModel();
		$this->et_falla_recurso_fisico_estado_model = new ETFallaRecursoFisicoEstadoModel();
        
		$this->session 					= \Config\Services::session();
        $this->session->start();
	}

	/*---------------------- SERVICIO ------------------------*/
	public function servicio()
	{
		$session_datos_usuario 	= $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado 	= $this->session->get("menu_usuario_logeado");

		$data = [
			'title_meta' 			=> view('partials/title-meta', ['title' => 'Mantenedor Servicio']),
			'page_title' 			=> view('partials/page-title', ['title_meta' => 'Mantenedor Servicio', 'title' => 'Mantenedor', 'pagetitle' => 'Servicio']),
			'session_datos_usuario'	=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'	=> json_decode($menu_usuario_logeado, false)
		];
		
		return view('Mantenedor/servicio', $data);
	}
	

	public function servicioObtenerTablaServicio()
	{
		$grl_sercicio_model = $this->grl_sercicio_model->obtenerDatosServicio();

		$data = [
			'datos' => $grl_sercicio_model
		];

		return view('Mantenedor/servicio_tabla_datos', $data);
	}
	

	public function servicioInsertarDatos()
	{
		$descripcion = $this->request->getPost('descripcion');	
		$activo 	= $this->request->getPost('activo');	

		$data = [
			'descripcion' 	=> $descripcion,
			'activo_et' 		=> $activo
		];

		$resultado = $this->grl_sercicio_model->insertarDatos($data);
		return $resultado;
	}
	

	public function servicioActualizarDatosPorId()
	{
		$id 			= $this->request->getPost('id');	
		$descripcion 	= $this->request->getPost('descripcion');	
		$activo 		= $this->request->getPost('activo');	

		$data = [
			'descripcion' 	=> $descripcion,
			'activo_et' 		=> $activo
		];

		$resultado = $this->grl_sercicio_model->actualizarDatosPorId($id, $data);
		return $resultado;
	}
	

	public function servicioEliminarDatosPorId()
	{
		$id = $this->request->getPost('id');	

		$resultado = $this->grl_sercicio_model->eliminarDatosPorId($id);
		return $resultado;
	}

	/*---------------------- ET Perfil ------------------------*/
	public function perfil()
	{
		print_r('paso por aquì');
		$session_datos_usuario 	= $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado 	= $this->session->get("menu_usuario_logeado");

		$data = [
			'title_meta' 			=> view('partials/title-meta', ['title' => 'Mantenedor Perfil']),
			'page_title' 			=> view('partials/page-title', ['title_meta' => 'Mantenedor Perfil', 'title' => 'Mantenedor', 'pagetitle' => 'Perfil']),
			'session_datos_usuario'	=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'	=> json_decode($menu_usuario_logeado, false)
		];
		
		return view('Mantenedor/perfil', $data);
	}
	public function obtenerTablaPerfil()
	{
		$et_perfil_model = $this->et_perfil_model->obtenerDatosPerfil();

		$data = [
			'datos' => $et_perfil_model
		];

		return view('Mantenedor/perfil_tabla_datos', $data);
	}
	public function perfilInsertarDatos()
	{
		$descripcion = $this->request->getPost('descripcion');	
		$activo 	= $this->request->getPost('activo');	

		$data = [
			'descripcion' 	=> $descripcion,
			'activo' 		=> $activo
		];

		$resultado = $this->et_perfil_model->insertarDatos($data);
		return $resultado;
	}
	public function perfilActualizarDatosPorId()
	{
		$id 			= $this->request->getPost('id');	
		$descripcion 	= $this->request->getPost('descripcion');	
		$activo 		= $this->request->getPost('activo');	

		$data = [
			'descripcion' 	=> $descripcion,
			'activo' 		=> $activo
		];

		$resultado = $this->et_perfil_model->actualizarDatosPorId($id, $data);
		return $resultado;
	}
	

	public function PerfilEliminarDatosPorId()
	{
		$id = $this->request->getPost('id');	

		$resultado = $this->et_perfil_model->eliminarDatosPorId($id);
		return $resultado;
	}
	/*---------------------- PERMISO ------------------------*/
	
	public function permiso()
	{
		$session_datos_usuario 	= $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado 	= $this->session->get("menu_usuario_logeado");

		$et_perfil_resultado = $this->et_perfil_model->obtenerDatosPerfilActivo();

		$data = [
			'title_meta' 			=> view('partials/title-meta', ['title' => 'Mantenedor Permiso']),
			'page_title' 			=> view('partials/page-title', ['title_meta' => 'Mantenedor Permiso', 'title' => 'Mantenedor', 'pagetitle' => 'Permiso']),
			'option_perfil' 		=> view('Mantenedor/permiso_select_perfil', ['datos' => $et_perfil_resultado]),
			'tabla_permiso_defecto'	=> view('Mantenedor/permiso_tabla_datos', ['datos' => null]),
			'session_datos_usuario'	=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'	=> json_decode($menu_usuario_logeado, false)
		];
		
		return view('Mantenedor/permiso', $data);
	}
	
	public function permisoObtenerTablaPermisoPorPerfilId()
	{
		$perfil_id = $this->request->getPost('perfil_id');	
		$et_perfil_permiso_resultado = $this->et_perfil_permiso_model->obtenerDatosPermisoPorPerfilId($perfil_id);

		$data = [
			'datos' => $et_perfil_permiso_resultado
		];

		return view('Mantenedor/permiso_tabla_datos', $data);
	}
	
	public function permisoAgregarPermisoSeleccionado()
	{
		$perfil_id 		= $this->request->getPost('perfil_id');	
		$permiso_id 	= $this->request->getPost('permiso_id');	

		$data = [
			'perfil_id' 	=> $perfil_id,
			'permiso_id' 	=> $permiso_id
		];

		$resultado = $this->et_perfil_permiso_model->insertarDatos($data);

		$datos = [
			'resultado' => $resultado
		];
		return json_encode($datos);
	}

	public function permisoEliminarPermisoSeleccionado()
	{
		$id 		= $this->request->getPost('id');	

		$resultado = $this->et_perfil_permiso_model->eliminarDatosPorId($id);
		return $resultado;
	}

	/*---------------------- FARMACO ------------------------*/
	
	public function farmaco()
	{
		$session_datos_usuario 	= $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado 	= $this->session->get("menu_usuario_logeado");

		$grl_sercicio_resultado = $this->grl_sercicio_model->obtenerDatosServicioActivo();

		$data = [
			'title_meta' 			=> view('partials/title-meta', ['title' => 'Mantenedor Fármaco']),
			'page_title' 			=> view('partials/page-title', ['title_meta' => 'Mantenedor Fármaco', 'title' => 'Mantenedor', 'pagetitle' => 'Fármaco']),
			'option_servicio' 		=> view('Mantenedor/farmaco_select_servicio', ['datos' => $grl_sercicio_resultado]),
			'tabla_permiso_defecto'	=> view('Mantenedor/farmaco_tabla_datos', ['datos' => null]),
			'session_datos_usuario'	=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'	=> json_decode($menu_usuario_logeado, false)
		];
		
		return view('Mantenedor/farmaco', $data);
	}
	
	public function farmacoObtenerTablaFarmacoPorServicioId()
	{
		$servicio_id = $this->request->getPost('servicio_id');	
		$et_farmaco_model_resultado = $this->et_farmaco_model->obtenerDatosPorServicioId($servicio_id);

		$data = [
			'datos' => $et_farmaco_model_resultado
		];

		return view('Mantenedor/farmaco_tabla_datos', $data);
	}
	
	public function farmacoAgregarNuevoFarmaco()
	{
		$servicio_id 	= $this->request->getPost('servicio_id');	
		$descripcion 	= $this->request->getPost('descripcion');	
		$activo 		= $this->request->getPost('activo');	

		$data = [
			'servicio_id' 	=> $servicio_id,
			'descripcion' 	=> $descripcion,
			'activo' 		=> $activo
		];

		print_r($data);
		$resultado = $this->et_farmaco_model->insertarDatos($data);

		$datos = [
			'resultado' => $resultado
		];
		return json_encode($datos);
	}

	public function farmacoActualizarDatosPorId()
	{
		$id 			= $this->request->getPost('id');	
		$servicio_id 	= $this->request->getPost('servicio_id');	
		$descripcion 	= $this->request->getPost('descripcion');	
		$activo 		= $this->request->getPost('activo');	

		$data = [
			'servicio_id' 	=> $servicio_id,
			'descripcion' 	=> $descripcion,
			'activo' 		=> $activo
		];

		$resultado = $this->et_farmaco_model->actualizarDatosPorId($id, $data);
		return $resultado;
	}

	public function farmacoEliminarDatosPorId()
	{
		$id = $this->request->getPost('id');	

		$resultado = $this->et_farmaco_model->eliminarDatosPorId($id);
		return $resultado;
	}
	
	/*---------------------- Dotación ------------------------*/
	public function dotacion()
	{
		
		$session_datos_usuario 	= $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado 	= $this->session->get("menu_usuario_logeado");

		$grl_cargo_resultado = $this->grl_cargo_model->obtenerDatosCargos();
		$grl_servicio_resultado = $this->grl_sercicio_model->obtenerDatosServicio();
		$grl_perfil_resultado = $this->et_perfil_model->obtenerDatosPerfil();

		$data = [
			'title_meta' 			=> view('partials/title-meta', ['title' => 'Mantenedor Dotación']),
			'page_title' 			=> view('partials/page-title', ['title_meta' => 'Mantenedor Dotación', 'title' => 'Mantenedor', 'pagetitle' => 'Dotación']),
			'option_cargo' 		    => view('Mantenedor/dotacion_cargo_select', ['datos' => $grl_cargo_resultado]),
			'option_servicio' 		=> view('Mantenedor/dotacion_servicio_select', ['datosservicios' => $grl_servicio_resultado]),
			'option_perfil' 		=> view('Mantenedor/dotacion_perfil_select', ['datos' => $grl_perfil_resultado]),
			'session_datos_usuario'	=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'	=> json_decode($menu_usuario_logeado, false)
		];
		
		return view('Mantenedor/dotacion', $data);
	}
	

	public function ObtenerTablaDotacion()
	{
		$grl_dotacion_model = $this->grl_dotacion_model->obtenerDatosDotacion();

		$data = [
			'datos' => $grl_dotacion_model
		];

		return view('Mantenedor/dotacion_tabla_datos', $data);
	}
	
	public function validasiexisterut()
	{
		
		$rut = $this->request->getPost('rut');
		$resultado_valida_Rut_Existente=$this->grl_dotacion_model->obtenerDotacionPorRut($rut);
		if (count($resultado_valida_Rut_Existente)==0)
			{
				
				return '';
			}
			else
			{
				return 'Rut Existente';
			}

	}
	public function dotacionInsertarDatos()
	{
		$rut				= $this->request->getPost('rut');	
		$dv					= $this->request->getPost('dv');
		$nombres			= $this->request->getPost('nombres');	
		$apellido_uno		= $this->request->getPost('apellido_uno');	
		$apellido_dos		= $this->request->getPost('apellido_dos');
		$cargo_id			= $this->request->getPost('cargo_id');	
		$servicio_id		= $this->request->getPost('servicio_id');
		$dotacion_id		= $this->request->getPost('dotacion_id');
		$email				= $this->request->getPost('email');	
		$activo				= $this->request->getPost('activo');	
		$clave				= $this->encriptarPass($rut);
		
		$data = [
			'rut'				=> $rut,
			'dv'				=> $dv,
			'nombres'			=> $nombres,
			'apellido_uno'		=> $apellido_uno,
			'apellido_dos' 		=> $apellido_dos,
			'cargo_id'			=> $cargo_id,
			'servicio_id'		=> $servicio_id,
			'dotacion_id'		=> $dotacion_id,
			'email'				=> $email,
			'activo' 			=> $activo,
			'clave'				=> $clave
			
		];
			$resultado_valida_Rut_Existente=$this->grl_dotacion_model->obtenerDotacionPorRut($rut);
			if (count($resultado_valida_Rut_Existente)==0)
			{
				$resultado = $this->grl_dotacion_model->insertarDatos($data);
				$datos = [
					'resultado' => $resultado	
				];
				$resultadoenviomail=$this->enviarAvisoPorEmail($rut);
				return json_encode($datos);
			}
			else
			{
				$datos = [
					'resultado' => 'Error:Rut Existente'	
				];
				return json_encode($datos);
			}
		
	}
	

	public function dotacionActualizarDatosPorId()
	{
		$id 				= $this->request->getPost('id');	
		$rut				= $this->request->getPost('rut');	
		$dv					= $this->request->getPost('dv');
		$nombres			= $this->request->getPost('nombres');	
		$apellido_uno		= $this->request->getPost('apellido_uno');	
		$apellido_dos		= $this->request->getPost('apellido_dos');
		$cargo_id			= $this->request->getPost('cargo_id');	
		$servicio_id		= $this->request->getPost('servicio_id');
		$dotacion_id		= $this->request->getPost('dotacion_id');
		$email				= $this->request->getPost('email');		
	    $activo				= $this->request->getPost('activo');		

		$data = [
			'rut'			=> $rut,
			'dv'			=> $dv,
			'nombres'		=> $nombres,
			'apellido_uno'	=> $apellido_uno,
			'apellido_dos' 	=> $apellido_dos,
			'cargo_id'		=> $cargo_id,
			'servicio_id'	=> $servicio_id,
			'dotacion_id'	=> $dotacion_id,
			'email'			=> $email,
			'activo' 		=> $activo
		];

		$resultado = $this->grl_dotacion_model->actualizarDatosPorId($id, $data);
		return $resultado;
	}
	

	public function dotacionEliminarDatosPorId()
	{
		$id = $this->request->getPost('id');	

		$resultado = $this->grl_dotacion_model->eliminarDatosPorId($id);
		return $resultado;
	}
	/*---------------------- CARGOS ------------------------*/
	
	public function cargo()
	{
		$session_datos_usuario 	= $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado 	= $this->session->get("menu_usuario_logeado");
	
		
		$data = [
			'title_meta' 			=> view('partials/title-meta', ['title' => 'Mantenedor Cargos']),
			'page_title' 			=> view('partials/page-title', ['title_meta' => 'Mantenedor Cargos', 'title' => 'Mantenedor', 'pagetitle' => 'Cargos']),
			'session_datos_usuario'	=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'	=> json_decode($menu_usuario_logeado, false)
		];
		
		return view('Mantenedor/cargo', $data);
	}
	public function obtenerTablaCargo()
	{
		$grl_cargo_model = $this->grl_cargo_model->obtenerDatosCargos();

		$data = [
			'datos' => $grl_cargo_model
		];

		return view('Mantenedor/cargo_tabla_datos', $data);
	}
	public function cargoInsertarDatos()
	{
		$descripcion = $this->request->getPost('descripcion');	
		$activo 	= $this->request->getPost('activo');	

		$data = [
			'descripcion' 	=> $descripcion,
			'activo' 		=> $activo
		];

		$resultado = $this->grl_cargo_model->insertarDatos($data);
		return $resultado;
	}
	public function cargoActualizarDatosPorId()
	{
		$id 			= $this->request->getPost('id');	
		$descripcion 	= $this->request->getPost('descripcion');	
		$activo 		= $this->request->getPost('activo');	

		$data = [
			'descripcion' 	=> $descripcion,
			'activo' 		=> $activo
		];

		$resultado = $this->grl_cargo_model->actualizarDatosPorId($id, $data);
		return $resultado;
	}
	

	public function cargoEliminarDatosPorId()
	{
		$id = $this->request->getPost('id');	

		$resultado = $this->grl_cargo_model->eliminarDatosPorId($id);
		return $resultado;
	}
	
	/*---------------------- INSUMOS ------------------------*/
	
	public function insumo()
	{
		$session_datos_usuario 	= $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado 	= $this->session->get("menu_usuario_logeado");

		$grl_servicio_resultado = $this->grl_sercicio_model->obtenerDatosServicio();

		
		$data = [
			'title_meta' 			=> view('partials/title-meta', ['title' => 'Mantenedor Insumos']),
			'page_title' 			=> view('partials/page-title', ['title_meta' => 'Mantenedor Insumos', 'title' => 'Mantenedor', 'pagetitle' => 'Insumos']),
			'option_servicio' 		=> view('Mantenedor/insumo_servicio_select', ['datosinsumos' => $grl_servicio_resultado]),
			'tabla_insumo_defecto'	=> view('Mantenedor/insumo_tabla_datos', ['datos' => null]),
			'session_datos_usuario'	=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'	=> json_decode($menu_usuario_logeado, false)
		];
		
		return view('Mantenedor/insumo', $data);
	}
	public function obtenerTablainsumoPorServicioSeleccionado()
	{
		$servicio_id = $this->request->getPost('servicio_id');	
		$et_insumo_resultado = $this->et_insumo_model->obtenerDatosinsumoPorServicioSeleccionado($servicio_id);

		$data = [
			'datos' => $et_insumo_resultado
		];

		return view('Mantenedor/insumo_tabla_datos', $data);
	}
	public function obtenerTablaInsumo()
	{
		$et_insumo_model = $this->et_insumo_model->obtenerDatosInsumos();

		$data = [
			'datos' => $et_insumo_model
		];

		return view('Mantenedor/insumo_tabla_datos', $data);
	}
	public function insumoInsertarDatos()
	{
		
		$servicio_id = $this->request->getPost('servicio_id');	
		
		$descripcion = $this->request->getPost('descripcion');	
		$activo 	= $this->request->getPost('activo');	

		$data = [
			'servicio_id' 	=> $servicio_id,
			'descripcion' 	=> $descripcion,
			'activo' 		=> $activo
		];

		$resultado = $this->et_insumo_model->insertarDatos($data);
		return $resultado;
	}
	public function insumoActualizarDatosPorId()
	{
		$id 			= $this->request->getPost('id');	
		$servicio_id    = $this->request->getPost('servicio_id');	
		$descripcion 	= $this->request->getPost('descripcion');	
		$activo 		= $this->request->getPost('activo');	

		$data = [
			'servicio_id' 	=> $servicio_id,
			'descripcion' 	=> $descripcion,
			'activo' 		=> $activo
		];

		$resultado = $this->et_insumo_model->actualizarDatosPorId($id, $data);
		return $resultado;
	}
	

	public function insumoEliminarDatosPorId()
	{
		$id = $this->request->getPost('id');	

		$resultado = $this->et_insumo_model->eliminarDatosPorId($id);
		return $resultado;
	}
	/*---------------------- INSTRUMENTAL ------------------------*/
	
	public function instrumental()
	{
		$session_datos_usuario 	= $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado 	= $this->session->get("menu_usuario_logeado");

		$grl_servicio_resultado = $this->grl_sercicio_model->obtenerDatosServicio();

		
		$data = [
			'title_meta' 			=> view('partials/title-meta', ['title' => 'Mantenedor Insumos']),
			'page_title' 			=> view('partials/page-title', ['title_meta' => 'Mantenedor instrumental', 'title' => 'Mantenedor', 'pagetitle' => 'instrumental']),
			'option_servicio' 		=> view('Mantenedor/instrumental_servicio_select', ['datosinstrumental' => $grl_servicio_resultado]),
			'tabla_instrumental_defecto'	=> view('Mantenedor/instrumental_tabla_datos', ['datos' => null]),
			'session_datos_usuario'	=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'	=> json_decode($menu_usuario_logeado, false)
		];
		
		return view('Mantenedor/instrumental', $data);
	}
	public function obtenerTablainstrumentalPorServicioSeleccionado()
	{
		$servicio_id = $this->request->getPost('servicio_id');	
		$et_instrumental_resultado = $this->et_instrumental_model->obtenerDatosinstrumentalPorServicioSeleccionado($servicio_id);

		$data = [
			'datos' => $et_instrumental_resultado
		];

		return view('Mantenedor/instrumental_tabla_datos', $data);
	}


	public function obtenerTablaInstrumental()
	{
		$et_instrumental_model = $this->et_instrumental_model->obtenerDatosInstrumental();

		$data = [
			'datos' => $et_instrumental_model
		];

		return view('Mantenedor/instrumental_tabla_datos', $data);
	}
	public function instrumentalInsertarDatos()
	{
		
		$servicio_id = $this->request->getPost('servicio_id');	
		
		$descripcion = $this->request->getPost('descripcion');	
		$activo 	= $this->request->getPost('activo');	

		$data = [
			'servicio_id' 	=> $servicio_id,
			'descripcion' 	=> $descripcion,
			'activo' 		=> $activo
		];

		$resultado = $this->et_instrumental_model->insertarDatos($data);
		return $resultado;
	}
	public function instrumentalActualizarDatosPorId()
	{
		$id 			= $this->request->getPost('id');	
		$servicio_id    = $this->request->getPost('servicio_id');	
		$descripcion 	= $this->request->getPost('descripcion');	
		$activo 		= $this->request->getPost('activo');	

		$data = [
			'servicio_id' 	=> $servicio_id,
			'descripcion' 	=> $descripcion,
			'activo' 		=> $activo
		];

		$resultado = $this->et_instrumental_model->actualizarDatosPorId($id, $data);
		return $resultado;
	}
	

	public function instrumentalEliminarDatosPorId()
	{
		$id = $this->request->getPost('id');	

		$resultado = $this->et_instrumental_model->eliminarDatosPorId($id);
		return $resultado;
	}
	/*---------------------- CARRO PARO ------------------------*/
	
	public function carroparo()
	{
		$session_datos_usuario 	= $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado 	= $this->session->get("menu_usuario_logeado");

		$grl_servicio_resultado = $this->grl_sercicio_model->obtenerDatosServicio();

		
		$data = [
			'title_meta' 					=> view('partials/title-meta', ['title' => 'Mantenedor Carro Paro']),
			'page_title' 					=> view('partials/page-title', ['title_meta' => 'Mantenedor Carro Paro', 'title' => 'Mantenedor', 'pagetitle' => 'Carro Paro']),
			'option_servicio' 				=> view('Mantenedor/carro_paro_servicio_select', ['datos' => $grl_servicio_resultado]),
			'tabla_carro_paro_defecto'		=> view('Mantenedor/carro_paro_tabla_datos', ['datos' => null]),
			'session_datos_usuario'			=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'			=> json_decode($menu_usuario_logeado, false)
		];
		
		return view('Mantenedor/carro_paro', $data);
	}
	public function obtenerTablaCarroParoPorServicioSeleccionado()
	{
		$servicio_id = $this->request->getPost('servicio_id');	
		$et_carro_paro_resultado = $this->et_carro_paro_model->obtenerDatosCarroParoPorServicioSeleccionado($servicio_id);

		$data = [
			'datos' => $et_carro_paro_resultado
		];

		return view('Mantenedor/carro_paro_tabla_datos', $data);
	}

	public function obtenerDatosCarroParo()
	{
		$et_carro_paro_model = $this->et_carro_paro_model->obtenerDatosCarroParo();

		$data = [
			'datos' => $et_carro_paro_model
		];

		return view('Mantenedor/carro_paro_tabla_datos', $data);
	}
	public function carro_paroInsertarDatos()
	{
		
		$servicio_id 	= $this->request->getPost('servicio_id');	
		$numero 		= $this->request->getPost('numero');	
		$modelo 		= $this->request->getPost('modelo');	
		$observacion = $this->request->getPost('observacion');	
		$activo 		= $this->request->getPost('activo');	

		$data = [
			'servicio_id' 	=> $servicio_id,
			'numero' 		=> $numero,
			'modelo' 		=> $modelo,
			'observacion' 	=> $observacion,
			'activo' 		=> $activo
		];

		$resultado = $this->et_carro_paro_model->insertarDatos($data);
		return $resultado;
	}
	public function carro_paroActualizarDatosPorId()
	{
		$id 			= $this->request->getPost('id');	
		$servicio_id 	= $this->request->getPost('servicio_id');	
		$numero 		= $this->request->getPost('numero');	
		$modelo 		= $this->request->getPost('modelo');	
		$observacion = $this->request->getPost('observacion');	
		$activo 		= $this->request->getPost('activo');	

		$data = [
			'servicio_id' 	=> $servicio_id,
			'numero' 		=> $numero,
			'modelo' 		=> $modelo,
			'observacion' 	=> $observacion,
			'activo' 		=> $activo
		];

		$resultado = $this->et_carro_paro_model->actualizarDatosPorId($id, $data);
		return $resultado;
	}
	

	public function carro_paroEliminarDatosPorId()
	{
		$id = $this->request->getPost('id');	

		$resultado = $this->et_carro_paro_model->eliminarDatosPorId($id);
		return $resultado;
	}
	/*---------------------- CARRO PARO INSUMO------------------------*/
	
	public function carroparoinsumo()
	{
		$session_datos_usuario 	= $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado 	= $this->session->get("menu_usuario_logeado");

		$et_insumo_resultado = $this->et_insumo_model->obtenerDatosInsumos();
		$et_carro_paro_resultado = $this->et_carro_paro_model->obtenerDatosCarroParo();

		
		$data = [
			'title_meta' 			=> view('partials/title-meta', ['title' => 'Mantenedor Carro Paro']),
			'page_title' 			=> view('partials/page-title', ['title_meta' => 'Mantenedor Carro Paro', 'title' => 'Mantenedor', 'pagetitle' => 'Carro Paro']),
			'option_carro_paro' 	=> view('Mantenedor/carro_paro_select', ['datoscarroparo' => $et_carro_paro_resultado]),
			'option_insumo' 		=> view('Mantenedor/carro_paro_insumo_select', ['datosinsumos' => $et_insumo_resultado]),
			'session_datos_usuario'	=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'	=> json_decode($menu_usuario_logeado, false)
		];
		
		return view('Mantenedor/carro_paro_insumo', $data);
	}
	public function obtenerDatosCarroParoInsumo()
	{
		$et_carro_paro_insumo_model = $this->et_carro_paro_insumo_model->obtenerDatosCarroParoInsumo();
		
		$data = [
			'datos' => $et_carro_paro_insumo_model
		];

		return view('Mantenedor/carro_paro_insumo_tabla_datos', $data);
	}
	public function carro_paro_insumoInsertarDatos()
	{
		
		$carro_paro_id 		= $this->request->getPost('carro_paro_id');	
		$insumo_id 			= $this->request->getPost('insumo_id');	
		$cantidad_inicio 	= $this->request->getPost('cantidad_inicio');	
		$cantidad_fin		= $this->request->getPost('cantidad_fin');	
		$nota 				= $this->request->getPost('nota');	

		$data = [
			'carro_paro_id' 	=> $carro_paro_id,
			'insumo_id' 		=> $insumo_id,
			'cantidad_inicio' 	=> $cantidad_inicio,
			'cantidad_fin' 		=> $cantidad_fin,
			'nota' 				=> $nota
		];

		$resultado = $this->et_carro_paro_insumo_model->insertarDatos($data);
		return $resultado;
	}
	public function carro_paro_insumoActualizarDatosPorId()
	{
		$id 				= $this->request->getPost('id');	
		$carro_paro_id 		= $this->request->getPost('carro_paro_id');	
		$insumo_id 			= $this->request->getPost('insumo_id');	
		$cantidad_inicio	= $this->request->getPost('cantidad_inicio');	
		$cantidad_fin		= $this->request->getPost('cantidad_fin');	
		$nota 				= $this->request->getPost('nota');		

		$data = [
			
			'carro_paro_id' 	=> $carro_paro_id,
			'insumo_id' 		=> $insumo_id,
			'cantidad_inicio' 	=> $cantidad_inicio,
			'cantidad_fin' 		=> $cantidad_fin,
			'nota' 				=> $nota
		];

		$resultado = $this->et_carro_paro_insumo_model->actualizarDatosPorId($id, $data);
		return $resultado;
	}
	

	public function carro_paro_insumoEliminarDatosPorId()
	{
		$id = $this->request->getPost('id');	

		$resultado = $this->et_carro_paro_insumo_model->eliminarDatosPorId($id);
		return $resultado;
	}
	/*---------------------- TIPO FALLA ------------------------*/
	
	public function tipo_falla()
	{
		$session_datos_usuario 	= $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado 	= $this->session->get("menu_usuario_logeado");
	
		
		$data = [
			'title_meta' 			=> view('partials/title-meta', ['title' => 'Mantenedor Tipos de Falla']),
			'page_title' 			=> view('partials/page-title', ['title_meta' => 'Mantenedor Tipos de Falla', 'title' => 'Mantenedor', 'pagetitle' => 'Tipos de Falla']),
			'session_datos_usuario'	=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'	=> json_decode($menu_usuario_logeado, false)
		];
		
		return view('Mantenedor/tipo_falla', $data);
	}
	public function obtenerDatosTipoFalla()
	{
		$et_tipo_falla_model = $this->et_tipo_falla_model->obtenerDatosTipoFalla();

		$data = [
			'datos' => $et_tipo_falla_model
		];

		return view('Mantenedor/tipo_falla_tabla_datos', $data);
	}
	public function tipo_fallaInsertarDatos()
	{
		$descripcion = $this->request->getPost('descripcion');	
		$activo 	= $this->request->getPost('activo');	

		$data = [
			'descripcion' 	=> $descripcion,
			'activo' 		=> $activo
		];

		$resultado = $this->et_tipo_falla_model->insertarDatos($data);
		return $resultado;
	}
	public function tipo_fallaActualizarDatosPorId()
	{
		$id 			= $this->request->getPost('id');	
		$descripcion 	= $this->request->getPost('descripcion');	
		$activo 		= $this->request->getPost('activo');	

		$data = [
			'descripcion' 	=> $descripcion,
			'activo' 		=> $activo
		];

		$resultado = $this->et_tipo_falla_model->actualizarDatosPorId($id, $data);
		return $resultado;
	}
	

	public function tipo_fallaEliminarDatosPorId()
	{
		$id = $this->request->getPost('id');	

		$resultado = $this->et_tipo_falla_model->eliminarDatosPorId($id);
		return $resultado;
	}
	/*---------------------- TIPO ROTATIVA ------------------------*/
	
	public function tipo_rotativa()
	{
		$session_datos_usuario 	= $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado 	= $this->session->get("menu_usuario_logeado");
	
		
		$data = [
			'title_meta' 			=> view('partials/title-meta', ['title' => 'Mantenedor Tipos de Rotativa']),
			'page_title' 			=> view('partials/page-title', ['title_meta' => 'Mantenedor Tipos de Rotativa', 'title' => 'Mantenedor', 'pagetitle' => 'Tipos de Rotativa']),
			'session_datos_usuario'	=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'	=> json_decode($menu_usuario_logeado, false)
		];
		
		return view('Mantenedor/tipo_rotativa', $data);
	}
	public function obtenerDatosTipoRotativa()
	{
		$et_tipo_rotativa_model = $this->et_tipo_rotativa_model->obtenerDatosTipoRotativa();

		$data = [
			'datos' => $et_tipo_rotativa_model
		];

		return view('Mantenedor/tipo_rotativa_tabla_datos', $data);
	}
	public function tipo_rotativaInsertarDatos()
	{
		$descripcion = $this->request->getPost('descripcion');	
		$hora_inicio = $this->request->getPost('hora_inicio');	
		$hora_fin = $this->request->getPost('hora_fin');	

		$activo 	= $this->request->getPost('activo');	

		$data = [
			'descripcion' 	=> $descripcion,
			'hora_inicio' 	=> $hora_inicio,
			'hora_fin' 		=> $hora_fin,
			'activo' 		=> $activo
		];

		$resultado = $this->et_tipo_rotativa_model->insertarDatos($data);
		return $resultado;
	}
	public function tipo_rotativaActualizarDatosPorId()
	{
		$id 			= $this->request->getPost('id');	
		$descripcion 	= $this->request->getPost('descripcion');
		$hora_inicio = $this->request->getPost('hora_inicio');	
		$hora_fin = $this->request->getPost('hora_fin');		
		$activo 		= $this->request->getPost('activo');	

		$data = [
			'descripcion' 	=> $descripcion,
			'hora_inicio' 	=> $hora_inicio,
			'hora_fin' 		=> $hora_fin,
			'activo' 		=> $activo
		];

		$resultado = $this->et_tipo_rotativa_model->actualizarDatosPorId($id, $data);
		return $resultado;
	}
	

	public function tipo_rotativaEliminarDatosPorId()
	{
		$id = $this->request->getPost('id');	

		$resultado = $this->et_tipo_rotativa_model->eliminarDatosPorId($id);
		return $resultado;
	}
	/*---------------------- FARMACIA ------------------------*/
	
	public function farmacia()
	{
		$session_datos_usuario 	= $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado 	= $this->session->get("menu_usuario_logeado");

		$grl_servicio_resultado = $this->grl_sercicio_model->obtenerDatosServicio();

		
		$data = [
			'title_meta' 				=> view('partials/title-meta', ['title' => 'Mantenedor Farmacia']),
			'page_title' 				=> view('partials/page-title', ['title_meta' => 'Mantenedor Farmacia', 'title' => 'Mantenedor', 'pagetitle' => 'Farmacia']),
			'option_servicio' 			=> view('Mantenedor/farmacia_servicio_select', ['datos' => $grl_servicio_resultado]),
			'tabla_farmacia_defecto'	=> view('Mantenedor/farmacia_tabla_datos', ['datos' => null]),
			'session_datos_usuario'		=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'		=> json_decode($menu_usuario_logeado, false)
		];
		
		return view('Mantenedor/farmacia', $data);
	}
	
	public function obtenerTablaFarmaciaPorServicioSeleccionado()
	{
		$servicio_id = $this->request->getPost('servicio_id');	
		$et_farmacia_resultado = $this->et_farmacia_model->obtenerDatosFarmaciaPorServicioSeleccionado($servicio_id);

		$data = [
			'datos' => $et_farmacia_resultado
		];

		return view('Mantenedor/farmacia_tabla_datos', $data);
	}
	
	public function farmaciaInsertarDatos()
	{
		
		$servicio_id = $this->request->getPost('servicio_id');	
		$descripcion = $this->request->getPost('descripcion');
		$stock = $this->request->getPost('cantidad_stock');	
		$efecto = $this->request->getPost('efecto_adverso');	
		$activo 	= $this->request->getPost('activo');	

		$data = [
			'servicio_id' 	=> $servicio_id,
			'descripcion' 	=> $descripcion,
			'cantidad_stock' 	=> $stock,
			'efecto_adverso' 	=> $efecto,
			'activo' 		=> $activo
		];

		$resultado = $this->et_farmacia_model->insertarDatos($data);
		return $resultado;
	}
	public function farmaciaActualizarDatosPorId()
	{
		$id 			= $this->request->getPost('id');	
		$servicio_id    = $this->request->getPost('servicio_id');	
		$descripcion 	= $this->request->getPost('descripcion');	
		$stock = $this->request->getPost('cantidad_stock');	
		$efecto = $this->request->getPost('efecto_adverso');	
		$activo 		= $this->request->getPost('activo');	

		$data = [
			'servicio_id' 		=> $servicio_id,
			'descripcion' 		=> $descripcion,
			'cantidad_stock' 	=> $stock,
			'efecto_adverso' 	=> $efecto,
			'activo' 			=> $activo
		];

		$resultado = $this->et_farmacia_model->actualizarDatosPorId($id, $data);
		return $resultado;
	}
	

	public function farmaciaEliminarDatosPorId()
	{
		$id = $this->request->getPost('id');	

		$resultado = $this->et_farmacia_model->eliminarDatosPorId($id);
		return $resultado;
	}
	/*---------------------- MENU PERFIL ------------------------*/
	
	public function menu_perfil()
	{
		$session_datos_usuario 	= $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado 	= $this->session->get("menu_usuario_logeado");

		$et_perfil_resultado = $this->et_perfil_model->obtenerDatosPerfil();

		$data = [
			'title_meta' 			=> view('partials/title-meta', ['title' => 'Mantenedor Menú Perfil']),
			'page_title' 			=> view('partials/page-title', ['title_meta' => 'Mantenedor Menú Perfil', 'title' => 'Mantenedor', 'pagetitle' => 'Menú Perfil']),
			'option_perfil' 		=> view('Mantenedor/menu_perfil_select_perfil', ['datos' => $et_perfil_resultado]),
			'tabla_menu_perfil_defecto'	=> view('Mantenedor/menu_perfil_tabla_datos', ['datos' => null]),
			'session_datos_usuario'	=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'	=> json_decode($menu_usuario_logeado, false)
		];
		
		return view('Mantenedor/menu_perfil', $data);
	}
	
	public function ObtenerTablaMenuPerfilId()
	{
		$perfil_id = $this->request->getPost('perfil_id');	
		$et_perfil_menu_perfil_resultado = $this->et_menu_perfil_model->obtenerDatosMenuPerfilId($perfil_id);

		$data = [
			'datos' => $et_perfil_menu_perfil_resultado
		];

		return view('Mantenedor/menu_perfil_tabla_datos', $data);
	}
	
	public function menu_perfilAgregarSeleccionado()
	{
		$perfil_id 		= $this->request->getPost('perfil_id');	
		$menu_id    	= $this->request->getPost('menu_id');	

		$data = [
			'perfil_id' 	=> $perfil_id,
			'menu_id' 	    => $menu_id
		];

		$resultado = $this->et_menu_perfil_model->insertarDatos($data);
		return $resultado;
	}

	public function menu_perfilEliminarSeleccionado()
	{
		$id 		= $this->request->getPost('id');	

		$resultado = $this->et_menu_perfil_model->eliminarDatosPorId($id);
		return $resultado;
	}
	/*---------------------- FALLA RECURSO FISICO ESTADO ------------------------*/
	
	public function falla_recurso_fisico_estado()
	{
		$session_datos_usuario 	= $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado 	= $this->session->get("menu_usuario_logeado");
	
		
		$data = [
			'title_meta' 			=> view('partials/title-meta', ['title' => 'Mantenedor Falla Recurso Físico Estado']),
			'page_title' 			=> view('partials/page-title', ['title_meta' => 'Mantenedor Falla Recurso Físico Estado', 'title' => 'Mantenedor', 'pagetitle' => 'Falla Recurso Físico Estado']),
			'session_datos_usuario'	=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'	=> json_decode($menu_usuario_logeado, false)
		];
		
		return view('Mantenedor/falla_recurso_fisico_estado', $data);
	}
	public function obtenerTablaFallaRecursoFisicoEstado()
	{
		$et_falla_recurso_fisico_estado_model = $this->et_falla_recurso_fisico_estado_model->obtenerDatosFallaRecursoFisicoEstado();

		$data = [
			'datos' => $et_falla_recurso_fisico_estado_model
		];

		return view('Mantenedor/falla_recurso_fisico_estado_tabla_datos', $data);
	}
	public function FallaRecursoFisicoEstadoInsertarDatos()
	{
		$descripcion = $this->request->getPost('descripcion');	
		$activo 	= $this->request->getPost('activo');	

		$data = [
			'descripcion' 	=> $descripcion,
			'activo' 		=> $activo
		];

		$resultado = $this->et_falla_recurso_fisico_estado_model->insertarDatos($data);
		return $resultado;
	}
	public function FallaRecursoFisicoEstadoActualizarDatosPorId()
	{
		$id 			= $this->request->getPost('id');	
		$descripcion 	= $this->request->getPost('descripcion');	
		$activo 		= $this->request->getPost('activo');	

		$data = [
			'descripcion' 	=> $descripcion,
			'activo' 		=> $activo
		];

		$resultado = $this->et_falla_recurso_fisico_estado_model->actualizarDatosPorId($id, $data);
		return $resultado;
	}
	

	public function FallaRecursoFisicoEstadoEliminarDatosPorId()
	{
		$id = $this->request->getPost('id');	

		$resultado = $this->get_falla_recurso_fisico_estado_model->eliminarDatosPorId($id);
		return $resultado;
	}
	/*---------------------- DOTACION PERFIL ------------------------*/
	
	
	public function insertardotacionperfil()
	{
		$dotacion_id 		= $this->request->getPost('dotacion_id');	
		$perfil_id 			= $this->request->getPost('perfil_id');	

		$data = [
			'dotacion_id' 	=> $dotacion_id,
			'perfil_id' 	=> $perfil_id
		];

		$resultado = $this->et_dotacion_perfil_model->insertarDatos($data);
		return $resultado;
	}
	public function ActualizarDotacionPerfilPorId()
	{
		
		$dotacion_id    = $this->request->getPost('dotacion_id');	
		$perfil_id 		= $this->request->getPost('perfil_id');	
		$resultado_dotacion_perfil = $this->et_dotacion_perfil_model->obtenerPerfilPorDotacionId($dotacion_id);
		
		

		$data = [
			'dotacion_id' 		=> $dotacion_id,
			'perfil_id' 		=> $perfil_id,
			
		];

		if (count($resultado_dotacion_perfil)==0)
		{
			$resultado = $this->et_dotacion_perfil_model->insertarDatos($data);
		}
		else
		{
			$id=$resultado_dotacion_perfil[0]['id'];
			$resultado = $this->et_dotacion_perfil_model->actualizarDatosPorId($id, $data);
		}
	    return $resultado;
	}

	public function EliminarDotacionPerfil()
	{
		$dotacion_id		= $this->request->getPost('dotacion_id');

		$resultado_dotacion_perfil = $this->et_dotacion_perfil_model->obtenerPerfilPorDotacionId($dotacion_id);
		if (count($resultado_dotacion_perfil)==0)
		{
				$id=0;
		}
		else
		{
			$id=$resultado_dotacion_perfil[0]['id'];
		}	

		$resultado = $this->et_dotacion_perfil_model->eliminarDatosPorId($id);
		return $resultado;
	}

	/*---------------------- ENCRIPTA CONTRASEÑA ------------------------*/
	private function encriptarPass($pass)
	{ 
		$config_encript	= new \Config\Encryption();
		$encrypter 		= \Config\Services::encrypter($config_encript);
		$encryptiontext = $encrypter->encrypt($pass);
		return base64_encode($encryptiontext);
    }


	/*---------------------- ENVIO DE MAIL CON CLAVE DE ACCESO AL USUARIO ------------------------*/
	public function enviarAvisoPorEmail($rut)
	{
		
		$session_datos_usuario		= json_decode($this->session->get("datos_usuario_logeado"), false);
		
		$estado 					= false;
		$icono 						= '';
		$validacion 				= '';
		$mensaje 					= '';

		$resultadoDatosdotacion 	= $this->grl_dotacion_model->obtenerDotacionPorRut($rut);
		$data_from_email 		= $session_datos_usuario->email;
		$data_from_email_nombre = $session_datos_usuario->nombres.' '.$session_datos_usuario->apellido_uno;
		$email = \Config\Services::email();
	    $email->setFrom($data_from_email, $data_from_email_nombre);
		$email->setTo($resultadoDatosdotacion[0]['email']);
		

		$email->setSubject('Registro Usuario :'.$resultadoDatosdotacion[0]['nombres'].' '.$resultadoDatosdotacion[0]['apellido_uno']);

		$data_llenar_template = [
			'session_datos_usuario' 			=> $session_datos_usuario,
			'dotacion_registro_usuario'			=> $resultadoDatosdotacion[0],
		];

		$template = view('Mantenedor/dotacion_template_registro_usuario', $data_llenar_template);
		
		$email->setMessage($template);
		
		if (!$email->send()) 
		{
			$estado		= false;
			$icono 		= 'warning';
			$validacion = 'Error al enviar correo: '.$email->printDebugger();
			$mensaje 	= 'Validación proceso';

			
		} 
		$datos = [
			'estado' 			=> $estado,
			'icono' 			=> $icono,
			'validacion' 		=> $validacion,
			'mensaje' 			=> $mensaje
		];
		
		return json_encode($datos);
	}

}
