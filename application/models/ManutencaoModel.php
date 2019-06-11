<?php

class ManutencaoModel extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function CarregaCBEmpresa(){
        $this->db->from('empresa');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }

    public function CarregaCBVeiculo($id){
        $this->db->where('idCliente', $id);
        $this->db->from('veiculo');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }

    public function CarregaCBServico(){
        $this->db->from('servico');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }
}