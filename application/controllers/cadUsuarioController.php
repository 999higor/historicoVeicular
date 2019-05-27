<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cadUsuarioController extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->helper('form','url');
		$this->load->library('form_validation');
	}
	public function index()
	{
		$this->load->view('cadUsuarioView');
	}

	public function CadastrarUsuario(){

		$this->form_validation->set_rules('nome', 'Username', 'required');
		$this->form_validation->set_rules('sobrenome', 'Password', 'required');
		$this->form_validation->set_rules('cpfUser', 'Password Confirmation', 'required');
		$this->form_validation->set_rules('rguser', 'Email', 'required');
		$this->form_validation->set_rules('email', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
	  $this->form_validation->set_rules('confirmPassword', 'Password Confirmation', 'required');

			$nome = $this->input->post('nome', TRUE);
      $sobrenome = $this->input->post('sobrenome', TRUE);
      $cpf = $this->input->post('cpfUser', TRUE);
      $rg = $this->input->post('rgUser', TRUE);
      $email = $this->input->post('email', TRUE);
      $password = $this->input->post('password', TRUE);
      $confirmPassword = $this->input->post('confirmPassword', TRUE);

			$this->load->model('cadUsuarioModel');

			if(strcmp($password, $confirmPassword) == 0){
				$dados = array(
					'nome' => $nome ,
					'sobrenome' => $sobrenome,
					'rg' => $rg,
					'cpf' => $cpf,
					'senha' => $password,
					'email' => $email
				);

				if($this->cadUsuarioModel->EfetuaRegistro($dados)){
					$data = array("message" => "Usuário criado com sucesso.","status" => 1);
					$this->load->view('loginView', $data);
				}else{
					$data = array("message" => "Erro ao criar usuário.", "status" => 2);
					$this->load->view('loginView', $data);
				}
			}else{
				$data = array("message" => "Erro ao criar usuário.", "status" => 2);
				$this->load->view('loginView', $data);
			}
        }
}


/*$nome = $this->input->post('nome', TRUE);
$sobrenome = $this->input->post('sobrenome', TRUE);
$cpf = $this->input->post('cpfUser', TRUE);
$rg = $this->input->post('rgUser', TRUE);
$email = $this->input->post('email', TRUE);
$password = $this->input->post('password', TRUE);
$confirmPassword = $this->input->post('confirmPassword', TRUE);

$this->load->model('cadUsuarioModel');

if(strcmp($password, $confirmPassword) == 0){
	$dados = array(
		'nome' => $nome ,
		'sobrenome' => $sobrenome,
		'rg' => $rg,
		'cpf' => $cpf,
		'senha' => $password,
		'email' => $email
	);

	if($this->cadUsuarioModel->EfetuaRegistro($dados)){
		$data = array("message" => "Usuário criado com sucesso.","status" => 1);
		$this->load->view('loginView', $data);
	}else{
		$data = array("message" => "Erro ao criar usuário.", "status" => 2);
		$this->load->view('loginView', $data);
	}
}else{
	$data = array("message" => "Erro ao criar usuário.", "status" => 2);
	$this->load->view('loginView', $data);
}
}*/
