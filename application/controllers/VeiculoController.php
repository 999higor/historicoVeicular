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
        $id = $this->session->userdata('id');
        $this->PopulaTabelaVeiculo($id);
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
                redirect("VeiculoController/loadVisualizaVeiculos");
            }else{
                $this->session->set_flashdata('message', 'Erro ao cadastrar veículo.');
                $this->session->set_flashdata('status', 2);
                redirect("VeiculoController/loadVisualizaVeiculos");
            }    
      }
    
    public function PopulaTabelaVeiculo($id){
        $data['veiculo'] = $this->VeiculoModel->PopulaTabelaVeiculo($id);
        /* Chama o método populaTabela no Model, caso o retorno não for vazio carrega a tela principal com a tabela */
        if(!empty($data['veiculo']))
        {
            $this->load->view('templates/headerView');
            $this->load->view('DataTables/VisualizaVeiculoView', $data);
            $this->load->view('templates/footerView');
        }else{
            /* Se o valor retornado do model for vazio significa que não existe nenhum registro para este usuário
                    - Retorna mensagem para a tela principal                                                   */
            $data = array("message" => "Nenhum Veiculo cadastrado com esse usuário.", "status" => 3);
            $this->load->view('templates/headerView', $data);
            $this->load->view('templates/footerView');
        }
    }
}
