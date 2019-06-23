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
        $this->load->view('templates/headerView'.$this->session->userdata('nivelAcesso'));
        $this->load->view('cadProdutoView');
        $this->load->view('templates/footerView');
    }

    public function loadEditarProduto(){
        $id = $this->input->get('id');
        $data = $this->PopulaCamposViewEditarProduto($id);
 
        if(!empty($data))
        {    
            $this->load->view('templates/headerView'.$this->session->userdata('nivelAcesso'));
            $this->load->view('editaProdutoView', $data);
            $this->load->view('templates/footerView');
        }else
        {
            /* Se o valor retornado do model for vazio significa que não existe nenhum registro para este usuário
                    - Retorna mensagem para a tela principal      */
            $data = array("message" => "Erro ao encontrar produto.", "status" => 2);
            $this->load->view('templates/headerView'.$this->session->userdata('nivelAcesso'));
            $this->load->view('templates/footerView');
        }
    }

    public function PopulaCamposViewEditarProduto($idProduto){
        /*  Faz a busca no banco e coloca em um array */
        foreach ($this->ProdutoModel->PopulaCamposViewEditarProduto($idProduto) as $dados)
        {
            $id = $dados['id'];
            $nome = $dados['nome'];
            $marca = $dados['marca'];
        }

        $data = array('id' => $id,
                      'marca' => $marca ,
                      'nome' => $nome,  
                      );
        return $data;
    }

    public function EditarProduto(){
        $id = $this->input->post('id', TRUE);
        $nome = $this->input->post('nome', TRUE);
        if(!empty($this->input->post('marca', TRUE))){
            $dados['marca'] = $this->input->post('marca', TRUE);
        }

        $dados = array(
            'nome' => $nome,
            'valor' => $valor
        );  

        if($this->ProdutoModel->EditarProduto($dados, $id)){
            $this->session->set_flashdata('message', 'Produto alterado com sucesso.');
            $this->session->set_flashdata('status', 1);
            redirect("ProdutoController/loadVisualizaProduto");
        }else{
            $this->session->set_flashdata('message', 'Erro ao alterar Produto.');
            $this->session->set_flashdata('status', 2);
            redirect("ProdutoController/loadVisualizaProduto");
        }    
    }

    public function loadVisualizaProduto(){
        $idEmpresa = $this->session->userdata('emp'); /* pega ID da empresa */
        $data['nomeEmpresa'] = $this->session->userdata('nomeEmpresa');
        $data['produto'] = $this->ProdutoModel->PopulaTabelaProduto($idEmpresa);
        /* Chama o método populaTabela no Model, caso o retorno não for vazio carrega a tela principal com a tabela */
        if(!empty($data['produto']))
        {
            $this->load->view('templates/headerView'.$this->session->userdata('nivelAcesso'));
            $this->load->view('DataTables/VisualizaProdutoView', $data);
            $this->load->view('templates/footerView');
        }else{
            /* Se o valor retornado do model for vazio significa que não existe nenhum registro para este usuário
                    - Retorna mensagem para a tela principal                                                   */
            $data = array("message" => "Nenhum produto cadastrado", "status" => 3);
            $this->load->view('templates/headerView'.$this->session->userdata('nivelAcesso'));
            $this->load->view('templates/footerView');
        }
    }

    public function DesabilitarProduto(){
        $id = $this->input->post('id', true);

        if($this->ProdutoModel->DesabilitarProduto($id)){
            $this->session->set_flashdata('message', 'Produto desativado com sucesso.');
            $this->session->set_flashdata('status', 1);
            redirect("ProdutoController/loadVisualizaProduto");
        }else{
            $this->session->set_flashdata('message', 'Houve um erro ao desativar o produto.');
            $this->session->set_flashdata('status', 1);
            redirect("ProdutoController/loadVisualizaProduto");
        }
    } 

	public function CadastrarProduto(){
        $idEmpresa = $this->session->userdata('emp');

        $nome = $this->input->post('nome', TRUE);
        $marca = $this->input->post('marca', TRUE);

        $dados = array(
            'nome' => $nome,
            'marca' => $marca
        );  
        $idProduto = $this->ProdutoModel->CadastrarProduto($dados); /* Se a inserção estiver OK retorna o valor da id */
    
        if($idProduto != FALSE){
            if($this->ProdutoModel->CadastrarProdutoEmpresa($idProduto, $idEmpresa)){
                $this->session->set_flashdata('message', 'Produto cadastrado com sucesso.');
                $this->session->set_flashdata('status', 1);
                redirect("ProdutoController/loadVisualizaProduto");
            }else{
                $this->session->set_flashdata('message', 'Erro ao inserir na tabela produto_empresa.');
                $this->session->set_flashdata('status', 2);
                redirect("ProdutoController/loadVisualizaProduto");
            }
        }else{
            $this->session->set_flashdata('message', 'Erro ao cadastrar Produto.');
            $this->session->set_flashdata('status', 2);
            redirect("ProdutoController/loadVisualizaProduto");
        }    
    }
}

