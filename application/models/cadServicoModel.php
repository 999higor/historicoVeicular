<?php

class cadServicoModel extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function Registro($dados){
        if($this->db->insert('servico', $dados)){
            return TRUE;
        }else
            return FALSE;
    }
}