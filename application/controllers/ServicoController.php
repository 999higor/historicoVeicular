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
   
    }
    
    public function loadVisualizaServico(){	
        $this->PopulaTabelaServico();
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
                redirect("ServicoController/loadVisualizaServico");
            }else{
                $this->session->set_flashdata('message', 'Erro ao criar o Serviço.');
                $this->session->set_flashdata('status', 2);
                redirect("ServicoController/loadVisualizaServico");
            }
        }

        public function PopulaTabelaServico(){
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
                $data = array("message" => "Nenhum produto cadastrado", "status" => 3);
                $this->load->view('templates/headerView', $data);
                $this->load->view('templates/footerView');
            }
    }
}

