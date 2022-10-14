<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MA_clientesModel;

class MA_clientes extends BaseController
{	
	protected $ma_clientes_model;

	public function __construct(){
		$this->session = \Config\Services::session();
        	$this->session->start();
		$this->ma_clientes_model = new MA_clientesModel();
	}

	public function index(){
		$session_datos_usuario = $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado = $this->session->get("menu_usuario_logeado");
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Mantenedor de Clientes']),
			'page_title' => view('partials/page-title', ['title' => 'Mantenedor de Clientes', 'pagetitle' => 'Mantenedor de Clientes']),
			'session_datos_usuario'	=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'	=> json_decode($menu_usuario_logeado, false)
		];
		return view('MA_clientes/index', $data);
	}

	public function obtenerTablaRegistros(){
		$ma_clientes_model = $this->ma_clientes_model->obtenerRegistros();
		$data = ['registros' => $ma_clientes_model];
		return view('MA_clientes/tabla_datos', $data);
	}

	public function obtenerRegistroPorId($id){
		$resultado = $this->ma_clientes_model->obtenerRegistroPorId($id);
		return $resultado;
	}

	public function obtenerRegiones(){
		$areas= $this->ma_clientes_model->obtenerRegiones();
		return $areas;
	}

	public function obtenerComunas(){
		$areas= $this->ma_clientes_model->obtenerComunas();
		return $areas;
	}

	public function agregarRegistro(){
		$data['formulario'] = [
			'accion' 	=> '1',
			'titulo' 	=> 'Agregar nuevo Cliente del Servicio',
			'icono'	=> 'mdi-account-plus',
			'subtitulo' 	=> 'Ingrese los datos del nuevo Cliente del Servicio',
			'btn_guardar' => 'Agregar Cliente'
		];
		$data['resultado'] = [
			'id'			=> '0',
			'rut'			=> '0',
			'dv'			=> '',
			'nombres'		=> '',
			'apellido_uno'	=> '',
			'apellido_dos'	=> '',
			'razon_social'	=> '',
			'calle_direccion'	=> '',
			'numero_direccion'	=> '',
			'complemento_direccion'	=> '',
			'comuna_direccion'	=> '',
			'ciudad_direccion'	=> '',
			'fonos_fijos'		=> '',
			'fonos_moviles'	=> '',
			'comuna_id'		=> '0',
			'ciudad_id'		=> '0',
			'cliente_interno'	=> false,
			'cliente_empresa'	=> false,
			'email'		=> '',
			'nombre_contacto'	=> '',
			'nombre_persona_despacho'	=> '',
			'nombre_persona_recibe'	=> ''
		];
		$data['regiones'] = $this->obtenerRegiones();
		$data['comunas'] = $this->obtenerComunas();
		return view('MA_clientes/formulario', $data);
	}

	public function agregarRegistroGuardar(){
		$descripcion 		= $this->request->getPost('txt_descripcion');
		$descripcion_equipo	= $this->request->getPost('txt_descripcion_equipo');
		$area_id		= $this->request->getPost('val_area_id');
		$descripcion_area 	= $this->request->getPost('txt_descripcion_area');
		$centro_costo 	= $this->request->getPost('val_centro_costo');
		$equipos = [
			'descripcion' 	=> $descripcion,
			'descripcion_equipo'	=> $descripcion_equipo,
			'area_id'		=> $area_id,
			'descripcion_area'	=> $descripcion_area,
			'centro_costo'	=> $centro_costo,
		];
		if($resultado = $this->ma_clientes_model->agregarRegistro($equipos)){
			$id = $resultado;
			$row = $this->obtenerRegistroPorId($id);
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


	public function editarRegistro($id){
		$data['formulario'] = [
			'accion' 	=> '2',
			'titulo' 	=> 'Editar Equipo de Lavado Automático',
			'icono'	=> 'mdi-account-edit',
			'subtitulo' 	=> 'Actualizar los datos del Equipo de Lavado Automático',
			'btn_guardar' => 'Actualizar Equipo'
		];
		$resultado = $this->obtenerRegistroPorId($id);
		$row = $resultado[0];
		$data['resultado'] = [
			'id'	=> $id,
			'area_id' 		=> $row['area_id'],
			'descripcion'		=> $row['descripcion'],
			'descripcion_equipo'	=> $row['descripcion_equipo'],
			'descripcion_area'	=> $row['descripcion_area'],
			'centro_costo'	=> $row['centro_costo'],
		];
		$data['areas'] = $this->obtenerAreas();
		return view('MA_clientes/formulario', $data);
	}


	public function editarRegistroGuardar(){
		$id_equipo		= $this->request->getPost('hf_id_equipo');
		$descripcion 		= $this->request->getPost('txt_descripcion');
		$descripcion_equipo	= $this->request->getPost('txt_descripcion_equipo');
		$area_id		= $this->request->getPost('val_area_id');
		$descripcion_area 	= $this->request->getPost('txt_descripcion_area');
		$centro_costo 	= $this->request->getPost('val_centro_costo');
		$equipos = [
			'descripcion' 	=> $descripcion,
			'descripcion_equipo'	=> $descripcion_equipo,
			'area_id'		=> $area_id,
			'descripcion_area'	=> $descripcion_area,
			'centro_costo'	=> $centro_costo,
		];
		if($resultado = $this->ma_clientes_model->editarRegistro($id_equipo, $equipos)){
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


	public function eliminarRegistroConfirmar($id){
		$resultado = $this->obtenerRegistroPorId($id);
			$row = $resultado[0];
			$data = [
			'status' => 'SUCCESS',
			'equipo' => $row['descripcion'] . ' ' . $row['descripcion_equipo']
		];
		$json_data = json_encode($data);
		echo $json_data;
	}

	public function eliminarRegistro(){
		$id = $this->request->getPost('id');
		$resultado = $this->obtenerRegistroPorId($id);
		$row = $resultado[0];
		if($rs = $this->ma_clientes_model->eliminarRegistro($id)){
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

}
