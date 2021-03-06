<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class LoginController extends CI_Controller {
	public function __construct()
	{
		parent:: __construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->load->view('loginView');
	}

	function logout()
	{
		/* Destroi a session e redireciona pra tela de login */
		$this->session->unset_userdata('cpf');
		redirect(base_url().'index.php/LoginController');
	}

	public function verificaLogin(){
		/* https://www.youtube.com/watch?v=pG1rOs8vz1Q */
		$this->form_validation->set_message('numeric', 'Digite apenas números.');
		$this->form_validation->set_rules('cpfLogin', 'CPF', 'numeric');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('loginView');
		}
		else
		{
			$cpf = $this->input->post('cpfLogin', TRUE);
			$senha = $this->input->post('passwrd', TRUE);

			$this->load->model('loginModel');
			if($this->loginModel->verificaLogin($cpf,$senha)){
				
				/* busca os dados para coolocar na session (nome, sobrenome e id) */
				foreach ($this->loginModel->getDados($cpf) as $dados)
				{
					$nome = $dados['nome'];
					$sobrenome = $dados['sobrenome'];
					$id = $dados['id'];
					$email = $dados['email'];
				}

				/* cria um array chamado SESSION para colocar os dados */
				$SESSION = array( 'nome' => $nome,
								  'sobrenome' => $sobrenome,
								  'id' => $id,
								  'cpf' => $cpf,
								  'email' => $email
								);
	
				/*insere o array na sessiona */
				$this->session->set_userdata($SESSION);
	
				/* redireciona pra pagina principal */
				redirect(base_url() . 'index.php/LoginController/login');
			}else{
				/* redireciona pra pagina de login com as mensagens */
				redirect(base_url() . 'index.php/LoginController/login');
			}
		}
	}
	function login(){
		if($this->session->userdata('cpf') != ''){
			//redirect(base_url().'index.php/MainController');
			$this->load->view('templates/headerView');
			$this->load->view('templates/footerView');
		}else{
			/* se der erro retorna uma mensagem com erro na autenticação */
			$data = array("message" => "Campo CPF ou Senha incorretos.", "status" => 2);
			$this->load->view('LoginView', $data);
		}
	}
}
