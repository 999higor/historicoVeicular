<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VeiculoController extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
        $this->load->helper('url');
        $this->VerificaSessao();
        $this->load->model('VeiculoModel');
    }

    public function VerificaSessao(){
        if(empty($this->session->userdata('cpf'))){
            $data = array("message" => "Você precisa estar logado para acessar o cadastro.", "status" => 2);
			$this->load->view('loginView', $data);
        }
    }
    
    public function loadCadastraVeiculo(){
        $this->load->view('cadVeiculoView');
    }

    public function loadEditaVeiculo(){

    }

    public function loadVisualizaVeiculos(){

    }

	public function CadastrarVeiculo(){
	    $id = $this->input->post('id', TRUE);
	    $marca = $this->input->post('marca_', TRUE);
        $modelo = $this->input->post('modelo_', TRUE);
        $ano = $this->input->post('anof', TRUE);
        $anoModelo = $this->input->post('anoMod', TRUE);
        $renavam = $this->input->post('renavam', TRUE);
	    $placa = $this->input->post('placa', TRUE);

        $dados = array(
                    'placa' => $placa,
                    'renavam' => $renavam,
                    'marca' => $marca,
                    'modelo' => $modelo,
                    'anoModelo' => $anoModelo,
                    'anoFabricacao' => $ano,
                    'idCliente' => $id
                    );

            if($this->VeiculoModel->EfetuaRegistroVeiculo($dados)){
                $this->session->set_flashdata('message', 'Veículo cadastrado com sucesso.');
                $this->session->set_flashdata('status', 1);
                redirect("mainController/index");
            }else{
                $this->session->set_flashdata('message', 'Erro ao cadastrar veículo.');
                $this->session->set_flashdata('status', 2);
                redirect("mainController/index");
            }    
      }
}
