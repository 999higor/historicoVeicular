<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class cadUsuarioController extends CI_Controller {
	public function __construct()
	{
		parent:: __construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
	}
	public function index()
	{
		$this->load->view('cadUsuarioView');
	}
	public function CadastrarUsuario(){
		/* Define as mensagens que aparecerão quando tiver erros */
		$this->form_validation->set_message('alpha', 'Somente caracteres válidos. Digite letras.');
		$this->form_validation->set_message('numeric', 'Digite números inteiros.');
		$this->form_validation->set_message('min_length', 'O número mínimo de caracteres é 8.');
		$this->form_validation->set_message('matches', 'As senhas precisam ser identicas.');

		/* Define as regras de validação do formulário */
		$this->form_validation->set_rules('nome', 'Nome', 'alpha');
		$this->form_validation->set_rules('sobrenome', 'Sobrenome', 'alpha');
		$this->form_validation->set_rules('cpfUserHidden', 'CPF', 'numeric');
		$this->form_validation->set_rules('cpfUserHidden', 'RG', 'numeric');
		$this->form_validation->set_rules('password', 'Senha', 'min_length[8]');
		$this->form_validation->set_rules('confirmPassword', 'Password Confirmation', 'trim|matches[password]');

		/*
				Efetua a validação do formulário
				   - Se retornar valor falso significa que existe algo errado, retorna para a View e mostra mensagem de alerta
				   - Se retornar valor verdadeiro entra no processo de cadastro
		*/
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('cadUsuarioView');
		}
		else
		{
				/* Coleta os dados do formulário por POST */
				$nome = $this->input->post('nome', TRUE);
				$sobrenome = $this->input->post('sobrenome', TRUE);
				$cpf = $this->input->post('cpfUserHidden', TRUE); /* cpfUserHidden pois está sem a máscara */
				$rg = $this->input->post('rgUserHidden', TRUE); /* rgUserHidden pois está sem a máscara */
				$email = $this->input->post('email', TRUE);
				$password = $this->input->post('password', TRUE);
				$confirmPassword = $this->input->post('confirmPassword', TRUE);

				/* Carrega o Model */
				$this->load->model('cadUsuarioModel');

				/* Gera array com os dados */
				$dados = array(
					'nome' => $nome ,
					'sobrenome' => $sobrenome,
					'rg' => $rg,
					'cpf' => $cpf,
					'senha' => $password,
					'email' => $email
				);

				/*
						Chama o metodo EfetuaRegistro
							- Se retornar valor verdadeiro siginifica que o cadastro deu certo
							- Se retornar falso significa que houve algo de errado
				*/
				if($this->cadUsuarioModel->EfetuaRegistro($dados)){
					$data = array("message" => "Usuário criado com sucesso.","status" => 1);
					$this->load->view('loginView', $data);
				}else{
					$data = array("message" => "Erro ao criar usuário.", "status" => 2);
					$this->load->view('loginView', $data);
				}
		}
	}

	public function verificaRg(){
			if($this->cadUsuarioModel->verificaRG($dados)){
					$this->form_validation->set_message('username_check', 'O RG já está cadastrado.');
					return FALSE;
			}else
					return true;
	}

	public function verificaCpf(){


	}
}
