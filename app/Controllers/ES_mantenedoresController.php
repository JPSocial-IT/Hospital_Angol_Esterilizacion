<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ES_areasModel;
use App\Models\ES_bodegasModel;
use App\Models\ES_estados_solicitudModel;
use App\Models\ES_equiposModel;
// use App\Models\ES_serviciosModel;
use App\Models\GRLServicioModel;


class ES_mantenedoresController extends BaseController
{	
       protected $session;
	protected $ma_areas_model;
	protected $ma_bodegas_model;
	protected $ma_estados_solicitud_model;
	protected $ma_equipos_model;
	//protected $ma_servicios_model;
	protected $grl_servicio_model;

	public function __construct(){
              $this->ma_areas_model = new ES_areasModel();
		$this->ma_bodegas_model = new ES_bodegasModel();
              $this->ma_estados_solicitud_model = new ES_estados_solicitudModel();
		$this->ma_equipos_model = new ES_equiposModel();
		//$this->ma_servicios_model = new ES_serviciosModel();
		$this->grl_servicio_model = new GRLServicioModel();

		$this->session = \Config\Services::session();
        	$this->session->start();
		
	}

       /*---------------------- AREAS ------------------------*/
	public function areas(){
		$session_datos_usuario = $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado = $this->session->get("menu_usuario_logeado");
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Mantenedor de Áreas']),
			'page_title' => view('partials/page-title', ['title' => 'Mantenedor de Áreas', 'pagetitle' => 'Mantenedor de Áreas']),
			'session_datos_usuario'	=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'	=> json_decode($menu_usuario_logeado, false)
		];
		return view('Mantenedor/areas', $data);
	}

	public function areasObtenerTablaRegistros(){
		$ma_areas_model = $this->ma_areas_model->obtenerRegistros();
		$data = ['registros' => $ma_areas_model];
		return view('Mantenedor/areas_tabla_datos', $data);
	}

	public function areasObtenerRegistroPorId($id){
		$resultado = $this->ma_areas_model->obtenerRegistroPorId($id);
		return $resultado;
	}

	public function obtenerFuncionarios(){
		$funcionarios= $this->ma_areas_model->obtenerFuncionarios();
		return $funcionarios;
	}

	public function areasAgregarRegistro(){
		$data['formulario'] = [
			'accion' 	=> '1',
			'titulo' 	=> 'Agregar nueva Área del Servicio',
			'icono'	=> 'mdi-account-plus',
			'subtitulo' 	=> 'Ingrese los datos de la nueva Área del Servicio',
			'btn_guardar' => 'Agregar Área'
		];
		$data['resultado'] = [
			'id'			=> '0',
			'nombre'		=> '',
			'descripcion'		=> '',
			'id_encargado'	=> '0',
			'nombre_encargado'	=> '',
		];
		$data['funcionarios'] = $this->obtenerFuncionarios();
		return view('Mantenedor/areas_formulario', $data);
	}

	public function areasAgregarRegistroGuardar(){
		$nombre 		= $this->request->getPost('txt_nombre');
		$descripcion		= $this->request->getPost('txt_descripcion');
		$id_encargado		= $this->request->getPost('val_id_encargado');
		$nombre_encargado 	= $this->request->getPost('txt_nombre_encargado');
		$areas = [
			'nombre' 		=> $nombre,
			'descripcion'		=> $descripcion,
			'id_encargado'	=> $id_encargado,
			'nombre_encargado'	=> $nombre_encargado,
			'activo'		=> 't',
		];
		if($resultado = $this->ma_areas_model->agregarRegistro($areas)){
			$id = $resultado;
			$row = $this->areasObtenerRegistroPorId($id);
				$row = $row[0];
			$data = [
				'status' => 'SUCCESS',
				'id' => $id,
				'area' => $row['nombre'] . ' ' . $row['descripcion']
			];
		}
		else{
			$data = [
				'status' => 'ERROR',
				'error' => 'Error desconocido al insertar nuevo registro'
			];
		}
		$json_data = json_encode($data);
		echo $json_data;
	}

	public function areasEditarRegistro($id){
		$data['formulario'] = [
			'accion' 	=> '2',
			'titulo' 	=> 'Editar Área del Servicio',
			'icono'	=> 'mdi-account-edit',
			'subtitulo' 	=> 'Actualizar los datos de Área de Servicio',
			'btn_guardar' => 'Actualizar Áreas'
		];
		$resultado = $this->areasObtenerRegistroPorId($id);
		$row = $resultado[0];
		$data['resultado'] = [
			'id'	=> $id,
			'nombre'		=> $row['nombre'],
			'descripcion'		=> $row['descripcion'],
 			'id_encargado' 	=> $row['id_encargado'],
			'nombre_encargado'	=> $row['nombre_encargado'],
		];
		$data['funcionarios'] = $this->obtenerFuncionarios();
		return view('Mantenedor/areas_formulario', $data);
	}


	public function areasEditarRegistroGuardar(){
		$id_area		= $this->request->getPost('hf_id_area');
		$nombre		= $this->request->getPost('txt_nombre');
		$descripcion		= $this->request->getPost('txt_descripcion');
		$id_encargado 	= $this->request->getPost('val_id_encargado');
		$nombre_encargado 	= $this->request->getPost('txt_nombre_encargado');
		$areas = [
			'nombre' 		=> $nombre,
			'descripcion'		=> $descripcion,
			'id_encargado'	=> $id_encargado,
			'nombre_encargado'	=> $nombre_encargado,
		];
		if($resultado = $this->ma_areas_model->editarRegistro($id_area, $areas)){
			$data = [
				'status' => 'SUCCESS',
				'id' => $id_area,
				'area' => $areas['nombre'] . ' ' . $areas['descripcion']
			];
		}
		else{
			$data = [
				'status' => 'ERROR',
				'error' => 'Error desconocido al editar área seleccionada'
			];
		}
		$json_data = json_encode($data);
		echo $json_data;
	}


	public function areasEliminarRegistroConfirmar($id){
		$resultado = $this->areasObtenerRegistroPorId($id);
			$row = $resultado[0];
			$data = [
			'status' => 'SUCCESS',
			'area' => $row['nombre'] . ' ' . $row['descripcion']
		];
		$json_data = json_encode($data);
		echo $json_data;
	}

	public function areasEliminarRegistro(){
		$id = $this->request->getPost('id');
		$resultado = $this->obtenerRegistroPorId($id);
		$row = $resultado[0];
		if($rs = $this->ma_areas_model->eliminarRegistro($id)){
			$data = [
				'status' => 'SUCCESS',
				'area' => $row['nombre'] . ' ' . $row['descripcion']
        	];
        	}
        	else{
			$data = [
				'status' => 'ERROR',
				'error' => 'Error desconocido al eliminar el árra seleccionada'
        	];
		}
		$json_data = json_encode($data);
		echo $json_data;
	}
             /*---------------------- FIN AREAS --------------------*/

		/*---------------------- BODEGAS ----------------------*/
	public function bodegas(){
		$session_datos_usuario = $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado = $this->session->get("menu_usuario_logeado");
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Mantenedor Bodegas']),
			'page_title' => view('partials/page-title', ['title' => 'Mantenedor Bodegas', 'pagetitle' => 'Mantenedor Bodegas']),
			'session_datos_usuario'	=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'	=> json_decode($menu_usuario_logeado, false)
		];
		// return view('MantenedorDemo/index', $data);
		return view('Mantenedor/bodegas', $data);
	}
		
	public function bodegasObtenerTablaRegistros(){
		$ma_bodegas_model = $this->ma_bodegas_model->obtenerRegistros();
		$data = ['registros' => $ma_bodegas_model];
		return view('Mantenedor/bodegas_tabla_datos', $data);
	}
	
	
	public function bodegasObtenerRegistroPorId($id){
		$resultado = $this->ma_bodegas_model->obtenerRegistroPorId($id);
		return $resultado;
	}
	
	public function bodegaObtenerFuncionarios(){
		$funcionarios= $this->ma_bodegas_model->obtenerFuncionarios();
		return $funcionarios;
	}
	
	public function bodegasAgregarRegistro(){
		$data['formulario'] = [
			'accion' 	=> '1',
			'titulo' 	=> 'Agregar Bodega Esterilización',
			'icono'	=> 'mdi-account-plus',
			'subtitulo' 	=> 'Ingrese los datos de la nueva Bodega',
			'btn_guardar' => 'Agregar Bodega'
		];
		$data['resultado'] = [
			'id'			=> '0',
			'descripcion'		=> '',
			'comentario'		=> '',
			'encargado_id'	=> '0',
			'encargado_nombre'	=> '',
		];
		$data['funcionarios'] = $this->obtenerFuncionarios();
		return view('Mantenedor/bodegas_formulario', $data);
	}
	
	public function bodegasAgregarRegistroGuardar(){
		$descripcion 		= $this->request->getPost('txt_descripcion');
		$comentario	 	= $this->request->getPost('txt_comentario');
		$encargado_id	 	= $this->request->getPost('val_encargado_id');
		$encargado_nombre 	= $this->request->getPost('txt_encargado_nombre');
		$activo		= True;
		$bodegas = [
			'descripcion' 	=> $descripcion,
			'comentario'		=> $comentario,
			'encargado_id'	=> $encargado_id,
			'encargado_nombre'	=> $encargado_nombre,
			'activo'		=> 't',
		];
		if($resultado = $this->ma_bodegas_model->agregarRegistro($bodegas)){
			$id = $resultado;
			$row = $this->bodegasObtenerRegistroPorId($id);
				$row = $row[0];
			$data = [
				'status' => 'SUCCESS',
				'id' => $id,
				'bodega' => $row['descripcion'] . ' ' . $row['comentario']
			];
		}
		else{
			$data = [
				'status' => 'ERROR',
				'error' => 'Error desconocido al insertar nuevo registro'
			];
		}
		$json_data = json_encode($data);
		echo $json_data;
	}
		
	public function bodegasEditarRegistro($id){
		$data['formulario'] = [
			'accion' 	=> '2',
			'titulo' 	=> 'Editar Bodega Esterilización',
			'icono'	=> 'mdi-account-edit',
			'subtitulo' 	=> 'Actualice los datos de la Bodega de Esterilización seleccionada',
			'btn_guardar' => 'Actualizar Bodega'
		];
		$resultado = $this->bodegasObtenerRegistroPorId($id);
		$row = $resultado[0];
		$data['resultado'] = [
			'id'	=> $id,
			'descripcion'		=> $row['descripcion'],
			'comentario'		=> $row['comentario'],
			 'encargado_id' 	=> $row['encargado_id'],
			'encargado_nombre'	=> $row['encargado_nombre'],
		];
		$data['funcionarios'] = $this->obtenerFuncionarios();
		return view('Mantenedor/bodegas_formulario', $data);
	}
	
	public function bodegasEditarRegistroGuardar(){
		$id_bodega		= $this->request->getPost('hf_id_bodega');
		$descripcion		= $this->request->getPost('txt_descripcion');
		$comentario	 	= $this->request->getPost('txt_comentario');
		$encargado_id	 	= $this->request->getPost('val_encargado_id');
		$encargado_nombre 	= $this->request->getPost('txt_encargado_nombre');
		$bodegas = [
			'descripcion' 	=> $descripcion,
			'comentario'		=> $comentario,
			'encargado_id'	=> $encargado_id,
			'encargado_nombre'	=> $encargado_nombre
		];
		if($resultado = $this->ma_bodegas_model->editarRegistro($id_bodega, $bodegas)){
			$data = [
				'status' => 'SUCCESS',
				'id' => $id_bodega,
				'bodega' => $bodegas['descripcion'] . ' ' . $bodegas['comentario']
			];
		}
		else{
			$data = [
				'status' => 'ERROR',
				'error' => 'Error desconocido al editar usuario seleccionado'
			];
		}
		$json_data = json_encode($data);
		echo $json_data;
	}

	public function bodegasEliminarRegistroConfirmar($id){
		$resultado = $this->bodegasObtenerRegistroPorId($id);
			$row = $resultado[0];
			$data = [
			'status' => 'SUCCESS',
			'bodega' => $row['descripcion'] . ' ' . $row['comentario']
		];
		$json_data = json_encode($data);
		echo $json_data;
	}
	
	public function bodegasEliminarRegistro(){
		$id = $this->request->getPost('id');
		$resultado = $this->bodegasObtenerRegistroPorId($id);
		$row = $resultado[0];
		if($rs = $this->ma_bodegas_model->eliminarRegistro($id)){
			$data = [
				'status' => 'SUCCESS',
				'bodega' => $row['descripcion'] . ' ' . $row['comentario']
			];
		}
		else{
			$data = [
				'status' => 'ERROR',
				'error' => 'Error desconocido al eliminar usuario seleccionado'
			];
		}
		$json_data = json_encode($data);
		echo $json_data;
	}		
		/*-------------------- FIN BODEGAS ---------------------*/

		/*---------------------- ESTADOS SOLICITUD -------------*/
	public function estados_solicitud(){
		$session_datos_usuario = $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado = $this->session->get("menu_usuario_logeado");
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Mantenedor Estados Solicitudes']),
			'page_title' => view('partials/page-title', ['title' => 'Mantenedor Estados Solicitudes', 'pagetitle' => 'Mantenedor Estados Solicitudes']),
			'session_datos_usuario'	=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'	=> json_decode($menu_usuario_logeado, false)
		];
		return view('Mantenedor/estados_solicitud', $data);
	}
		
	public function estadosObtenerTablaRegistros(){
		$ma_estados_solicitud_model = $this->ma_estados_solicitud_model->obtenerRegistros();
		$data = ['registros' => $ma_estados_solicitud_model];
		return view('Mantenedor/estados_tabla_datos', $data);
	}
		
	public function estadosObtenerRegistroPorId($id){
		$resultado = $this->ma_estados_solicitud_model->obtenerRegistroPorId($id);
		return $resultado;
	}
	
	public function estadosAgregarRegistro(){
		$data['formulario'] = [
			'accion' 	=> '1',
			'titulo' 	=> 'Agregar Estado de Solicitud',
			'icono'	=> 'mdi-account-plus',
			'subtitulo' 	=> 'Ingrese los datos del nuevo Estado',
			'btn_guardar' => 'Agregar Estado'
		];
		$data['resultado'] = [
			'id'			=> '0',
			'descripcion'		=> '',
			'descripcion_estado'	=> '',
		];
		return view('Mantenedor/estados_formulario', $data);
	}
	
	public function estadosAgregarRegistroGuardar(){
		$descripcion 		= $this->request->getPost('txt_descripcion');
		$descripcion_estado 	= $this->request->getPost('txt_descripcion_estado');
		$estado_solicitud = [
			'descripcion' 	=> $descripcion,
			'descripcion_estado'	=> $descripcion_estado,
			'activo'		=> 't',
		];
		if($resultado = $this->ma_estados_solicitud_model->agregarRegistro($estado_solicitud)){
			$id = $resultado;
			$row = $this->estadosObtenerRegistroPorId($id);
				$row = $row[0];
			$data = [
				'status' => 'SUCCESS',
				'id' => $id,
				'nombre_estado' => $row['descripcion'] . ' ' . $row['descripcion_estado']
			];
		}
		else{
			$data = [
				'status' => 'ERROR',
				'error' => 'Error desconocido al insertar nuevo registro'
			];
		}
		$json_data = json_encode($data);
		echo $json_data;
	}
	
	public function estadosEditarRegistro($id){
		$data['formulario'] = [
			'accion' 	=> '2',
			'titulo' 	=> 'Editar Estados de Solicitudes',
			'icono'	=> 'mdi-account-edit',
			'subtitulo' 	=> 'Actualice los datos del Estado de Solicitud seleccionado',
			'btn_guardar' => 'Actualizar Estado'
		];
		$resultado = $this->estadosObtenerRegistroPorId($id);
		$row = $resultado[0];
		$data['resultado'] = [
			'id'	=> $id,
			'descripcion'	=> $row['descripcion'],
			'descripcion_estado'	=> $row['descripcion_estado']
		];
		return view('Mantenedor/estados_formulario', $data);
	}
	
	public function estadosEditarRegistroGuardar(){
		$id_estado		= $this->request->getPost('hf_id_estado');
		$descripcion		= $this->request->getPost('txt_descripcion');
		$descripcion_estado 	= $this->request->getPost('txt_descripcion_estado');
		$estado_solicitud = [
			'descripcion' 	=> $descripcion,
			'descripcion_estado'	=> $descripcion_estado
		];
		if($resultado = $this->ma_estados_solicitud_model->editarRegistro($id_estado, $estado_solicitud)){
			$data = [
				'status' => 'SUCCESS',
				'id' => $id_estado,
				'nombre_estado' => $estado_solicitud['descripcion'] . ' ' . $estado_solicitud['descripcion_estado']
			];
		}
		else{
			$data = [
				'status' => 'ERROR',
				'error' => 'Error desconocido al editar usuario seleccionado'
			];
		}
		$json_data = json_encode($data);
		echo $json_data;
	}

	public function estadosEliminarRegistroConfirmar($id){
		$resultado = $this->estadosObtenerRegistroPorId($id);
		$row = $resultado[0];
		$data = [
		'status' => 'SUCCESS',
			'nombre_estado' => $row['descripcion'] . ' ' . $row['descripcion_estado']
		];
		$json_data = json_encode($data);
		echo $json_data;
	}
	
	
	public function estadosEliminarRegistro(){
		$id = $this->request->getPost('id');
		$resultado = $this->estadosObtenerRegistroPorId($id);
		$row = $resultado[0];
		if($rs = $this->ma_estados_solicitud_model->estadoEliminarRegistro($id)){
			$data = [
				'status' => 'SUCCESS',
				'nombre_estado' => $row['descripcion'] . ' ' . $row['descripcion_estado']
			 ];
		}
		else{
			$data = [
				'status' => 'ERROR',
				'error' => 'Error desconocido al eliminar usuario seleccionado'
		];
		}
		$json_data = json_encode($data);
		echo $json_data;
	}
		/*-------------------FIN ESTADOS SOLICITUD -------------*/	

		/*---------------------- EQUIPOS -----------------------*/
	public function equipos(){
		$session_datos_usuario = $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado = $this->session->get("menu_usuario_logeado");
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Mantenedor Equipos de Lavado Automáticos']),
			'page_title' => view('partials/page-title', ['title' => 'Mantenedor Equipos de Lavado Automáticos', 'pagetitle' => 'Mantenedor Equipos de Lavado Automáticos']),
			'session_datos_usuario'	=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'	=> json_decode($menu_usuario_logeado, false)
		];
		$data['tipos'] = $this->obtenerTipos();
		return view('Mantenedor/equipos', $data);
	}
	
	public function equiposObtenerTablaRegistros(){
		$ma_equipos_model = $this->ma_equipos_model->obtenerRegistros();
		$data = ['registros' => $ma_equipos_model];
		return view('Mantenedor/equipos_tabla_datos', $data);
	}
	
	public function equiposObtenerRegistroPorId($id){
		$resultado = $this->ma_equipos_model->obtenerRegistroPorId($id);
		return $resultado;
	}
	
	public function obtenerAreas(){
		$areas= $this->ma_equipos_model->obtenerAreas();
		return $areas;
	}

	public function obtenerTipos(){
		$areas= $this->ma_equipos_model->obtenerTipos();
		return $areas;
	}

	public function equiposAgregarRegistro(){
		$data['formulario'] = [
			'accion' 	=> '1',
			'titulo' 	=> 'Agregar nuevo Equipo del Servicio',
			'icono'	=> 'mdi-account-plus',
			'subtitulo' 	=> 'Ingrese los datos del nuevo Equipo del Servicio',
			'btn_guardar' => 'Agregar Equipo'
		];
		$data['resultado'] = [
			'id'			=> '0',
			'descripcion' 	=> '',
			'descripcion_equipo'	=> '',
			'area_id'		=> '0',
			'descripcion_area'	=> '',
			'centro_costo'	=> '0',
			'tipo_id'		=> '0',
			'tipo_descripcion'	=> '',
		];
		$data['areas'] = $this->obtenerAreas();
		$data['tipos'] = $this->obtenerTipos();
		return view('Mantenedor/equipos_formulario', $data);
	}
	
	public function equiposAgregarRegistroGuardar(){
		$descripcion 		= $this->request->getPost('txt_descripcion');
		$descripcion_equipo	= $this->request->getPost('txt_descripcion_equipo');
		$area_id		= $this->request->getPost('val_area_id');
		$descripcion_area 	= $this->request->getPost('txt_descripcion_area');
		$centro_costo 	= $this->request->getPost('val_centro_costo');
		$tipo_id		= $this->request->getPost('val_tipo_id');
		$tipo_descripcion 	= $this->request->getPost('txt_tipo_descripcion');
		$equipos = [
			'descripcion' 	=> $descripcion,
			'descripcion_equipo'	=> $descripcion_equipo,
			'area_id'		=> $area_id,
			'descripcion_area'	=> $descripcion_area,
			'centro_costo'	=> $centro_costo,
			'tipo_id'		=> $tipo_id,
			'tipo_descripcion'	=> $tipo_descripcion,
			'activo'		=> 't',
		];
		if($resultado = $this->ma_equipos_model->agregarRegistro($equipos)){
			$id = $resultado;
			$row = $this->equiposObtenerRegistroPorId($id);
				$row = $row[0];
			$data = [
				'status' => 'SUCCESS',
				'id' => $id,
				'equipo' => $row['descripcion'] . ' ' . $row['descripcion_equipo']
			];
		}
		else{
			$data = [
				'status' => 'ERROR',
				'error' => 'Error desconocido al insertar nuevo registro'
			];
		}
		$json_data = json_encode($data);
		echo $json_data;
	}
	
	
	public function equiposEditarRegistro($id){
		$data['formulario'] = [
			'accion' 	=> '2',
			'titulo' 	=> 'Editar Equipo del Servicio',
			'icono'	=> 'mdi-account-edit',
			'subtitulo' 	=> 'Actualizar los datos Equipo del Servicio',
			'btn_guardar' => 'Actualizar Equipo'
		];
		$resultado = $this->equiposObtenerRegistroPorId($id);
		$row = $resultado[0];
		$data['resultado'] = [
			'id'	=> $id,
			'area_id' 		=> $row['area_id'],
			'descripcion'		=> $row['descripcion'],
			'descripcion_equipo'	=> $row['descripcion_equipo'],
			'descripcion_area'	=> $row['descripcion_area'],
			'centro_costo'	=> $row['centro_costo'],
			'tipo_id'		=> $row['tipo_id'],
			'tipo_descripcion'	=> $row['tipo_descripcion'],
		];
		$data['areas'] = $this->obtenerAreas();
		$data['tipos'] = $this->obtenerTipos();
		return view('Mantenedor/equipos_formulario', $data);
	}
		
	public function equiposEditarRegistroGuardar(){
		$id_equipo		= $this->request->getPost('hf_id_equipo');
		$descripcion 		= $this->request->getPost('txt_descripcion');
		$descripcion_equipo	= $this->request->getPost('txt_descripcion_equipo');
		$area_id		= $this->request->getPost('val_area_id');
		$descripcion_area 	= $this->request->getPost('txt_descripcion_area');
		$centro_costo 	= $this->request->getPost('val_centro_costo');
		$tipo_id		= $this->request->getPost('val_tipo_id');
		$tipo_descripcion 	= $this->request->getPost('txt_tipo_descripcion');
		$equipos = [
			'descripcion' 	=> $descripcion,
			'descripcion_equipo'	=> $descripcion_equipo,
			'area_id'		=> $area_id,
			'descripcion_area'	=> $descripcion_area,
			'centro_costo'	=> $centro_costo,
			'tipo_id'		=> $tipo_id,
			'tipo_descripcion'	=> $tipo_descripcion,
		];
		if($resultado = $this->ma_equipos_model->editarRegistro($id_equipo, $equipos)){
			$data = [
				'status' => 'SUCCESS',
				'id' => $id_equipo,
				'equipo' => $equipos['descripcion'] . ' ' . $equipos['descripcion_equipo']
			];
		}
		else{
			$data = [
				'status' => 'ERROR',
				'error' => 'Error desconocido al editar usuario seleccionado'
			];
		}
		$json_data = json_encode($data);
		echo $json_data;
	}
		
	public function equiposEliminarRegistroConfirmar($id){
		$resultado = $this->equiposObtenerRegistroPorId($id);
			$row = $resultado[0];
			$data = [
			'status' => 'SUCCESS',
			'equipo' => $row['descripcion'] . ' ' . $row['descripcion_equipo']
		];
		$json_data = json_encode($data);
		echo $json_data;
	}
	
	public function equiposEliminarRegistro(){
		$id = $this->request->getPost('id');
		$resultado = $this->equiposObtenerRegistroPorId($id);
		$row = $resultado[0];
		if($rs = $this->ma_equipos_model->eliminarRegistro($id)){
			$data = [
				'status' => 'SUCCESS',
				'equipo' => $row['descripcion'] . ' ' . $row['descripcion_equipo']
		 ];
		 }
		 else{
			$data = [
				'status' => 'ERROR',
				'error' => 'Error desconocido al eliminar usuario seleccionado'
		 ];
		}
		$json_data = json_encode($data);
		echo $json_data;
	}
		/*-------------------- FIN EQUIPOS -----------------------*/

		/*---------------------- SERVICIO ------------------------*/
	public function servicios(){
		$session_datos_usuario 	= $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado 	= $this->session->get("menu_usuario_logeado");
	
		$data = [
			/* 'title_meta' 	=> view('partials/title-meta', ['title' => 'Mantenedor Servicio']),
			'page_title' 			=> view('partials/page-title', ['title_meta' => 'Mantenedor Servicio', 'title' => 'Mantenedor', 'pagetitle' => 'Servicio']), */
			'title_meta' => view('partials/title-meta', ['title' => 'Mantenedor Servicio']),
			'page_title' => view('partials/page-title', ['title' => 'Mantenedor Servicio', 'pagetitle' => 'Mantenedor Servicio']),
			'session_datos_usuario'	=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'	=> json_decode($menu_usuario_logeado, false)
		];
		return view('Mantenedor/servicio', $data);
	}
		
	public function servicioObtenerTablaServicio(){
		$grl_servicio_model = $this->grl_servicio_model->obtenerDatosServicio();
		$data = ['datos' => $grl_servicio_model];
		return view('Mantenedor/servicio_tabla_datos', $data);
	}
		
	public function servicioInsertarDatos(){
		$cod_deis	= $this->request->getPost('cod_deis');	
		$descripcion	= $this->request->getPost('descripcion');	
		$activo 	= $this->request->getPost('activo_es');	
	
		$data = [
			'cod_deis'	=> $cod_deis,
			'descripcion'	=> $descripcion,
			'activo_es' 	=> $activo
		];
		$resultado = $this->grl_servicio_model->insertarDatos($data);
		return $resultado;
	}
		
	
	public function servicioActualizarDatosPorId(){
		$id 		= $this->request->getPost('id');	
		$cod_deis 	= $this->request->getPost('cod_deis');
		$descripcion 	= $this->request->getPost('descripcion');	
		$activo 	= $this->request->getPost('activo_es');	
	
		$data = [
			'descripcion' 	=> $descripcion,
			'activo_es' 		=> $activo
		];
		$resultado = $this->grl_servicio_model->actualizarDatosPorId($id, $data);
		return $resultado;
	}
		
	public function servicioEliminarDatosPorId(){
		$id = $this->request->getPost('id');	
	
		$resultado = $this->grl_servicio_model->eliminarDatosPorId($id);
		return $resultado;
	}
		/* public function servicios(){
			$session_datos_usuario = $this->session->get("datos_usuario_logeado");
			$menu_usuario_logeado = $this->session->get("menu_usuario_logeado");
			$data = [
				'title_meta' => view('partials/title-meta', ['title' => 'Mantenedor de Servicios']),
				'page_title' => view('partials/page-title', ['title' => 'Mantenedor de Servicios', 'pagetitle' => 'Mantenedor de Servicios']),
				'session_datos_usuario'	=> json_decode($session_datos_usuario, false),
				'menu_usuario_logeado'	=> json_decode($menu_usuario_logeado, false)
			];
			return view('Mantenedor/servicios', $data);
		}
	
		public function serviciosObtenerTablaRegistros(){
			$ma_servicios_model = $this->ma_servicios_model->obtenerRegistros();
			$data = ['registros' => $ma_servicios_model];
			return view('Mantenedor/servicios_tabla_datos', $data);
		}
	
		public function serviciosObtenerRegistroPorId($id){
			$resultado = $this->ma_servicios_model->obtenerRegistroPorId($id);
			return $resultado;
		}
	
		public function serviciosObtenerFuncionarios(){
			$funcionarios= $this->ma_servicios_model->obtenerFuncionarios();
			return $funcionarios;
		}
	
		public function serviciosAgregarRegistro(){
			$data['formulario'] = [
				'accion' 	=> '1',
				'titulo' 	=> 'Agregar nuevo Servicios',
				'icono'	=> 'mdi-account-plus',
				'subtitulo' 	=> 'Ingrese los datos del nuevo Servicio a atender',
				'btn_guardar' => 'Agregar Servicio'
			];
			$data['resultado'] = [
				'id'		=> '0',
				'cod_deis'	=> '0',
				'descripcion'	=> '',
				'activo_es'	=> 't',
			];
			$data['funcionarios'] = $this->obtenerFuncionarios();
			return view('Mantenedor/servicios_formulario', $data);
		}
	
		public function serviciosAgregarRegistroGuardar(){
			$cod_deis	= $this->request->getPost('val_cod_dais');
			$descripcion	= $this->request->getPost('txt_descripcion');
			$activo_es	= $this->request->getPost('chk_activo_es');
			$servicios = [
				'cod_deis' 	=> $cod_deis,
				'descripcion'	=> $descripcion,
				'activo_es'	=> $activo_es,
			];
			if($resultado = $this->ma_servicios_model->agregarRegistro($servicios)){
				$id = $resultado;
				$row = $this->serviciosObtenerRegistroPorId($id);
					$row = $row[0];
				$data = [
					'status' => 'SUCCESS',
					'id' => $id,
					'servicio' => $row['cod_deis'] . ' ' . $row['descripcion']
				];
			}
			else{
				$data = [
					'status' => 'ERROR',
					'error' => 'Error desconocido al insertar nuevo registro'
				];
			}
			$json_data = json_encode($data);
			echo $json_data;
		}
	
		public function serviciosEditarRegistro($id){
			$data['formulario'] = [
				'accion' 	=> '2',
				'titulo' 	=> 'Editar Servicio',
				'icono'	=> 'mdi-account-edit',
				'subtitulo' 	=> 'Actualizar los datos del nuevo Servicio a atender',
				'btn_guardar' => 'Actualizar Servicios'
			];
			$resultado = $this->serviciosObtenerRegistroPorId($id);
			$row = $resultado[0];
			$data['resultado'] = [
				'id'	=> $id,
				'cod_deis'	=> $row['cod_deis'],
				'descripcion'	=> $row['descripcion'],
				'activo_es' 	=> $row['activo_es'],
			];
			return view('Mantenedor/servicios_formulario', $data);
		}
	
		public function serviciosEditarRegistroGuardar(){
			$id		= $this->request->getPost('hf_id_servicio');
			$cod_deis	= $this->request->getPost('val_cod_deis');
			$descripcion	= $this->request->getPost('txt_descripcion');
			$activo_es 	= $this->request->getPost(isset($_POST['chk_activo_es']));
			$servicios = [
				'cod_deis'	=> $cod_deis,
				'descripcion'	=> $descripcion,
				'activo_es'	=> $activo_es,
			];
			if($resultado = $this->ma_servicios_model->editarRegistro($id, $servicios)){
				$data = [
					'status' => 'SUCCESS',
					'id' => $id,
					'servicio' => $servicios['cod_deis'] . ' ' . $servicios['descripcion']
				];
			}
			else{
				$data = [
					'status' => 'ERROR',
					'id' => $id,
					'error' => 'Error desconocido al editar usuario seleccionado'
				];
			}
			$json_data = json_encode($data);
			echo $json_data;
		}
	
	
		public function serviciosEliminarRegistroConfirmar($id){
			$resultado = $this->obtenerRegistroPorId($id);
				$row = $resultado[0];
				$data = [
				'status' => 'SUCCESS',
				'servicio' => $row['cod_dais'] . ' ' . $row['descripcion']
			];
			$json_data = json_encode($data);
			echo $json_data;
		}
	
		public function serviciosEliminarRegistro(){
			$id = $this->request->getPost('id');
			$resultado = $this->serviciosObtenerRegistroPorId($id);
			$row = $resultado[0];
			if($rs = $this->ma_servicios_model->eliminarRegistro($id)){
				$data = [
					'status' => 'SUCCESS',
					'servicio' => $row['cod_dais'] . ' ' . $row['descripcion']
			 ];
			 }
			 else{
				$data = [
					'status' => 'ERROR',
					'error' => 'Error desconocido al eliminar usuario seleccionado'
			 ];
			}
			$json_data = json_encode($data);
			echo $json_data;
		} */

		/*---------------------- FIN SERVICIO --------------------*/		

}