<?php

class cadUsuarioModel extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function EfetuaRegistro($dados){
        if($this->db->insert('cliente', $dados)){
            return TRUE;
        }else
            return FALSE;
    }
}