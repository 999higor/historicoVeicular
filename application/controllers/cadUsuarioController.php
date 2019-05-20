<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cadUsuarioController extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->helper('url');
	}
	public function index()
	{	
		$this->load->view('cadUsuarioView');
	}

	public function CadastrarUsuario(){

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
					'rg' => $cpf,
					'cpf' => $rg,
					'senha' => $email,
					'email' => $password
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

