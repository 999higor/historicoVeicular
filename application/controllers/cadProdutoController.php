<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cadProdutoController extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->helper('url');
	}
	public function index()
	{	
		$this->load->view('cadProdutoView');
	}

	public function CadastrarProduto(){

			$marca = $this->input->post('marca', TRUE);
            $nome = $this->input->post('nome', TRUE);
            $quantidade = $this->input->post('quantidade', TRUE);
            $valor = $this->input->post('valor', TRUE);
            
			
			$this->load->model('cadProdutoModel');


				$dados = array(
					'marca' => $marca ,
					'nome' => $nome,
					'quantidade' => $quantidade,
					'valor' => $valor,
					
				);  

				if($this->cadProdutoModel->Registro($dados)){
					$data = array("message" => "Produto criado com sucesso.","status" => 1);
					$this->load->view('MainView', $data);
				}else{
					$data = array("message" => "Erro ao criar Produto.", "status" => 2);
					$this->load->view('cadProdutoView', $data);
				}
			
        }
}

