<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProdutoController extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
        $this->load->helper('url');
        $this->load->model('ProdutoModel');
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
    
    public function loadCadastraProduto(){
        $this->load->view('cadProdutoView');
    }

    public function loadEditaProduto(){

    }

    public function loadVisualizaProduto(){
        $this->PopulaTabelaProduto();
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
                redirect("ProdutoController/loadVisualizaProduto");
            }else{
                $this->session->set_flashdata('message', 'Erro ao cadastrar Produto.');
                $this->session->set_flashdata('status', 2);
                redirect("ProdutoController/loadVisualizaProduto");
            }    
        }

        public function PopulaTabelaProduto(){
            $data['produto'] = $this->ProdutoModel->PopulaTabelaProduto();
            /* Chama o método populaTabela no Model, caso o retorno não for vazio carrega a tela principal com a tabela */
            if(!empty($data['produto']))
            {
                $this->load->view('templates/headerView');
                $this->load->view('DataTables/VisualizaProdutoView', $data);
                $this->load->view('templates/footerView');
            }else{
                /* Se o valor retornado do model for vazio significa que não existe nenhum registro para este usuário
                        - Retorna mensagem para a tela principal                                                   */
                $data = array("message" => "Nenhum produto cadastrado", "status" => 3);
                $this->load->view('templates/headerView', $data);
                $this->load->view('templates/footerView');
            }
    }
}

