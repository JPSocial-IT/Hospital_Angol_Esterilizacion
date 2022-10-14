<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MA_serviciosModel;

class MA_servicios extends BaseController
{	
	protected $ma_servicios_model;

	public function __construct(){
		$this->session = \Config\Services::session();
        	$this->session->start();
		$this->ma_servicios_model = new MA_serviciosModel();
	}

	public function index(){
		$session_datos_usuario = $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado = $this->session->get("menu_usuario_logeado");
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Mantenedor de Servicios']),
			'page_title' => view('partials/page-title', ['title' => 'Mantenedor de Servicios', 'pagetitle' => 'Mantenedor de Servicios']),
			'session_datos_usuario'	=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'	=> json_decode($menu_usuario_logeado, false)
		];
		return view('MA_servicios/index', $data);
	}

	public function obtenerTablaRegistros(){
		$ma_servicios_model = $this->ma_servicios_model->obtenerRegistros();
		$data = ['registros' => $ma_servicios_model];
		return view('MA_servicios/tabla_datos', $data);
	}

	public function obtenerRegistroPorId($id){
		$resultado = $this->ma_servicios_model->obtenerRegistroPorId($id);
		return $resultado;
	}

	public function obtenerFuncionarios(){
		$funcionarios= $this->ma_servicios_model->obtenerFuncionarios();
		return $funcionarios;
	}

	public function agregarRegistro(){
		$data['formulario'] = [
			'accion' 	=> '1',
			'titulo' 	=> 'Agregar nuevo Servicios',
			'icono'	=> 'mdi-account-plus',
			'subtitulo' 	=> 'Ingrese los datos del nuevo Servicio a atender',
			'btn_guardar' => 'Agregar Servicio'
		];
		$data['resultado'] = [
			'id'				=> '0',
			'descripcion'			=> '',
			'descripcion_servicio'	=> '',
			'encargado_servicio_id'	=> '0',
			'nombre_encargado_servicio'	=> '',
		];
		$data['funcionarios'] = $this->obtenerFuncionarios();
		return view('MA_servicios/formulario', $data);
	}

	public function agregarRegistroGuardar(){
		$descripcion 			= $this->request->getPost('txt_descripcion');
		$descripcion_servicio	= $this->request->getPost('txt_descripcion_servicio');
		$encargado_servicio_id	= $this->request->getPost('val_encargado_servicio_id');
		$nombre_encargado_servicio 	= $this->request->getPost('txt_nombre_encargado_servicio');
		$servicios = [
			'descripcion' 		=> $descripcion,
			'descripcion_servicio'	=> $descripcion_servicio,
			'encargado_servicio_id'	=> $encargado_servicio_id,
			'nombre_encargado_servicio'	=> $nombre_encargado_servicio,
		];
		if($resultado = $this->ma_servicios_model->agregarRegistro($servicios)){
			$id = $resultado;
			$row = $this->obtenerRegistroPorId($id);
				$row = $row[0];
			$data = [
				'status' => 'SUCCESS',
				'id' => $id,
				'servicio' => $row['descripcion'] . ' ' . $row['descripcion_servicio']
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
			'titulo' 	=> 'Editar Servicio',
			'icono'	=> 'mdi-account-edit',
			'subtitulo' 	=> 'Actualizar los datos del nuevo Servicio a atender',
			'btn_guardar' => 'Actualizar Servicios'
		];
		$resultado = $this->obtenerRegistroPorId($id);
		$row = $resultado[0];
		$data['resultado'] = [
			'id'	=> $id,
			'descripcion'			=> $row['descripcion'],
			'descripcion_servicio'	=> $row['descripcion_servicio'],
 			'encargado_servicio_id' 	=> $row['encargado_servicio_id'],
			'nombre_encargado_servicio'	=> $row['nombre_encargado_servicio'],
		];
		$data['funcionarios'] = $this->obtenerFuncionarios();
		return view('MA_servicios/formulario', $data);
	}


	public function editarRegistroGuardar(){
		$id_servicio			= $this->request->getPost('hf_id_servicio');
		$descripcion			= $this->request->getPost('txt_descripcion');
		$descripcion_servicio	= $this->request->getPost('txt_descripcion_servicio');
		$encargado_servicio_id 	= $this->request->getPost('val_encargado_servicio_id');
		$nombre_encargado_servicio 	= $this->request->getPost('txt_nombre_encargado_servicio');
		$servicios = [
			'descripcion' 		=> $descripcion,
			'descripcion_servicio'	=> $descripcion_servicio,
			'encargado_servicio_id'	=> $encargado_servicio_id,
			'nombre_encargado_servicio'	=> $nombre_encargado_servicio,
		];
		if($resultado = $this->ma_servicios_model->editarRegistro($id_servicio, $servicios)){
			$data = [
				'status' => 'SUCCESS',
				'id' => $id_servicio,
				'servicio' => $servicios['descripcion'] . ' ' . $servicios['descripcion_servicio']
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
			'servicio' => $row['descripcion'] . ' ' . $row['descripcion_servicio']
		];
		$json_data = json_encode($data);
		echo $json_data;
	}

	public function eliminarRegistro(){
		$id = $this->request->getPost('id');
		$resultado = $this->obtenerRegistroPorId($id);
		$row = $resultado[0];
		if($rs = $this->ma_servicios_model->eliminarRegistro($id)){
			$data = [
				'status' => 'SUCCESS',
				'servicio' => $row['descripcion'] . ' ' . $row['descripcion_servicio']
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
