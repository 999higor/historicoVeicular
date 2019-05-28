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
    public function VerificaRG($dados){
        $this->db->where('RG', $dados['rg']);
        $query = $this->db->get('cliente');

        if($query->num_rows() > 0){
            return true;
        }else
            return false;
    }
}
