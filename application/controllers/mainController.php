<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->helper('url');
		$this->load->model('mainModel');
		$this->load->library('form_validation');
	}
	
	public function index()
	{ 
		/* Se não tiver uma session(deslogado) com o CPF retorna pra tela de login com uma mensagem */
		if(empty($this->session->userdata('cpf'))){
			$data = array("message" => "Você precisa estar logado.", "status" => 2);
			$this->load->view('loginView', $data);
		}else{			
			/* Chama método populaDataTable pra mostrar a tabela */
			$id = $this->session->userdata('id');
			$this->populaDataTable($id);
		}
	}

	function logout()
	{
		/* Destroi a session e redireciona pra tela de login */
		$this->session->unset_userdata('cpf');
		redirect(base_url().'index.php/LoginController');
	}

	public function populaDataTable($id)
	{
		$data['veiculo'] = $this->mainModel->populaTabela($id);
		/* Chama o método populaTabela no Model, caso o retorno não for vazio carrega a tela principal com a tabela */
		if(!empty($data['veiculo']))
		{
			$this->load->view('MainView', $data);
		}else{
			/* Se o valor retornado do model for vazio significa que não existe nenhum registro para este usuário
					- Retorna mensagem para a tela principal                                                   */
			$data = array("message" => "Nenhum veículo cadastrado", "status" => 3);
			$this->load->view('MainView', $data);
		}
	}
}
