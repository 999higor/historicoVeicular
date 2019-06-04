<?php

class ProdutoModel extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function CadastrarProduto($dados){
        if($this->db->insert('produto', $dados)){
            return TRUE;
        }else
            return FALSE;
    }

    public function PopulaTabelaProduto(){
        $this->db->from('produto');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }
}