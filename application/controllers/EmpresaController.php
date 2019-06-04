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
        $this->PopulaTabelaEmpresa();
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
                redirect("EmpresaController/loadVisualizaEmpresa");
            }else{
                $this->session->set_flashdata('message', 'Erro ao cadastrar empresa.');
                $this->session->set_flashdata('status', 2);
                redirect("EmpresaController/loadVisualizaEmpresa");
            }
    }

    public function PopulaTabelaEmpresa(){
            $data['empresa'] = $this->EmpresaModel->PopulaTabelaEmpresa();
            /* Chama o método populaTabela no Model, caso o retorno não for vazio carrega a tela principal com a tabela */
            if(!empty($data['empresa']))
            {
                $this->load->view('templates/headerView');
                $this->load->view('DataTables/VisualizaEmpresaView', $data);
                $this->load->view('templates/footerView');
            }else{
                /* Se o valor retornado do model for vazio significa que não existe nenhum registro para este usuário
                        - Retorna mensagem para a tela principal                                                   */
                $data = array("message" => "Nenhuma empresa cadastrada", "status" => 3);
                $this->load->view('templates/headerView', $data);
                $this->load->view('templates/footerView');
            }
    }
}

