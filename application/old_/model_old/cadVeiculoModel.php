<?php

class cadVeiculoModel extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function EfetuaRegistroVeiculo($dados){
        if($this->db->insert('veiculo', $dados)){
            return TRUE;
        }else
            return FALSE;
    }
}