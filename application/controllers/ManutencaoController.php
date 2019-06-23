<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ManutencaoController extends CI_Controller {
	public function __construct()
	{
		parent:: __construct();
        $this->load->helper('url');
        $this->load->model('ManutencaoModel');
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

    public function loadCadastraManutencao(){
        $data['empresa'] = $this->CarregaCBEmpresa();
        $data['veiculo']= $this->CarregaCBVeiculo();
        $data['servico'] = $this->CarregaCBServico();

        $this->load->view('templates/headerView'.$this->session->userdata('nivelAcesso'));
        $this->load->view('cadManutencaoUsuarioView', $data);
        $this->load->view('templates/footerView');
    }

    public function loadVizualizaManutencaoUsuario(){
        $id = $this->session->userdata('id');
        $data['manutencao'] = $this->ManutencaoModel->PopulaTabelaManutencaoUsuario($id);
        /* Chama o método populaTabela no Model, caso o retorno não for vazio carrega a tela principal com a tabela */
        if(!empty($data['manutencao']))
        {
            $this->load->view('templates/headerView'.$this->session->userdata('nivelAcesso'));
            $this->load->view('DataTables/VizualizaManuntencaoUsuarioView', $data);
            $this->load->view('templates/footerView');
        }else{
            /* Se o renavam retornado do model for vazio significa que não existe nenhum registro para este usuário
                    - Retorna mensagem para a tela principal                                                   */
            $data = array("message" => "Nenhuma manutenção cadastrado por esse usuário.", "status" => 3);
            $this->load->view('templates/headerView'.$this->session->userdata('nivelAcesso'));
            $this->load->view('templates/footerView');
        }
    }

    public function CarregaCBEmpresa(){
        $data = $this->ManutencaoModel->CarregaCBEmpresa();
        if(!empty($data)){
            return $data;
        }else
            return false;
    }

    public function CarregaCBVeiculo(){
        $id = $this->session->userdata('id');
        $data = $this->ManutencaoModel->CarregaCBVeiculo($id);
        if(!empty($data)){
            return $data;
        }else
            return false;
    }

    public function CarregaCBServico(){
        $data = $this->ManutencaoModel->CarregaCBServico();
        if(!empty($data)){
            return $data;
        }else
            return false;
    }

    public function CadastraManutencaoUsuario(){
        $idUsuario = $this->session->userdata('id');
        // $idEmpresa = $this->session->userdata('emp');
        $contagem = $this->input->post('contagem', TRUE);

        echo $contagem;

        $dataInicio = $this->input->post('dataInicio', TRUE);
        /* */ $dataInicio = date("Y-m-d", strtotime($dataInicio)); /* converte pro formato yyyy-mm-dd */
        $dataFim = $this->input->post('dataFim', TRUE);
        /* */ $dataFim = date("Y-m-d", strtotime($dataFim)); /* converte pro formato yyyy-mm-dd */
        $selectEmpresa = $this->input->post('selectEmpresa', TRUE);
        $selectVeiculo = $this->input->post('selectVeiculo', TRUE);
        
        for($i=0; $i < $contagem;$i++){
            ${'selectServico'.$i} = $this->input->post('selectServico'.$i, TRUE);            
        }

        $dados = array('idveiculo' => $selectVeiculo,
                       'idempresa' => $selectEmpresa,
                       'idUsuario' => $idUsuario,
                       'dataInicial' => $dataInicio,
                       'dataFinal' => $dataFim
        );

        $idManutencao = $this->ManutencaoModel->CadastrarManutencao($dados); /* Se a inserção estiver OK retorna o valor da id */
    
        if($idManutencao != FALSE){
            echo 'inserido manutencao';
            for($i=0; $i < $contagem;$i++){
                if($this->ManutencaoModel->InsereServicoManutencao($idManutencao, ${'selectServico'.$i})){
                    echo 'servico manutencao inserido '.$i;
                }else
                    echo 'houve algum erro';      
        }
    }else
        echo 'deu algum erro';
    }
}
