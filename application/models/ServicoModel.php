<?php

class ServicoModel extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function CadastrarServico($dados){
        if($this->db->insert('servico', $dados)){
            return $this->db->insert_id(); //retorna a id do ultimo item cadastrado
        }else
            return FALSE;
    }

    public function PopulaTabelaServico($empresaId){
        $this->db->select('*');
        $this->db->from('servico');
        $this->db->join('servico_empresa', 'servico_empresa.idEmpresa = servico.id');
        $this->db->where('servico_empresa.idEmpresa', $empresaId);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->last_query();//$query->result_array();
        }else
            return false;
    }













    public function PopulaCamposViewEditarServico($id){
        $this->db->where('id', $id);
        $query = $this->db->get('servico');

        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }

    public function EditarServico($dados, $id){
        $this->db->where('id',$id);
        if($this->db->update('servico',$dados)){
            return true;
        }else
            return false;
    }

    public function CadastrarServicoEmpresa($idServico,$idEmpresa){
        $dados = array('idServico' => $idServico, 'idEmpresa' => $idEmpresa);
        if($this->db->insert('servico_empresa', $dados)){
            return TRUE;
        }else
            return FALSE;
    }

    public function DeletarServico($id){
        //$this->db->where('id', $id);
        if($this->db->delete('servico', array('id' => $id))){
            return true;
        }else
            return false;
    }
}