<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmpresaController extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
        $this->load->helper('url');
        $this->load->model('EmpresaModel');
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
    
    public function loadCadastraEmpresa(){
        //$this->load->view('cadEmpresaView');
        $this->load->view('templates/headerView');
        $this->load->view('cadEmpresaView');
        $this->load->view('templates/footerView');
    }

    public function loadEditaEmpresa()
    {
        /* Chama o método populaTabela no Model, caso o retorno não for vazio carrega a tela principal com a tabela */
        $idEmpresa = $this->input->get('id');
        $data = $this->PopulaCamposViewEditarEmpresa($idEmpresa);

        if(!empty($data))
        {    
            $this->load->view('templates/headerView');
            $this->load->view('editaEmpresaView', $data);
            $this->load->view('templates/footerView');
        }else
        {
            /* Se o renavam retornado do model for vazio significa que não existe nenhum registro para este usuário
                    - Retorna mensagem para a tela principal      */
            $data = array("message" => "Erro ao encontrar serviço.", "status" => 2);
            $this->load->view('templates/headerView', $data);
            $this->load->view('templates/footerView');
        }
    }
    
    public function PopulaCamposViewEditarEmpresa($id)
    {
        /*  Faz a busca no banco e coloca em um array */
        foreach ($this->EmpresaModel->PopulaCamposViewEditarEmpresa($id) as $dados)
        {
            $id = $dados['id'];
            $razaoSocial = $dados['razaoSocial'];
            $nomeFantasia = $dados['nomeFantasia'];
            $cnpj = $dados['cnpj'];
            $email = $dados['email'];
            
        }

        $data = array(
            'id' => $id,
            'razaoSocial' => $razaoSocial,
            'nomeFantasia' => $nomeFantasia,
            'cnpj' => $cnpj,
            'email' => $email
            );

        return $data;
    }

    public function EditarEmpresa(){
        $id = $this->input->post('id');
        $razaoSocial = $this->input->post('razaoSocial');
        $nomeFantasia = $this->input->post('nomeFantasia');
        $cnpj = $this->input->post('cnpj');
        $email = $this->input->post('email');
        


        $dados = array(
            'razaoSocial' => $razaoSocial ,
            'nomeFantasia' => $nomeFantasia,
            'cnpj' => $cnpj,
            'email' => $email,
        );  

        if($this->EmpresaModel->EditarEmpresa($dados, $id)){
                $this->session->set_flashdata('message', 'O serviço de ID '.$id.' foi alterado com sucesso .');
                $this->session->set_flashdata('status', 1);
                redirect("EmpresaController/loadVisualizaEmpresa");
            }else{
                $this->session->set_flashdata('message', 'Houve um erro ao alterar o serviço de ID '.$id.'.');
                $this->session->set_flashdata('status', 3);
                redirect("EmpresaController/loadVisualizaEmpresa");
            }
    }

    public function loadVisualizaEmpresa(){
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

    public function DeletarEmpresa(){
        $id = $this->input->post('id', TRUE);

        if($this->EmpresaModel->DeletarEmpresa($id)){
            $this->session->set_flashdata('message', 'empresa deletado com sucesso.');
            $this->session->set_flashdata('status', 1);
            redirect("EmpresaController/loadVisualizaEmpresa");
        }else{
            $this->session->set_flashdata('message', 'Erro ao deletar o empresa.');
            $this->session->set_flashdata('status', 1);
            redirect("EmpresaController/loadVisualizaEmpresa");
        }

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
}

