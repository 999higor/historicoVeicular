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
}