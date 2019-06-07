<?php

class EditaUsuarioModel extends CI_Model {
    public function __construct(){
        $this->load->database();
    }

    public function EditaUsuario($dados){
        $this->db->where('id', $id);
        if($this->db->update('cliente', $dados)){
            return true;
        }else
            return false;
    }

    public function getDados($id){
        $this->db->where('id', $id);
        $query = $this->db->get('cliente');

        if($query->num_rows() > 0){
            /* Maior que 0 significa que já existe cadastro, portanto  retorna TRUE */
            return $query->result_array();
        }else
            return false;
    }

    public function VerificaEmail($email){
        $this->db->where('email', $email);
        $query = $this->db->get('cliente');

        if($query->num_rows() > 0){
            /* Maior que 0 significa que já existe cadastro, portanto  retorna TRUE */
            return true;
        }else
            return false;
    }

    
    public function VerificaSenha($senha){
        $this->db->where('senha', $senha);
        $query = $this->db->get('cliente');

        if($query->num_rows() > 0){
            /* Maior que 0 significa que já existe cadastro, portanto  retorna TRUE */
            return true;
        }else
            return false;
    }
}
