<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EntregaTurnoModel;

class EntregaTurno extends BaseController
{	
	protected $entrega_turno_model;

	public function __construct()
	{
		$this->entrega_turno_model = new EntregaTurnoModel();
	}

	public function index()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Entrega Turno']),
			'page_title' => view('partials/page-title', ['title' => 'Entrega Turno', 'pagetitle' => 'Entrega Turno'])
		];
		
		return view('EntregaTurno/index', $data);
	}
	
	public function obtenerTablaDatos()
	{
		$entrega_turno_model = $this->entrega_turno_model->obtenerDatos();

		$data = [
			'datos' => $entrega_turno_model
		];

		return view('EntregaTurno/tabla_datos', $data);
	}

	public function insertarDatos()
	{
		$comentario = $this->request->getPost('comentario');	

		$data = [
			'comentario' => $comentario
		];

		$resultado = $this->entrega_turno_model->insertarDatos($data);
		return $resultado;
	}
	

	public function actualizarDatosPorId()
	{
		$id = $this->request->getPost('id');	
		$comentario = $this->request->getPost('comentario');	

		$data = [
			'comentario' => $comentario
		];

		$resultado = $this->entrega_turno_model->actualizarDatosPorId($id, $data);
		return $resultado;
	}
	

	public function eliminarDatosPorId()
	{
		$id = $this->request->getPost('id');	

		$resultado = $this->entrega_turno_model->eliminarDatosPorId($id);
		return $resultado;
	}
}
