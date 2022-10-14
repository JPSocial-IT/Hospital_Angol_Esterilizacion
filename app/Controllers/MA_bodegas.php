<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MA_bodegasModel;

class MA_bodegas extends BaseController
{	
	protected $ma_bodegas_model;

	public function __construct(){
		$this->session = \Config\Services::session();
        	$this->session->start();
		// $this->mantenedor_demo_model = new MantenedorDemoModel();
		$this->ma_bodegas_model = new MA_bodegasModel();
	}

	public function index(){
		$session_datos_usuario = $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado = $this->session->get("menu_usuario_logeado");
		$data = [
			/* 'title_meta' => view('partials/title-meta', ['title' => 'Mantenedor Demo']),
			'page_title' => view('partials/page-title', ['title' => 'Mantenedor Demo', 'pagetitle' => 'Mantenedor Demo']), */
			'title_meta' => view('partials/title-meta', ['title' => 'Mantenedor Bodegas']),
			'page_title' => view('partials/page-title', ['title' => 'Mantenedor Bodegas', 'pagetitle' => 'Mantenedor Bodegas']),
			'session_datos_usuario'	=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'	=> json_decode($menu_usuario_logeado, false)
		];
		// return view('MantenedorDemo/index', $data);
		return view('MA_bodegas/index', $data);
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
		$ma_bodegas_model = $this->ma_bodegas_model->obtenerRegistros();
		/* for($i=0; $i < count($ma_estado_solicitud_model); $i++){
			$fecha = date('d-m-Y', strtotime($ma_estado_solicitud_model[$i]['FechaRegistro']));
			$hora = date('H:i:s', strtotime($ma_estado_solicitud_model[$i]['FechaRegistro']));
			$ma_estado_solicitud_model[$i]['FechaRegistro'] = $fecha . ' ' . $hora;
		} */
		$data = ['registros' => $ma_bodegas_model];
		return view('ma_bodegas/tabla_datos', $data);
	}


	public function obtenerRegistroPorId($id){
		// $resultado = $this->mantenedor_demo_model->obtenerRegistroPorId($id);
		$resultado = $this->ma_bodegas_model->obtenerRegistroPorId($id);
		return $resultado;
	}

	public function obtenerFuncionarios(){
		$funcionarios= $this->ma_bodegas_model->obtenerFuncionarios();
		return $funcionarios;
	}

	public function agregarRegistro(){
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
		return view('MA_bodegas/formulario', $data);
	}

	public function agregarRegistroGuardar(){
		$descripcion 		= $this->request->getPost('txt_descripcion');
		$comentario	 	= $this->request->getPost('txt_comentario');
		$encargado_id	 	= $this->request->getPost('val_encargado_id');
		$encargado_nombre 	= $this->request->getPost('txt_encargado_nombre');
		$bodegas = [
			'descripcion' 	=> $descripcion,
			'comentario'		=> $comentario,
			'encargado_id'	=> $encargado_id,
			'encargado_nombre'	=> $encargado_nombre,
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
		if($resultado = $this->ma_bodegas_model->agregarRegistro($bodegas)){
			$id = $resultado;
			$row = $this->obtenerRegistroPorId($id);
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


	public function editarRegistro($id){
		$data['formulario'] = [
			'accion' 	=> '2',
			'titulo' 	=> 'Editar Bodega Esterilización',
			'icono'	=> 'mdi-account-edit',
			'subtitulo' 	=> 'Actualice los datos de la Bodega de Esterilización seleccionada',
			'btn_guardar' => 'Actualizar Bodega'
		];
		$resultado = $this->obtenerRegistroPorId($id);
		$row = $resultado[0];
		$data['resultado'] = [
			'id'	=> $id,
			'descripcion'		=> $row['descripcion'],
			'comentario'		=> $row['comentario'],
 			'encargado_id' 	=> $row['encargado_id'],
			'encargado_nombre'	=> $row['encargado_nombre'],
			/*'apellido_m' => $row['ApellidoMaterno'],
			'email' => $row['Email'] */
		];
		$data['funcionarios'] = $this->obtenerFuncionarios();
		return view('MA_bodegas/formulario', $data);
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
		$id_bodega		= $this->request->getPost('hf_id_bodega');
		$descripcion		= $this->request->getPost('txt_descripcion');
		$comentario	 	= $this->request->getPost('txt_comentario');
		$encargado_id	 	= $this->request->getPost('val_encargado_id');
		$encargado_nombre 	= $this->request->getPost('txt_encargado_nombre');
		/* $apellido_p 	= $this->request->getPost('txt_apellido_p');
		$apellido_m 	= $this->request->getPost('txt_apellido_m');
		$email 			= $this->request->getPost('txt_email'); */
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
			'bodega' => $row['descripcion'] . ' ' . $row['comentario']
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

}


