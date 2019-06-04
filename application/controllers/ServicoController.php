<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ServicoController extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
        $this->load->helper('url');
        $this->VerificaSessao(); 
        $this->load->model('ServicoModel');
    }

    public function VerificaSessao(){
        if(empty($this->session->userdata('cpf'))){
            $data = array("message" => "Você precisa estar logado para acessar o cadastro.", "status" => 2);
			$this->load->view('loginView', $data);
        }
    }
    
	public function loadCadastraServico(){	
		$this->load->view('cadServicoView');
    }
    
    public function loadEditaServico(){	
   
    }
    
    public function loadVisualizaServico(){	

	}
   
	public function CadastrarServico(){
            $nome = $this->input->post('nome', TRUE);
            $valor = $this->input->post('valor', TRUE);

            $dados = array(
                'nome' => $nome,
                'valor' => $valor,  
            );  

            if($this->ServicoModel->CadastrarServico($dados)){
                $this->session->set_flashdata('message', 'Serviço criado com sucesso.');
                $this->session->set_flashdata('status', 1);
                redirect("mainController/index");
            }else{
                $this->session->set_flashdata('message', 'Erro ao criar o Serviço.');
                $this->session->set_flashdata('status', 2);
                redirect("mainController/index");
            }
        }
}

