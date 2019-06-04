<?php

class VeiculoModel extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function EfetuaRegistroVeiculo($dados){
        if($this->db->insert('veiculo', $dados)){
            return TRUE;
        }else
            return FALSE;
    }

    public function PopulaTabelaVeiculo($id){
        $this->db->from('veiculo');
        $this->db->where('idcliente', $id);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }
}