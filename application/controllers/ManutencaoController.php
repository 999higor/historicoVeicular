<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ManutencaoController extends CI_Controller {
	public function __construct()
	{
		parent:: __construct();
        $this->load->helper('url');
        $this->load->model('ManutencaoModel');
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

    public function loadCadastraManutencao(){
        $data['empresa'] = $this->CarregaCBEmpresa();
        $data['veiculo']= $this->CarregaCBVeiculo();
        $data['servico'] = $this->CarregaCBServico();

        $this->load->view('templates/headerView'.$this->session->userdata('nivelAcesso'));
        $this->load->view('cadManutencaoUsuarioView', $data);
        $this->load->view('templates/footerView');
    }

    public function CarregaCBEmpresa(){
        $data = $this->ManutencaoModel->CarregaCBEmpresa();
        if(!empty($data)){
            return $data;
        }else
            return false;
    }

    public function CarregaCBVeiculo(){
        $id = $this->session->userdata('id');
        $data = $this->ManutencaoModel->CarregaCBVeiculo($id);
        if(!empty($data)){
            return $data;
        }else
            return false;
    }

    public function CarregaCBServico(){
        $data = $this->ManutencaoModel->CarregaCBServico();
        if(!empty($data)){
            return $data;
        }else
            return false;
    }

    public function CadastraManutencaoUsuario(){
        $idEmpresa = $this->session->userdata('emp');

        $nome = $this->input->post('nome', TRUE);
        $valor = $this->input->post('valor', TRUE);
        $quantidade = $this->input->post('quantidade', TRUE);
        $marca = $this->input->post('marca', TRUE);

    }
}
