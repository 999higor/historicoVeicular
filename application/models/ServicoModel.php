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
}