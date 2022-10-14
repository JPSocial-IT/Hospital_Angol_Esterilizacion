<?php namespace App\Controllers;

use App\Controllers\BaseController;
// use App\Models\MantenedorDemoModel;
use App\Models\MA_estado_solicitudModel;


// class MantenedorDemo extends BaseController
class MA_estado_solicitud extends BaseController
{	
	// protected $mantenedor_demo_model;
	protected $ma_estado_solicitud_model;

	public function __construct(){
		$this->session = \Config\Services::session();
        	$this->session->start();
		// $this->mantenedor_demo_model = new MantenedorDemoModel();
		$this->ma_estado_solicitud_model = new MA_estado_solicitudModel();
	}


	public function index(){
		$session_datos_usuario = $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado = $this->session->get("menu_usuario_logeado");
		$data = [
			/* 'title_meta' => view('partials/title-meta', ['title' => 'Mantenedor Demo']),
			'page_title' => view('partials/page-title', ['title' => 'Mantenedor Demo', 'pagetitle' => 'Mantenedor Demo']), */
			'title_meta' => view('partials/title-meta', ['title' => 'Mantenedor Estados Solicitudes']),
			'page_title' => view('partials/page-title', ['title' => 'Mantenedor Estados Solicitudes', 'pagetitle' => 'Mantenedor Estados Solicitudes']),
			'session_datos_usuario'	=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'	=> json_decode($menu_usuario_logeado, false)
		];
		// return view('MantenedorDemo/index', $data);
		return view('MA_estado_solicitud/index', $data);
	}


	public function obtenerTablaRegistros(){
		/* $mantenedor_demo_model = $this->mantenedor_demo_model->obtenerRegistros();
		for($i=0; $i < count($mantenedor_demo_model); $i++){
			$fecha = date('d-m-Y', strtotime($mantenedor_demo_model[$i]['FechaRegistro']));
			$hora = date('H:i:s', strtotime($mantenedor_demo_model[$i]['FechaRegistro']));
			$mantenedor_demo_model[$i]['FechaRegistro'] = $fecha . ' ' . $hora;
		}
		$data = ['registros' => $mantenedor_demo_model];
		return view('MantenedorDemo/tabla_datos', $data); */
		$ma_estado_solicitud_model = $this->ma_estado_solicitud_model->obtenerRegistros();
		/* for($i=0; $i < count($ma_estado_solicitud_model); $i++){
			$fecha = date('d-m-Y', strtotime($ma_estado_solicitud_model[$i]['FechaRegistro']));
			$hora = date('H:i:s', strtotime($ma_estado_solicitud_model[$i]['FechaRegistro']));
			$ma_estado_solicitud_model[$i]['FechaRegistro'] = $fecha . ' ' . $hora;
		} */
		$data = ['registros' => $ma_estado_solicitud_model];
		return view('MA_estado_solicitud/tabla_datos', $data);
	}


	public function obtenerRegistroPorId($id){
		// $resultado = $this->mantenedor_demo_model->obtenerRegistroPorId($id);
		$resultado = $this->ma_estado_solicitud_model->obtenerRegistroPorId($id);
		return $resultado;
	}

	public function agregarRegistro(){
		$data['formulario'] = [
		/* 	'accion' 		=> '1',
			'titulo' 		=> 'Agregar Usuario',
			'icono'		 	=> 'mdi-account-plus',
			'subtitulo' 	=> 'Ingrese los datos del nuevo usuario',
			'btn_guardar' 	=> 'Agregar Usuario' */
			'accion' 	=> '1',
			'titulo' 	=> 'Agregar Estado de Solicitud',
			'icono'	=> 'mdi-account-plus',
			'subtitulo' 	=> 'Ingrese los datos del nuevo Estado',
			'btn_guardar' => 'Agregar Estado'
		];
		/* $data['usuario'] = [
			'id' => '0',
			'rut' => '',
			'nombre' => '',
			'apellido_p' => '',
			'apellido_m' => '',
			'email' => '' */
		$data['resultado'] = [
			'id'			=> '0',
			'descripcion'		=> '',
			'descripcion_estado'	=> '',
		];
		// return view('MantenedorDemo/formulario', $data);
		return view('MA_estado_solicitud/formulario', $data);
	}

