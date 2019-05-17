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
			$this->load->view('loginView');
		}else{			
			$id = $this->session->userdata('idcliente');
			$this->populaDataTable($id);
		}
	}

	public function verificaVeiculo($id)
	{ 
		return $this->mainModel->verificaVeiculo($id);
	}

	function logout()
	{
		$this->session->unset_userdata('cpf');
		redirect(base_url().'index.php/LoginController');
	}

	public function populaDataTable($id)
	{
		if($this->verificaVeiculo($id))
		{
			$data['veiculo'] = $this->mainModel->populaTabela($id);
			$this->load->view('MainView', $data);
		}else
			$this->load->view('MainView', $data);
	}
}
