<?php

class ServicoModel extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function CadastrarServico($dados){
        if($this->db->insert('servico', $dados)){
            return TRUE;
        }else
            return FALSE;
    }

    public function PopulaTabelaServico(){
        $this->db->from('servico');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }

    public function PopulaCamposViewEditar($id){
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
}