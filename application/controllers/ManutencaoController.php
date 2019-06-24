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

    public function loadCadastraManutencaoUsuario(){
        $data['empresa'] = $this->CarregaCBEmpresa();
        $data['veiculo']= $this->CarregaCBVeiculo();
        $data['servico'] = $this->CarregaCBServico();

        $this->load->view('templates/headerView'.$this->session->userdata('nivelAcesso'));
        $this->load->view('cadManutencaoUsuarioView', $data);
        $this->load->view('templates/footerView');
    }

    public function loadEditaManutencaoFuncionario(){
        $idManutencao = $this->input->get('id');
        $data['produto'] = $this->CarregaCBProduto();
        $data['servico']= $this->ManutencaoModel->PopulaServicoEditarManutencao($idManutencao);
        $data['produtosCadastrados'] =$this->ManutencaoModel->PopulaProdutoEditarManutencao($idManutencao);

        /*  Faz a busca no banco e coloca em um array */        
        foreach ($this->ManutencaoModel->PopulaEditarManutencaoFunc($idManutencao) as $dados)
        {
            $idManutencao = $dados['id'];
            $modeloVeiculo =  $dados['modeloVeiculo'];
            $placaVeiculo = $dados['placaVeiculo'];
            $dthrSolicitacao = $dados['dthrSolicitacao'];
            $dthrConfirmacao = $dados['dataConfirmacao'];
            $dataInicial = $dados['dataInicial'];
            $dataFinal = $dados['dataFinal'];
            $dataAtribuida = $dados['dataAgendada'];
            $realizado = $dados['status'];
            $nome = $dados['nome'];
            $sobrenome= $dados['sobrenome'];
            $ultimaModificacao = $dados['dthrUltimaModificacao'];
        }

        $data['dados'] = array( 
                        'idManutencao' => $idManutencao,
                        'dataInicial' => $dataInicial,
                        'dataFinal' => $dataFinal,
                        'modeloVeiculo' => $modeloVeiculo,
                        'placaVeiculo' => $placaVeiculo,
                        'dthrSolicitacao' => $dthrSolicitacao,
                        'dthrConfirmacao' => $dthrSolicitacao,
                        'dataAtribuida' => $dataAtribuida,
                        'realizado' => $realizado,
                        'nomeSolicitante' => $nome,
                        'sobrenomeSolicitante' => $sobrenome ,
                        'ultimaModificacao' => $ultimaModificacao  
                        );

        $this->load->view('templates/headerView'.$this->session->userdata('nivelAcesso'));
        $this->load->view('editaManutencaoFuncionarioView', $data);
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
            $this->load->view('DataTables/VizualizaManuntencaoUsuarioView');
            $this->load->view('templates/footerView');
        }
    }

    public function loadVisualizaManutencaoFuncionario(){
        $idEmpresa = $this->session->userdata('emp');
        $data['manutencao'] = $this->ManutencaoModel->PopulaTabelaManutencaoFuncionario($idEmpresa);
        /* Chama o método populaTabela no Model, caso o retorno não for vazio carrega a tela principal com a tabela */
        if(!empty($data['manutencao']))
        {
            $this->load->view('templates/headerView'.$this->session->userdata('nivelAcesso'));
            $this->load->view('DataTables/VisualizaManutencaoFuncionarioView', $data);
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

    public function CarregaCBProduto(){
        $idEmpresa = $this->session->userdata('emp');
        $data = $this->ManutencaoModel->CarregaCBProduto($idEmpresa);
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
        $contagem = $this->input->post('contagem', TRUE);
        $dataInicio = $this->input->post('dataInicio', TRUE);
        /* */ $dataInicio = date("Y-m-d", strtotime($dataInicio)); /* converte pro formato yyyy-mm-dd */
        $dataFim = $this->input->post('dataFim', TRUE);
        /* */ $dataFim = date("Y-m-d", strtotime($dataFim)); /* converte pro formato yyyy-mm-dd */
        $selectEmpresa = $this->input->post('selectEmpresa', TRUE);
        $selectVeiculo = $this->input->post('selectVeiculo', TRUE);
        
        for($i=0; $i <= $contagem;$i++){
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
            for($i=0; $i < $contagem;$i++){
                if($this->ManutencaoModel->InsereServicoManutencao($idManutencao, ${'selectServico'.$i})){
                    $this->session->set_flashdata('message', 'Manutenção cadastrada com sucesso.');
                    $this->session->set_flashdata('status', 1);
                    redirect("ManutencaoController/loadVizualizaManutencaoUsuario");
                }else{
                    $data = array("message" => "Houve algum erro ao cadastrar a manutenção.", "status" => 3);
                    $this->session->set_flashdata('status', 2);
                    redirect("ManutencaoController/loadVizualizaManutencaoUsuario");
                }
             }
        }else{
            $data = array("message" => "Houve algum erro ao cadastrar a manutenção.", "status" => 3);
            $this->session->set_flashdata('status', 2);
            redirect("ManutencaoController/loadVizualizaManutencaoUsuario");
        }
    }

    public function EditarManutencaoFuncionario(){
        $idFuncionario = $this->session->userdata('id');
        $contagem = $this->input->post('hiddenCount', TRUE);
        $idManutencao = $this->input->post('idManutencao', TRUE);
        $dataAtribuida = $this->input->post('dataAtribuida', TRUE);
        /* */ $dataAtribuida = date("Y-m-d", strtotime($dataAtribuida)); /* converte pro formato yyyy-mm-dd */
        $dados = array('dataAtribuida' => $dataAtribuida,
                       'realizado' => 1,
                       'idFuncionario' => $idFuncionario
        );
        if($contagem != 0){    
            for($i=1; $i <= $contagem;$i++){
                ${'selectProduto'.$i} = $this->input->post('selectProduto'.$i, TRUE);            
            }
        }    
        if($this->ManutencaoModel->UpdateManutencaoFuncionario($dados, $idManutencao)){
            if($contagem != 0){    
                for($i = 1; $i <= $contagem; $i++){
                        if($this->ManutencaoModel->InsereManutencaoProdutoFuncionario($idManutencao, ${'selectProduto'.$i})){
                            //Inserido com sucesso
                        }else{
                            $data = array("message" => "Houve algum erro ao inserir o produto a esta manutenção.", "status" => 3);
                            $this->session->set_flashdata('status', 2);
                            redirect("ManutencaoController/loadVisualizaManutencaoFuncionario");
                        }
                    }
                    $this->session->set_flashdata('message', 'Manutenção atualizada com sucesso.');
                    $this->session->set_flashdata('status', 1);
                    redirect("ManutencaoController/loadVisualizaManutencaoFuncionario");
            }
        }else{
            $data = array("message" => "Houve algum erro ao alterar a manutenção.", "status" => 3);
            $this->session->set_flashdata('status', 2);
            redirect("ManutencaoController/loadVisualizaManutencaoFuncionario");
        }
    }
}
