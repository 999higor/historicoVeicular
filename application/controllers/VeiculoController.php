<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VeiculoController extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
        $this->load->helper('url');
        $this->load->model('VeiculoModel');
        $this->load->library('form_validation');
        $this->VerificaSessao();        
    }

    public function VerificaSessao(){
        if(empty($this->session->userdata('cpf'))){
            $this->session->set_flashdata('message', 'Você precisa estar logado para acessar o sistema.');
            $this->session->set_flashdata('status', 2);
            redirect("LoginController/index");
        }
    }
    
    public function loadCadastraVeiculo(){
        $this->load->view('templates/headerView');
        $this->load->view('cadVeiculoView');
        $this->load->view('templates/footerView');
    }

    public function loadEditaVeiculo()
    {
        /* Chama o método populaTabela no Model, caso o retorno não for vazio carrega a tela principal com a tabela */
        $idVeiculo = $this->input->get('id');
        $data = $this->PopulaCamposViewEditarVeiculo($idVeiculo);

        if(!empty($data))
        {    
            $this->load->view('templates/headerView');
            $this->load->view('editaVeiculoView', $data);
            $this->load->view('templates/footerView');
        }else
        {
            /* Se o renavam retornado do model for vazio significa que não existe nenhum registro para este usuário
                    - Retorna mensagem para a tela principal      */
            $data = array("message" => "Erro ao encontrar serviço.", "status" => 2);
            $this->load->view('templates/headerView', $data);
            $this->load->view('templates/footerView');
        }
    }
    
    public function PopulaCamposViewEditarVeiculo($id)
    {
        /*  Faz a busca no banco e coloca em um array */
        foreach ($this->VeiculoModel->PopulaCamposViewEditarVeiculo($id) as $dados)
        {
            $id = $dados['id'];
            $marca = $dados['marca'];
            $placa = $dados['placa'];
            $renavam = $dados['renavam'];
            $modelo = $dados['modelo'];
            $anoModelo = $dados['anoModelo'];
            $ano = $dados['anoFabricacao'];
            $idCliente = $dados['idCliente'];
        }

        $data = array(
            'id' => $id,
            'placa' => $placa,
            'renavam' => $renavam,
            'marca' => $marca,
            'modelo' => $modelo,
            'anoModelo' => $anoModelo,
            'anoFabricacao' => $ano,
            'idCliente' => $idCliente
            );

        return $data;
    }

    public function EditarVeiculo(){
        $id = $this->input->post('id');
        $marca = $this->input->post('marca');
        $renavam = $this->input->post('renavam');
        $placa = $this->input->post('placa');
        $anoModelo = $this->input->post('anoModelo');
        $modelo = $this->input->post('modelo');
        $ano = $this->input->post('anoFabricacao');
        


        $dados = array(
            'placa' => $placa,
            'renavam' => $renavam,
            'marca' => $marca,
            'modelo' => $modelo,
            'anoModelo' => $anoModelo,
            'anoFabricacao' => $ano,
            
        );

        if($this->VeiculoModel->EditarVeiculo($dados, $id)){
                $this->session->set_flashdata('message', 'O serviço de ID '.$id.' foi alterado com sucesso .');
                $this->session->set_flashdata('status', 1);
                redirect("VeiculoController/loadVisualizaVeiculos");
            }else{
                $this->session->set_flashdata('message', 'Houve um erro ao alterar o serviço de ID '.$id.'.');
                $this->session->set_flashdata('status', 3);
                redirect("VeiculoController/loadVisualizaVeiculos");
            }
    }

    public function loadVisualizaVeiculos(){
        $id = $this->session->userdata('id');
        $data['veiculo'] = $this->VeiculoModel->PopulaTabelaVeiculo($id);
        /* Chama o método populaTabela no Model, caso o retorno não for vazio carrega a tela principal com a tabela */
        if(!empty($data['veiculo']))
        {
            $this->load->view('templates/headerView');
            $this->load->view('DataTables/VisualizaVeiculoView', $data);
            $this->load->view('templates/footerView');
        }else{
            /* Se o renavam retornado do model for vazio significa que não existe nenhum registro para este usuário
                    - Retorna mensagem para a tela principal                                                   */
            $data = array("message" => "Nenhum Veiculo cadastrado com esse usuário.", "status" => 3);
            $this->load->view('templates/headerView', $data);
            $this->load->view('templates/footerView');
        }
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
}
