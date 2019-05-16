<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class loginController extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->helper('url');
	}
	public function index()
	{
		$this->load->view('loginView');
	}

	function verificaLogin(){
		/* https://www.youtube.com/watch?v=pG1rOs8vz1Q */
		$this->load->library('form_validation');
		$this->form_validation->set_rules('cpfLogin','CPF','required');
		$this->form_validation->set_rules('passwrd','Senha','required');

		if($this->form_validation->run()){
			//validou certo
			$cpf = $this->input->post('cpfLogin');
			$senha = $this->input->post('passwrd');

			$this->load->model('loginModel');
			if($this->loginModel->verificaLogin($cpf, $senha)){
				$session_data = array(
					'cpf' => $cpf
				);
				$this->session->set_userdata($session_data);
				
				/* chama a função login aqui no mesmo controller */
				redirect(base_url(). 'login');
			}else{
				$this->session->set_flashdata('error', 'CPF ou Senha incorretos.');
				redirect(base_url(). 'loginView');
			}
		}else{
			//deu erro na validação/regras
			$this->index();
		}
	}

	function login(){
		if($this->session->userdata('cpf') != ''){
			redirect(base_url().'mainView');
		}else{
			redirect(base_url().'loginController/index');
		}
	}
}

