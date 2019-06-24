<?php

class ManutencaoModel extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function CarregaCBEmpresa(){
        $this->db->from('empresa');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }

    public function CarregaCBVeiculo($id){
        $this->db->where('idCliente', $id);
        $this->db->from('veiculo');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }

    public function CarregaCBServico(){
        $this->db->from('servico');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }

    public function CadastrarManutencao($dados){
        if($this->db->insert('manutencao',$dados)){
            return $this->db->insert_id();
        }else
            return false;
    }

    public function InsereServicoManutencao($idManutencao, $idServico){
        $dados = array('idmanutencao' => $idManutencao, 'idservico' => $idServico);
        if($this->db->insert('servico_manutencao',$dados)){
            return true;
        }else
            return false;
    }

    public function PopulaTabelaManutencaoUsuario($idUsuario){
        $this->db->select('manutencao.*,ifnull(manutencao.dthrConfirmacao, "Não definida") as dataConfirmacao,ifnull(manutencao.dataAtribuida, "Não definida") as dataAgendada,if(realizado=0,"Pendente", "Em Avaliação / Iniciado") as status, veiculo.modelo as modeloVeiculo, veiculo.placa as placaVeiculo, empresa.nomeFantasia as nomeEmpresa');
        $this->db->from('manutencao');
        $this->db->join('veiculo', 'veiculo.id = manutencao.idveiculo');
        $this->db->join('empresa', 'empresa.id = manutencao.idempresa');
        $this->db->where('manutencao.idusuario', $idUsuario);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }

    public function PopulaTabelaManutencaoFuncionario($idEmpresa){
        $this->db->select('manutencao.*,ifnull(manutencao.dthrConfirmacao, "Não definida") as dataConfirmacao,ifnull(manutencao.dataAtribuida, "Não definida") as dataAgendada,if(realizado=0,"Pendente", "Em Avaliação / Iniciado") as status, veiculo.modelo as modeloVeiculo, veiculo.placa as placaVeiculo, empresa.nomeFantasia as nomeEmpresa');
        $this->db->from('manutencao');
        $this->db->join('veiculo', 'veiculo.id = manutencao.idveiculo');
        $this->db->join('empresa', 'empresa.id = manutencao.idempresa');
        $this->db->where('manutencao.idEmpresa', $idEmpresa);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }

    public function PopulaEditarManutencaoFunc($idManutencao){
        $this->db->select('manutencao.*,ifnull(manutencao.dthrConfirmacao, "Não definida") as dataConfirmacao,ifnull(manutencao.dataAtribuida, "Não definida") as dataAgendada,if(realizado=0,"Pendente", "Em Avaliação / Iniciado") as status,cliente.nome,cliente.sobrenome, veiculo.modelo as modeloVeiculo, veiculo.placa as placaVeiculo');
        $this->db->from('manutencao');
        $this->db->join('veiculo', 'veiculo.id = manutencao.idveiculo');
        $this->db->join('cliente', 'cliente.id = manutencao.idusuario');
        $this->db->where('manutencao.id', $idManutencao);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }

    public function CarregaCBProduto($idEmpresa){
        $this->db->select('*');
        $this->db->from('produto');
        $this->db->join('produto_empresa', 'produto_empresa.idproduto = produto.id');
        $this->db->where('produto_empresa.idempresa', $idEmpresa);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;

    }

    public function UpdateManutencaoFuncionario($dados, $idManutencao){
        $this->db->where('id',$idManutencao);
        $this->db->set('dthrConfirmacao', 'NOW()', FALSE);
        if($this->db->update('manutencao',$dados)){
            return true;
        }else
            return false;
    }

    public function InsereManutencaoProdutoFuncionario($idManutencao, $idProduto){
        if($this->db->insert('produto_manutencao', array('idmanutencao' => $idManutencao, 'idProduto' => $idProduto))){
            return true;
        }else
            return false;
    }

    
//         id 
// idveiculo -- veiculo.modelo, veiculo.placa
// idempresa -- empresa nomefantasia
// dthrSolicitacao 
// dthrConfirmacao if null = nao definida
// dthrUltimaModificacao 
// dataInicial
// dataFinal
// dataAtribuida if null = nao definida
// realizado if 0 = Em avaliação
        
}