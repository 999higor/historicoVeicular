<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmpresaController extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
        $this->load->helper('url');
        $this->VerificaSessao();
        $this->load->model('EmpresaModel');
    }

    public function VerificaSessao(){
        if(empty($this->session->userdata('cpf'))){
            $data = array("message" => "Você precisa estar logado para acessar o cadastro.", "status" => 2);
			$this->load->view('loginView', $data);
        }
    }
    
    public function loadCadastraEmpresa(){
        $this->load->view('cadEmpresaView');
    }

    public function loadEditaEmpresa(){

    }

    public function loadVisualizaEmpresa(){
        
    }

	public function CadastrarEmpresa(){
        $razaoSocial = $this->input->post('razaoSocial', TRUE);
        $nomeFantasia = $this->input->post('nomeFantasia', TRUE);
        $cnpj = $this->input->post('cnpj', TRUE);
        $email = $this->input->post('email', TRUE);

        $dados = array(
            'razaoSocial' => $razaoSocial ,
            'nomeFantasia' => $nomeFantasia,
            'cnpj' => $cnpj,
            'email' => $email,
        );  
        
        if($this->EmpresaModel->CadastrarEmpresa($dados)){
            $this->session->set_flashdata('message', 'Empresa cadastrada com sucesso.');
            $this->session->set_flashdata('status', 1);
            redirect("mainController/index");
        }else{
            $this->session->set_flashdata('message', 'Erro ao cadastrar empresa.');
            $this->session->set_flashdata('status', 2);
            redirect("mainController/index");
        }
    }
}

