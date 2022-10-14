<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MA_areasModel;

class MA_areas extends BaseController
{	
	protected $ma_areas_model;

	public function __construct(){
		$this->session = \Config\Services::session();
        	$this->session->start();
		$this->ma_areas_model = new MA_areasModel();
	}

	public function index(){
		$session_datos_usuario = $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado = $this->session->get("menu_usuario_logeado");
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Mantenedor de Áreas']),
			'page_title' => view('partials/page-title', ['title' => 'Mantenedor de Áreas', 'pagetitle' => 'Mantenedor de Áreas']),
			'session_datos_usuario'	=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'	=> json_decode($menu_usuario_logeado, false)
		];
		return view('MA_areas/index', $data);
	}

	public function obtenerTablaRegistros(){
		$ma_areas_model = $this->ma_areas_model->obtenerRegistros();
		$data = ['registros' => $ma_areas_model];
		return view('MA_areas/tabla_datos', $data);
	}

	public function obtenerRegistroPorId($id){
		$resultado = $this->ma_areas_model->obtenerRegistroPorId($id);
		return $resultado;
	}

	public function obtenerFuncionarios(){
		$funcionarios= $this->ma_areas_model->obtenerFuncionarios();
		return $funcionarios;
	}

	public function agregarRegistro(){
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
		return view('MA_areas/formulario', $data);
	}

	public function agregarRegistroGuardar(){
		$nombre 		= $this->request->getPost('txt_nombre');
		$descripcion		= $this->request->getPost('txt_descripcion');
		$id_encargado		= $this->request->getPost('val_id_encargado');
		$nombre_encargado 	= $this->request->getPost('txt_nombre_encargado');
		$areas = [
			'nombre' 		=> $nombre,
			'descripcion'		=> $descripcion,
			'id_encargado'	=> $id_encargado,
			'nombre_encargado'	=> $nombre_encargado,
		];
		if($resultado = $this->ma_areas_model->agregarRegistro($areas)){
			$id = $resultado;
			$row = $this->obtenerRegistroPorId($id);
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


	public function editarRegistro($id){
		$data['formulario'] = [
			'accion' 	=> '2',
			'titulo' 	=> 'Editar Área del Servicio',
			'icono'	=> 'mdi-account-edit',
			'subtitulo' 	=> 'Actualizar los datos de Área de Servicio',
			'btn_guardar' => 'Actualizar Áreas'
		];
		$resultado = $this->obtenerRegistroPorId($id);
		$row = $resultado[0];
		$data['resultado'] = [
			'id'	=> $id,
			'nombre'		=> $row['nombre'],
			'descripcion'		=> $row['descripcion'],
 			'id_encargado' 	=> $row['id_encargado'],
			'nombre_encargado'	=> $row['nombre_encargado'],
		];
		$data['funcionarios'] = $this->obtenerFuncionarios();
		return view('MA_areas/formulario', $data);
	}


	public function editarRegistroGuardar(){
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


	public function eliminarRegistroConfirmar($id){
		$resultado = $this->obtenerRegistroPorId($id);
			$row = $resultado[0];
			$data = [
			'status' => 'SUCCESS',
			'area' => $row['nombre'] . ' ' . $row['descripcion']
		];
		$json_data = json_encode($data);
		echo $json_data;
	}

	public function eliminarRegistro(){
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

}
