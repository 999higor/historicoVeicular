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
}