<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cadServicoController extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->helper('url');
	}
	public function index()
	{	
		$this->load->view('cadServicoView');
	}

	public function CadastrarServico(){


            $nome = $this->input->post('nome', TRUE);
            $valor = $this->input->post('valor', TRUE);
            
			
			$this->load->model('cadServicoModel');


				$dados = array(
					'nome' => $nome,
					'valor' => $valor,
					
				);  

				if($this->cadServicoModel->Registro($dados)){
					$data = array("message" => "Serviço criado com sucesso.","status" => 1);
					$this->load->view('MainView', $data);
				}else{
					$data = array("message" => "Erro ao criar o Serviço.", "status" => 2);
					$this->load->view('cadServicoView', $data);
				}
			
        }
}

