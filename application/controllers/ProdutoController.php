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
            $quantidade = $dados['quantidade'];
            $marca = $dados['marca'];
            $valor = $dados['valor'];
        }

        $data = array('id' => $id,
                      'marca' => $marca ,
                      'nome' => $nome,
                      'quantidade' => $quantidade,
                      'valor' => $valor     
                      );

        return $data;
    }

    public function EditarProduto(){
        $id = $this->input->post('id', TRUE);
        $nome = $this->input->post('nome', TRUE);
        $valor = $this->input->post('valor', TRUE);
        $quantidade = $this->input->post('quantidade', TRUE);
        if(!empty($this->input->post('marca', TRUE))){
            $dados['marca'] = $this->input->post('marca', TRUE);
        }

        $dados = array(
            'nome' => $nome,
            'valor' => $valor,
            'quantidade' => $quantidade
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
        $data['produto'] = $this->ProdutoModel->PopulaTabelaProduto();
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

    public function DeletarProduto(){
        $id = $this->input->post('id', true);

        if($this->ProdutoModel->DeletarProduto($id)){
            $this->session->set_flashdata('message', 'Produto deletado com sucesso.');
            $this->session->set_flashdata('status', 1);
            redirect("ProdutoController/loadVisualizaProduto");
        }else{
            $this->session->set_flashdata('message', 'Houve um erro ao deletar produto.');
            $this->session->set_flashdata('status', 1);
            redirect("ProdutoController/loadVisualizaProduto");
        }
    } 

	public function CadastrarProduto(){
            $nome = $this->input->post('nome', TRUE);
            $valor = $this->input->post('valor', TRUE);
            $quantidade = $this->input->post('quantidade', TRUE);
            if(!empty($this->input->post('marca', TRUE))){
                $dados['marca'] = $this->input->post('marca', TRUE);
            }

            $dados = array(
                'nome' => $nome,
                'valor' => $valor,
                'quantidade' => $quantidade
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
}

