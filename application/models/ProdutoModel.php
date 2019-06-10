<?php

class ProdutoModel extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function CadastrarProduto($dados){
        if($this->db->insert('produto', $dados)){
            return TRUE;
        }else
            return FALSE;
    }

    public function PopulaTabelaProduto(){
        $this->db->from('produto');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }

    public function DeletarProduto($id){
        $this->db->where('id', $id);
        if($this->db->delete('produto')){
            return true;
        }else{
            return false;
        }
    }

    public function PopulaCamposViewEditarProduto($id){
        $this->db->where('id', $id);
        $query = $this->db->get('produto');

        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }

    public function EditarProduto($dados, $id){
        $this->db->where('id',$id);
        if($this->db->update('produto',$dados)){
            return true;
        }else
            return false;
    }
}