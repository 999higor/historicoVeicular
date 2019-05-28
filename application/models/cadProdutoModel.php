<?php

class cadProdutoModel extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function Registro($dados){
        if($this->db->insert('produto', $dados)){
            return TRUE;
        }else
            return FALSE;
    }
}