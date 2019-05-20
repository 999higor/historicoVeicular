<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cadVeiculoController extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->helper('url');
	}
	public function index()
	{	
		$this->load->view('cadVeiculoView');
	}

	public function CadastraVeiculo(){

			$marca = $this->input->post('marca_', TRUE);
            $veiculo = $this->input->post('modelo_', TRUE);
            $ano = $this->input->post('anof', TRUE);
            $anoModelo = $this->input->post('anoMod', TRUE);
            $renavam = $this->input->post('renavam', TRUE);
			$placa = $this->input->post('placa', TRUE);

			echo $marca, $veiculo, $ano,$anoModelo,$renavam,$placa;
			
			// $this->load->model('cadVeiculoModel');

			// if($password == $confirmPassword){
			// 	$dados = array(
			// 		'nome' => $nome ,
			// 		'sobrenome' => $sobrenome,
			// 		'rg' => $cpf,
			// 		'cpf' => $rg,
			// 		'senha' => $email,
			// 		'email' => $password
			// 	);  

			// 	if($this->cadUsuarioModel->EfetuaRegistro($dados)){
			// 		$data = array("message" => "Usuário criado com sucesso.","status" => 1);
			// 		$this->load->view('loginView', $data);
			// 	}else{
			// 		$data = array("message" => "Erro ao criar usuário.", "status" => 2);
			// 		$this->load->view('loginView', $data);
			// 	}
			// }
        }
}

