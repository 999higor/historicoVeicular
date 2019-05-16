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

		/* passos -> validar formulario
				  -> se for valido chama função do banco para comparar as senhas
						  -> se estiver ok abre uma session com o cpf
						  		-> redireciona pra pagina principal
						  -> se der erro retorna uma mensagem com erro na autenticação
						  		-> redireciona pra pagina de login com as mensagens
				  -> se for invalido retorna mensagem de erro de validação (senha/cpf devem ser preenchidos...)
				  		  		-> redireciona pra tela de login
		*/

	}

	function login(){
		if($this->session->userdata('cpf') != ''){
			redirect(base_url().'mainView');
		}else{
			redirect(base_url().'index');
		}
	}
}

