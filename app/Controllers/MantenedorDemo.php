<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MantenedorDemoModel;


class MantenedorDemo extends BaseController
{	
	protected $mantenedor_demo_model;

	public function __construct(){
		$this->session = \Config\Services::session();
        $this->session->start();
		$this->mantenedor_demo_model = new MantenedorDemoModel();
	}


	public function index(){
		$session_datos_usuario = $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado = $this->session->get("menu_usuario_logeado");
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Mantenedor Demo']),
			'page_title' => view('partials/page-title', ['title' => 'Mantenedor Demo', 'pagetitle' => 'Mantenedor Demo']),
			'session_datos_usuario'	=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'	=> json_decode($menu_usuario_logeado, false)
		];
		return view('MantenedorDemo/index', $data);
	}


	public function obtenerTablaRegistros(){
		$mantenedor_demo_model = $this->mantenedor_demo_model->obtenerRegistros();
		for($i=0; $i < count($mantenedor_demo_model); $i++){
			$fecha = date('d-m-Y', strtotime($mantenedor_demo_model[$i]['FechaRegistro']));
			$hora = date('H:i:s', strtotime($mantenedor_demo_model[$i]['FechaRegistro']));
			$mantenedor_demo_model[$i]['FechaRegistro'] = $fecha . ' ' . $hora;
		}
		$data = ['registros' => $mantenedor_demo_model];
		return view('MantenedorDemo/tabla_datos', $data);
	}


	public function obtenerRegistroPorId($id){
		$resultado = $this->mantenedor_demo_model->obtenerRegistroPorId($id);
		return $resultado;
	}


	public function agregarRegistro(){
		$data['formulario'] = [
			'accion' 		=> '1',
			'titulo' 		=> 'Agregar Usuario',
			'icono'		 	=> 'mdi-account-plus',
			'subtitulo' 	=> 'Ingrese los datos del nuevo usuario',
			'btn_guardar' 	=> 'Agregar Usuario'
		];
		$data['usuario'] = [
			'id' => '0',
			'rut' => '',
			'nombre' => '',
			'apellido_p' => '',
			'apellido_m' => '',
			'email' => ''
		];
		return view('MantenedorDemo/formulario', $data);
	}


	public function agregarRegistroGuardar(){
		$rut 		= $this->request->getPost('txt_rut');
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
			'Activo' 			=> 't'
		];
        if($resultado = $this->mantenedor_demo_model->agregarRegistro($usuario)){
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
        }
        $json_data = json_encode($data);
        echo $json_data;
	}


	public function editarRegistro($id){
		$data['formulario'] = [
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
		return view('MantenedorDemo/formulario', $data);
	}


	public function editarRegistroGuardar(){
	    $id_usuario 	= $this->request->getPost('hf_id_usuario');
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
        }
        $json_data = json_encode($data);
        echo $json_data;
	}


	public function eliminarRegistroConfirmar($id){
		$resultado = $this->obtenerRegistroPorId($id);
		$row = $resultado[0];
		$data = [
        	'status' => 'SUCCESS',
        	'nombreUsuario' => $row['Nombre'] . ' ' . $row['ApellidoPaterno'] . ' ' . $row['ApellidoMaterno']
        ];
        $json_data = json_encode($data);
        echo $json_data;
	}


	public function eliminarRegistro(){
		$id = $this->request->getPost('id');
		$resultado = $this->obtenerRegistroPorId($id);
		$row = $resultado[0];
		if($rs = $this->mantenedor_demo_model->eliminarRegistro($id)){
        	$data = [
        		'status' => 'SUCCESS',
        		'usuarioEliminado' => $row['Nombre'] . ' ' . $row['ApellidoPaterno'] . ' ' . $row['ApellidoMaterno']
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


