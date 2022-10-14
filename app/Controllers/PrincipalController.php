<?php namespace App\Controllers;

use App\Controllers\BaseController;

class PrincipalController extends BaseController
{	
    protected $session;

	public function __construct()
	{
        $this->session = \Config\Services::session();
        $this->session->start();
	}

	public function index()
	{
		$session_datos_usuario = $this->session->get("datos_usuario_logeado");
		$menu_usuario_logeado = $this->session->get("menu_usuario_logeado");

		$data = [
			'title_meta' 			=> view('partials/title-meta', ['title' => 'Principal']),
			'page_title' 			=> view('partials/page-title', ['title_meta' => 'Principal', 'title' => 'Principal', 'pagetitle' => 'Principal']),
			'session_datos_usuario'	=> json_decode($session_datos_usuario, false),
			'menu_usuario_logeado'	=> json_decode($menu_usuario_logeado, false)
		];
		return view('principal_page', $data);
	}
}
