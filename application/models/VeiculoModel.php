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

    public function PopulaCamposViewEditarVeiculo($id){
        $this->db->where('id', $id);
        $query = $this->db->get('veiculo');

        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }
    public function EditarVeiculo($dados, $id){
        $this->db->where('id',$id);
        if($this->db->update('veiculo',$dados)){
            return true;
        }else
            return false;
    }
    public function DeletarVeiculo($id){
        $this->db->where('id', $id);
        if($this->db->delete('veiculo')){
            return true;
        }else{
            return false;
        }
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