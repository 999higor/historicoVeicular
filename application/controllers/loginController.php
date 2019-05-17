<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->helper('url');
	}
	public function index()
	{
		$this->load->view('loginView');
	}

	public function verificaLogin(){
		/* https://www.youtube.com/watch?v=pG1rOs8vz1Q */

		$this->load->library('form_validation');

		$this->form_validation->set_rules('cpfLogin','CPF','required');
		$this->form_validation->set_rules('passwrd','Senha','required');

		$cpf = $this->input->post('cpfLogin', TRUE);
		$senha = $this->input->post('passwrd', TRUE);
		/* validar formulario */
		if($this->form_validation->run()){
			$cpf = $this->input->post('cpfLogin', TRUE);
			$senha = $this->input->post('passwrd', TRUE);
			
			$this->load->model('loginModel');

			/* se for valido chama função do banco para comparar as senhas */
			if($this->loginModel->verificaLogin($cpf,$senha)){
				/* -> se estiver ok abre uma session com o cpf */
				$SESSION = array('cpf' => $cpf);
				$this->session->set_userdata($SESSION);

				/* redireciona pra pagina principal */
				redirect(base_url() . 'index.php/LoginController/login');

			}else{
				/* se der erro retorna uma mensagem com erro na autenticação */
				$this->session->set_flashdata('error','CPF ou Senha inválidos.');

				/* redireciona pra pagina de login com as mensagens */
				redirect(base_url() . 'index.php/LoginController/login');
			}
		}else{
			/* se os campos digitados forem invalidos retorna uma mensagem de erro de validação (senha/cpf devem ser preenchidos, somente números, etc...) */
			/*redireciona pra tela de login */
			redirect(base_url().'index.php/LoginController/login');
		}
	}

	function login(){
		if($this->session->userdata('cpf') != ''){
			redirect(base_url().'index.php/MainController');

		}else{
			redirect(base_url().'index.php/LoginController');
		}
	}

	function logout(){
		$this->session->unset_userdata('cpf');
		redirect(base_url().'index');
	}
}

