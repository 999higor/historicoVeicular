<?php

class UsuarioModel extends CI_Model {
    public function __construct(){
        $this->load->database();
    }
    public function EfetuaRegistro($dados){
        if($this->db->insert('cliente', $dados)){
            return true;
        }else
            return false;
    }

    public function VerificaRG($rg){
        $this->db->where('RG', $rg);
        $query = $this->db->get('cliente');

        if($query->num_rows() > 0){
            /* Maior que 0 significa que já existe cadastro, portanto  retorna TRUE */
            return true;
        }else
            return false;
    }

    public function VerificaCPF($cpf){
        $this->db->where('CPF', $cpf);
        $query = $this->db->get('cliente');

        if($query->num_rows() > 0){
            /* Maior que 0 significa que já existe cadastro, portanto  retorna TRUE */
            return true;
        }else
            return false;
    }

    public function VerificaSenha($senha, $id){
        $this->db->where('senha', $senha);
        $this->db->where('id', $id);
        $query = $this->db->get('cliente');

        if($query->num_rows() > 0){
            /* Maior que 0 significa que a senha está correta, portanto  retorna TRUE */
            return true;
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

    public function CarregaDadosViewEditarUsuario($id){
        $this->db->where('id', $id);
        $query = $this->db->get('cliente');

        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }

    public function EditarUsuario($dados, $id){
        $this->db->where('id', $id);
        if($this->db->update('cliente', $dados)){
            return true;
        }else
            return false;
    }

    public function AlterarSenha($novaSenha, $id){
        $this->db->where('id', $id);
        $this->db->set('senha', $novaSenha);
        if($this->db->update('cliente')){
            return true;
        }else
            return false;
    }
}
