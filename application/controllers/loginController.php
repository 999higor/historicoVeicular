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
				}

				/* cria um array chamado SESSION para colocar os dados */
				$SESSION = array( 'nome' => $nome,
								  'sobrenome' => $sobrenome,
								  'id' => $id,
								  'cpf' => $cpf);
	
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
			redirect(base_url().'index.php/MainController');
		}else{
			/* se der erro retorna uma mensagem com erro na autenticação */
			$data = array("message" => "Campo CPF ou Senha incorretos.", "status" => 2);
			$this->load->view('LoginView', $data);
		}
	}
}
