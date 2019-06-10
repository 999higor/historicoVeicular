<?php 

class MainModel extends CI_Model {

/*  Método para conectar ao banco   */
    public function __construct(){
        $this->load->database();
    }

    public function populaTabela($id){
        $this->db->from('veiculo');
        $this->db->where('idcliente', $id);
        $query = $this->db->get();
/*      SELECT * FROM veiculo WHERE idcliente = $id     */

        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }
/* 
    MOSTRAR CONSULTA QUE ESTÁ SENDO EXECUTADA PELO BD
        return $this->db->last_query();
*/
    public function verificaVeiculo($id){
        $this->db->where('idcliente',$id);
        $query = $this->db->get('veiculo');
/*      SELECT * FROM veiculo WHERE idcliente = $id     */

        if($query->num_rows() > 0){
            return true;
        
        }else
            return false;
    }
}