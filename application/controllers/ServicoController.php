<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ServicoController extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
        $this->load->helper('url');
        $this->load->model('ServicoModel');
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
    
	public function loadCadastraServico(){	
        $this->load->view('templates/headerView');
		$this->load->view('cadServicoView');
        $this->load->view('templates/footerView');
    }
    
    public function loadEditaServico(){
        /* Chama o método populaTabela no Model, caso o retorno não for vazio carrega a tela principal com a tabela */
        $idServico = $this->input->get('id');
        $data = $this->PopulaCamposViewEditarServico($idServico);

        if(!empty($data))
        {    
            $this->load->view('templates/headerView');
            $this->load->view('editaServicoView', $data);
            $this->load->view('templates/footerView');
        }else
        {
            /* Se o valor retornado do model for vazio significa que não existe nenhum registro para este usuário
                    - Retorna mensagem para a tela principal      */
            $data = array("message" => "Erro ao encontrar serviço.", "status" => 2);
            $this->load->view('templates/headerView', $data);
            $this->load->view('templates/footerView');
        }

    }
    
    public function loadVisualizaServico(){	
        $data['servico'] = $this->ServicoModel->PopulaTabelaServico();
        /* Chama o método populaTabela no Model, caso o retorno não for vazio carrega a tela principal com a tabela */
        if(!empty($data['servico']))
        {
            $this->load->view('templates/headerView');
            $this->load->view('DataTables/VisualizaServicoView', $data);
            $this->load->view('templates/footerView');
        }else{
            /* Se o valor retornado do model for vazio significa que não existe nenhum registro para este usuário
                    - Retorna mensagem para a tela principal                                                   */
            $this->session->set_flashdata('message', 'Nenhum serviço cadastrado');
            $this->session->set_flashdata('status', 3);
            $this->load->view('templates/headerView', $data);
            $this->load->view('templates/footerView');
        }
    }
    
    public function DeletarServico(){
        $id = $this->input->post('id', TRUE);

        if($this->ServicoModel->DeletarServico($id)){
            $this->session->set_flashdata('message', 'Serviço deletado com sucesso.');
            $this->session->set_flashdata('status', 1);
            redirect("ServicoController/loadVisualizaServico");
        }else{
            $this->session->set_flashdata('message', 'Erro ao deletar o serviço.');
            $this->session->set_flashdata('status', 1);
            redirect("ServicoController/loadVisualizaServico");
        }

    }

    /* 
    *
    *     View Cadastrar Servico
    *
    */
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
                redirect("ServicoController/loadVisualizaServico");
            }else{
                $this->session->set_flashdata('message', 'Erro ao criar o Serviço.');
                $this->session->set_flashdata('status', 2);
                redirect("ServicoController/loadVisualizaServico");
            }
        }

        /* 
        *
        *     View Editar Servico
        *
        */
        public function PopulaCamposViewEditarServico($id){
            /*  Faz a busca no banco e coloca em um array */
            foreach ($this->ServicoModel->PopulaCamposViewEditarServico($id) as $dados)
            {
                $id = $dados['id'];
                $valor = $dados['valor'];
                $nome = $dados['nome'];
            }
 
            $data = array('id' => $id, 
                          'valor' => $valor ,
                          'nome' => $nome , 
                          );
 
            return $data;
        }

        public function EditarServico(){
            $id = $this->input->post('id');
            $nome = $this->input->post('nome');
            $valor = $this->input->post('valor');

            $dados = array(
                          'nome' => $nome,
                          'valor' => $valor
            );

            if($this->ServicoModel->EditarServico($dados, $id)){
                    $this->session->set_flashdata('message', 'O serviço de ID '.$id.' foi alterado com sucesso .');
                    $this->session->set_flashdata('status', 1);
                    redirect("ServicoController/loadVisualizaServico");
                }else{
                    $this->session->set_flashdata('message', 'Houve um erro ao alterar o serviço de ID '.$id.'.');
                    $this->session->set_flashdata('status', 3);
                    redirect("ServicoController/loadVisualizaServico");
                }
        }
}

