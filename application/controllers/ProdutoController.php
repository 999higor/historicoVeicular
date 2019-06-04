<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProdutoController extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
        $this->load->helper('url');
        $this->VerificaSessao(); 
        $this->load->model('ProdutoModel');
    }
    
    public function VerificaSessao(){
        if(empty($this->session->userdata('cpf'))){
            $data = array("message" => "Você precisa estar logado para acessar o cadastro.", "status" => 2);
			$this->load->view('loginView', $data);
        }
    }
    
    public function loadCadastraProduto(){
        $this->load->view('cadProdutoView');
    }

    public function loadEditaProduto(){

    }

    public function loadVisualizaProduto(){

    }

	public function CadastrarProduto(){
			$marca = $this->input->post('marca', TRUE);
            $nome = $this->input->post('nome', TRUE);
            $quantidade = $this->input->post('quantidade', TRUE);
            $valor = $this->input->post('valor', TRUE);
            
            $dados = array(
                'marca' => $marca ,
                'nome' => $nome,
                'quantidade' => $quantidade,
                'valor' => $valor,        
            );  
            
            if($this->ProdutoModel->CadastrarProduto($dados)){
                $this->session->set_flashdata('message', 'Produto cadastrado com sucesso.');
                $this->session->set_flashdata('status', 1);
                redirect("mainController/index");
            }else{
                $this->session->set_flashdata('message', 'Erro ao cadastrar Produto.');
                $this->session->set_flashdata('status', 2);
                redirect("mainController/index");
            }    
        }
}

