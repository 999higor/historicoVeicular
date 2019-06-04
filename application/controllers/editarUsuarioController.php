<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class EditarUsuarioController extends CI_Controller {
	public function __construct()
	{
		parent:: __construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
		
		/* Carrega o Model */
		$this->load->model('EditaUsuarioModel');
	}
	
	public function index()
	{
        $id = $this->session->userdata('id');
        $data = $this->preencheCampos($id);
		$this->load->view('editarUsuarioView', $data);
	}

	public function EditarUsuario(){
		/* Define as mensagens que aparecerão quando tiver erros */
        $this->form_validation->set_message('alpha', 'Digite letras somente letras no campo {field}.');
        $this->form_validation->set_message('min_length', 'No campo {field} é obrigatório o número mínimo de {param} caracteres.');
		$this->form_validation->set_message('max_length', 'O campo {field} suporta apenas {param} caracteres.');
		$this->form_validation->set_message('matches', 'As senhas precisam ser identicas.');

		/* Define as regras de validação do formulário */
		$this->form_validation->set_rules('nome', 'Nome', 'alpha');
		$this->form_validation->set_rules('sobrenome', 'Sobrenome', 'alpha');
        $this->form_validation->set_rules('password', 'Senha', 'min_length[8]');
        $this->form_validation->set_rules('confirmPassword', 'Password Confirmation', array('trim','matches[password]', 'callback_VerificaSenha'));
        
        $email = $this->input->post('email', TRUE);
        $sessionEmail = $this->session->userdata('email');
        if($sessionEmail != $email){
            $this->form_validation->set_rules('email', 'E-mail', 'callback_VerificaEmail');
        }else

		/*
				Efetua a validação do formulário
				   - Se retornar valor falso significa que existe algo errado, retorna para a View e mostra mensagem de alerta
				   - Se retornar valor verdadeiro entra no processo de cadastro
		*/
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('editarUsuarioView');
		}
		else
		{
                if($email != $sessionEmail){
                   $email = $sessionEmail;
                }

				/* Coleta os dados do formulário por POST */
				$nome = $this->input->post('nome', TRUE);
				$sobrenome = $this->input->post('sobrenome', TRUE);

				/* Gera array com os dados */
				$dados = array(
					'nome' => $nome ,
                    'sobrenome' => $sobrenome,
                    'email' => $email
                );

				/*
						Chama o metodo EfetuaRegistro
							- Se retornar valor verdadeiro siginifica que o cadastro deu certo
							- Se retornar falso significa que houve algo de errado
				*/
				if($this->EditaUsuarioModel->EditaUsuario($dados)){
					$data = array("message" => "Usuário alterado com sucesso.","status" => 1);
					$this->load->view('MainView', $data);
				}else{
					$data = array("message" => "Erro ao criar usuário.", "status" => 2);
					$this->load->view('MainView', $data);
				}
		}
    }
    
    public function VerificaEmail($str){
        if($this->EditaUsuarioModel->VerificaEmail($str)){
            /* existe cadastro */
            $this->form_validation->set_message('VerificaEmail', 'Já existe este e-mail cadastrado no banco de dados.');
            return false;
        }else{
            /* não existe cadastro, retorna TRUE para validar o campo*/
            return true;
        }
    }

	public function VerificaSenha ($str){
			if($this->EditaUsuarioModel->VerificaSenha($str)){
                	/* existe cadastro, retorna TRUE para validar o campo*/
					return true;
				}else{
                    /* não existe cadastro */
                    $this->form_validation->set_message('VerificaSenha', 'Senha incorreta.');
					return false;
				}
    }
    
    public function PreencheCampos($id){

           foreach ($this->EditaUsuarioModel->getDados($id) as $dados)
           {
               $nome = $dados['nome'];
               $sobrenome = $dados['sobrenome'];
               $id = $dados['id'];
               $email = $dados['email'];
               $rg = $dados['rg'];
               $cpf = $dados['cpf'];
           }

           $data = array('nome' => $nome, 
                             'sobrenome' => $sobrenome ,
                             'email' => $email ,
                             'rg' => $rg ,
                             'cpf' => $cpf   
                            );

           return $data;
    }
}
