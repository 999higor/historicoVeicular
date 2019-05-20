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
		if(!empty($this->session->userdata('cpf'))){
			$this->load->view('cadVeiculoView');
		}else{
			$data = array("message" => "Você precisa estar logado para acessar o cadastro.", "status" => 2);
			$this->load->view('loginView', $data);
		}
	}

	public function CadastraVeiculo(){
			$id = $this->input->post('id', TRUE);
			$marca = $this->input->post('marca_', TRUE);
            $modelo = $this->input->post('modelo_', TRUE);
            $ano = $this->input->post('anof', TRUE);
            $anoModelo = $this->input->post('anoMod', TRUE);
            $renavam = $this->input->post('renavam', TRUE);
			$placa = $this->input->post('placa', TRUE);

			$this->load->model('cadVeiculoModel');

			$dados = array(
				'placa' => $placa,
				'renavam' => $renavam,
				'marca' => $marca,
				'modelo' => $modelo,
				'anoModelo' => $anoModelo,
				'anoFabricacao' => $ano,
				'idCliente' => $id
			); 

			if($this->cadVeiculoModel->EfetuaRegistroVeiculo($dados)){
					$data = array("message" => "Veículo cadastrado com sucesso.","status" => 1);
					$this->load->view('MainView', $data);
				}else{
					$data = array("message" => "Erro ao cadastrar veículo.", "status" => 2);
					$this->load->view('MainView', $data);
				}
      }
}

