<?php

class EmpresaModel extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function CadastrarEmpresa($dados){
        if($this->db->insert('empresa', $dados)){
            return TRUE;
        }else
            return FALSE;
    }

    public function PopulaTabelaEmpresa(){
        $this->db->from('empresa');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }
}