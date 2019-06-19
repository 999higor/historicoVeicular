<?php

class LoginModel extends CI_Model {

    /* Método para conectar ao banco */
    public function __construct(){
            $this->load->database();
    }

    public function verificaLogin($cpf, $senha){
        $this->db->where('cpf', $cpf);
        $this->db->where('senha', $senha);
        $query = $this->db->get('cliente');
/*      Corresponde a consulta SELECT * FROM cliente WHERE cpf = $cpf AND senha = $senha;      */

/*      Se o numero de linhas retornadas na função num_rows
        for maior que 0, significa que existe um usuário 
        com as senhas enviadas na tela de login     
*/   
        if($query->num_rows() > 0){
            return true;
        
        }else
            return false;
    }

    public function getCodigoEmpresa($id){
        $this->db->select('idempresa');
        $this->db->from('funcionario');
        $this->db->where('idusuario', $id);
        $query = $this->db->get();
/*      SELECT id FROM cliente WHERE cpf = $cpf;        */

        if($query->num_rows()>0) {
            $value = $query->row()->idempresa;
            return $value;
        }else            
            return false;
        }

    public function getDados($cpf){
        $this->db->from('cliente');
        $this->db->where('cpf', $cpf);
        $query = $this->db->get();

        if($query->num_rows() > 0 ){
            return $query->result_array();
        }else
            return false;
    }

}