	public function agregarRegistroGuardar(){
		/* $rut 		= $this->request->getPost('txt_rut');
		$nombre 	= $this->request->getPost('txt_nombre');
		$apellido_p = $this->request->getPost('txt_apellido_p');
		$apellido_m = $this->request->getPost('txt_apellido_m');
		$email 		= $this->request->getPost('txt_email');
		$usuario = [
			'Rut' 				=> $rut,
			'Nombre' 			=> $nombre,
			'ApellidoPaterno' 	=> $apellido_p,
			'ApellidoMaterno' 	=> $apellido_m,
			'Email' 			=> $email,
			'FechaRegistro' 	=> date_create('now')->format('Y-m-d H:i:s'),
			'Activo' 			=> 't' */
		$descripcion 		= $this->request->getPost('txt_descripcion');
		$descripcion_estado 	= $this->request->getPost('txt_descripcion_estado');
		$estado_solicitud = [
			'descripcion' 	=> $descripcion,
			'descripcion_estado'	=> $descripcion_estado,
		];
		/* if($resultado = $this->mantenedor_demo_model->agregarRegistro($usuario)){
			$id_usuario = $resultado;
			$row = $this->obtenerRegistroPorId($id_usuario);
				$row = $row[0];
			$data = [
				'status' => 'SUCCESS',
				'id' => $id_usuario,
				'nombreUsuario' => $row['Nombre'] . ' ' . $row['ApellidoPaterno'] . ' ' . $row['ApellidoMaterno']
			];
		}
		else{
			$data = [
				'status' => 'ERROR',
				'error' => 'Error desconocido al insertar nuevo registro'
			];
		} */
		if($resultado = $this->ma_estado_solicitud_model->agregarRegistro($estado_solicitud)){
			$id = $resultado;
			$row = $this->obtenerRegistroPorId($id);
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


	public function editarRegistro($id){
/* 		$data['formulario'] = [
			'accion' 		=> '2',
			'titulo' 		=> 'Editar Usuario',
			'icono'		 	=> 'mdi-account-edit',
			'subtitulo' 	=> 'Actualice los datos del usuario seleccionado',
			'btn_guardar' 	=> 'Editar Usuario'
		];
		$usuario = $this->obtenerRegistroPorId($id);
		$row = $usuario[0];
		$data['usuario'] = [
			'id' => $id,
			'rut' => $row['Rut'],
			'nombre' => $row['Nombre'],
			'apellido_p' => $row['ApellidoPaterno'],
			'apellido_m' => $row['ApellidoMaterno'],
			'email' => $row['Email']
		];
		return view('MantenedorDemo/formulario', $data); */
		$data['formulario'] = [
			'accion' 	=> '2',
			'titulo' 	=> 'Editar Estados de Solicitudes',
			'icono'	=> 'mdi-account-edit',
			'subtitulo' 	=> 'Actualice los datos del Estado de Solicitud seleccionado',
			'btn_guardar' => 'Actualizar Estado'
		];
		$resultado = $this->obtenerRegistroPorId($id);
		$row = $resultado[0];
		$data['resultado'] = [
			'id'	=> $id,
			'descripcion'	=> $row['descripcion'],
			'descripcion_estado'	=> $row['descripcion_estado']
/* 			'nombre' => $row['Nombre'],
			'apellido_p' => $row['ApellidoPaterno'],
			'apellido_m' => $row['ApellidoMaterno'],
			'email' => $row['Email'] */
		];
		return view('MA_estado_solicitud/formulario', $data);
	}


	public function editarRegistroGuardar(){
/* 		$id_usuario 	= $this->request->getPost('hf_id_usuario');
        	$rut 			= $this->request->getPost('txt_rut');
		$nombre 		= $this->request->getPost('txt_nombre');
		$apellido_p 	= $this->request->getPost('txt_apellido_p');
		$apellido_m 	= $this->request->getPost('txt_apellido_m');
		$email 			= $this->request->getPost('txt_email');
		$usuario = [
			'Rut' 				=> $rut,
			'Nombre' 			=> $nombre,
			'ApellidoPaterno' 	=> $apellido_p,
			'ApellidoMaterno' 	=> $apellido_m,
			'Email' 			=> $email
		];
		if($resultado = $this->mantenedor_demo_model->editarRegistro($id_usuario, $usuario)){
        	$data = [
        		'status' => 'SUCCESS',
        		'id' => $id_usuario,
        		'nombreUsuario' => $usuario['Nombre'] . ' ' . $usuario['ApellidoPaterno'] . ' ' . $usuario['ApellidoMaterno']
        	];
        }
        else{
        	$data = [
        		'status' => 'ERROR',
        		'error' => 'Error desconocido al editar usuario seleccionado'
        	];
        } */
		$id_estado		= $this->request->getPost('hf_id_estado');
		$descripcion		= $this->request->getPost('txt_descripcion');
		$descripcion_estado 	= $this->request->getPost('txt_descripcion_estado');
		/* $apellido_p 	= $this->request->getPost('txt_apellido_p');
		$apellido_m 	= $this->request->getPost('txt_apellido_m');
		$email 			= $this->request->getPost('txt_email'); */
		$estado_solicitud = [
			'descripcion' 	=> $descripcion,
			'descripcion_estado'	=> $descripcion_estado
		];
		if($resultado = $this->ma_estado_solicitud_model->editarRegistro($id_estado, $estado_solicitud)){
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


	public function eliminarRegistroConfirmar($id){
		/* $resultado = $this->obtenerRegistroPorId($id);
		$row = $resultado[0];
		$data = [
        	'status' => 'SUCCESS',
        	'nombreUsuario' => $row['Nombre'] . ' ' . $row['ApellidoPaterno'] . ' ' . $row['ApellidoMaterno']
        ]; */
		$resultado = $this->obtenerRegistroPorId($id);
			$row = $resultado[0];
			$data = [
			'status' => 'SUCCESS',
			'nombre_estado' => $row['descripcion'] . ' ' . $row['descripcion_estado']
		];
		$json_data = json_encode($data);
		echo $json_data;
	}


	public function eliminarRegistro(){
		$id = $this->request->getPost('id');
		$resultado = $this->obtenerRegistroPorId($id);
		$row = $resultado[0];
/* 		if($rs = $this->mantenedor_demo_model->eliminarRegistro($id)){
			$data = [
				'status' => 'SUCCESS',
				'usuarioEliminado' => $row['Nombre'] . ' ' . $row['ApellidoPaterno'] . ' ' . $row['ApellidoMaterno']
        	];
        	}
        	else{
			$data = [
				'status' => 'ERROR',
				'error' => 'Error desconocido al eliminar usuario seleccionado'
        	]; */
		if($rs = $this->ma_estado_solicitud_model->eliminarRegistro($id)){
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

}


