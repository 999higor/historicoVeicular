<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cadEmpresaController extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->helper('url');
	}
	public function index()
	{	
		$this->load->view('cadEmpresaView');
	}

	public function CadastrarEmpresa(){

			$razaoSocial = $this->input->post('razaoSocial', TRUE);
            $nomeFantasia = $this->input->post('nomeFantasia', TRUE);
            $cnpj = $this->input->post('cnpj', TRUE);
            $email = $this->input->post('email', TRUE);
            
			
			$this->load->model('cadEmpresaModel');


				$dados = array(
					'razaoSocial' => $razaoSocial ,
					'nomeFantasia' => $nomeFantasia,
					'cnpj' => $cnpj,
					'email' => $email,
					
				);  

				if($this->cadEmpresaModel->Registro($dados)){
					$data = array("message" => "Empresa criada com sucesso.","status" => 1);
					$this->load->view('MainView', $data);
				}else{
					$data = array("message" => "Erro ao criar a Empresa.", "status" => 2);
					$this->load->view('cadEmpresaView', $data);
				}
			
        }
}

