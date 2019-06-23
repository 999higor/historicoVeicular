<?php

class ProdutoModel extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function CadastrarProduto($dados){
        if($this->db->insert('produto', $dados)){
            return $this->db->insert_id();
        }else
            return FALSE;
    }

    public function CadastrarProdutoEmpresa($idProduto, $idEmpresa){
        $dados = array('idproduto'=>$idProduto, 'idempresa'=>$idEmpresa);
        if($this->db->insert('produto_empresa', $dados)){
            return true;
        }else
            return false;
    }

/*   public function PopulaTabelaProduto(){
        $this->db->from('produto');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    } 
*/
	
    public function PopulaTabelaProduto($idEmpresa){
        $this->db->select('produto.id as id, produto.nome as nome, produto.marca as marca');
        $this->db->from('produto');
        $this->db->join('produto_empresa', 'produto_empresa.idproduto = produto.id');
        $this->db->where('produto.ativo', 1);
        $this->db->where('produto_empresa.idempresa', $idEmpresa);
        $query = $this->db->get();

        if($query->num_rows() > 0){
           return $query->result_array();
        }else
            return false;
    }

    public function DesabilitarProduto($id){
        $this->db->set('ativo',0);
        $this->db->where('id', $id);
        if($this->db->update('produto')){
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