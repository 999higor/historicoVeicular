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

			$cpf = $this->input->post('cpfLogin', TRUE);
			$senha = $this->input->post('passwrd', TRUE);

			$this->load->model('loginModel');

			if($this->loginModel->verificaLogin($cpf,$senha)){
				/* -> se estiver ok abre uma session com o cpf */

				//salvar idcliente na session
				$id = $this->loginModel->getID($cpf);
				
				$SESSION = array('cpf' => $cpf , 'idcliente' => $id );
				$this->session->set_userdata($SESSION);

				/* redireciona pra pagina principal */
				redirect(base_url() . 'index.php/LoginController/login');

			}else{
				/* se der erro retorna uma mensagem com erro na autenticação */
				$erro=  $this->db->last_query();
				$this->session->set_flashdata('error',$erro);

				/* redireciona pra pagina de login com as mensagens */
				redirect(base_url() . 'index.php/LoginController/login');
			}
	}

	function login(){
		if($this->session->userdata('cpf') != ''){
			redirect(base_url().'index.php/MainController');

		}else{
			redirect(base_url().'index.php/LoginController');
		}
	}

	// function logout(){
	// 	$this->session->unset_userdata('cpf');
	// 	redirect(base_url().'index');
	// }
}

