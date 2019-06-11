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

    public function PopulaCamposViewEditarEmpresa($id){
        $this->db->where('id', $id);
        $query = $this->db->get('empresa');

        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }
    public function EditarEmpresa($dados, $id){
        $this->db->where('id',$id);
        if($this->db->update('empresa',$dados)){
            return true;
        }else
            return false;
    }

    public function DeletarEmpresa($id){
        //$this->db->where('id', $id);
        if($this->db->delete('empresa', array('id' => $id))){
            return true;
        }else
            return false;
    }

    public function PopulaTabelaEmpresa(){
        $this->db->from('empresa');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }
}