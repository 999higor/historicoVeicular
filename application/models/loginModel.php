<?php

class News_model extends CI_Model {

    /* Método para conectar ao banco */
    public function __construct(){
            $this->load->database();
    }

    public function verificaLogin($cpf, $senha){
        $this->db->where('cpf', $cpf);
        $this->db->where('senha', $senha);
        $query = $this->db->get('cliente');
    /*  Corresponde a consulta SELECT * FROM cliente WHERE cpf = $cpf AND senha = $senha */

     /* Se o numero de linhas retornadas na função num_rows
        for maior que 0, significa que existe um usuário 
        com as senhas enviadas na tela de login      */   
        if($query->num_rows() > 0){
            return true;
        
        }else
            return false;
    }
}