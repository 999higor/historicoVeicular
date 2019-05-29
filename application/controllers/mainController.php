<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->helper('url');
		$this->load->model('mainModel');
	}
	
	public function index()
	{ 
		if(empty($this->session->userdata('cpf'))){
			$data = array("message" => "Você precisa estar logado.", "status" => 2);
			$this->load->view('loginView', $data);
		}else{			
			$id = $this->session->userdata('idcliente');
			$this->populaDataTable($id);
		}
	}

	function logout()
	{
		$this->session->unset_userdata('cpf');
		redirect(base_url().'index.php/LoginController');
	}

	public function populaDataTable($id)
	{
		$data['veiculo'] = $this->mainModel->populaTabela($id);
		if(!empty($data['veiculo']))
		{
			$this->load->view('MainView', $data);
		}else
			$data = array("message" => "Nenhum veículo cadastrado", "status" => 3);
			$this->load->view('MainView', $data);
	}
}
