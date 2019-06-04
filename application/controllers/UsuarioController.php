<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class UsuarioController extends CI_Controller {
        public function __construct()
        {
            parent:: __construct();
            $this->load->helper('url');
            $this->load->library('form_validation');
            /* Carrega o Model */
            $this->load->model('UsuarioModel');
        }

        public function VerificaSessao(){
            if(empty($this->session->userdata('cpf'))){
                $this->session->set_flashdata('message', 'Você precisa estar logado para acessar o sistema.');
                $this->session->set_flashdata('status', 2);
                redirect("LoginController/index");
            }
        }

        public function loadCadastraUsuario(){
            $this->load->view('cadUsuarioView');
        }

        public function loadEditaUsuario(){
            $this->VerificaSessao(); 

            $id = $this->session->userdata('id');
            $dados = $this->CarregaDadosViewEditar($id);
            $this->load->view('editarUsuarioView', $dados);
        }

        public function loadVisualizaUsuario(){
            $this->VerificaSessao();

        }

        public function CadastrarUsuario(){
            /* Define as mensagens que aparecerão quando tiver erros */
            $this->form_validation->set_message('alpha', 'Digite letras somente letras no campo {field}.');
            $this->form_validation->set_message('numeric', 'Digite apenas números no campo {field}.');
            $this->form_validation->set_message('min_length', 'No campo {field} é obrigatório o número mínimo de {param} caracteres.');
            $this->form_validation->set_message('max_length', 'O campo {field} suporta apenas {param} caracteres.');
            $this->form_validation->set_message('matches', 'As senhas precisam ser identicas.');

            /* Define as regras de validação do formulário */
            $this->form_validation->set_rules('nome', 'Nome', 'alpha');
            $this->form_validation->set_rules('sobrenome', 'Sobrenome', 'alpha');
            $this->form_validation->set_rules('cpfUser', 'CPF', array('numeric', 'min_length[11]','max_length[11]','callback_VerificaCPF'));
            $this->form_validation->set_rules('rgUser', 'RG', array('numeric','min_length[8]','max_length[14]','callback_VerificaRG'));
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
            else{
                    /* Coleta os dados do formulário por POST */
                    $nome = $this->input->post('nome', TRUE);
                    $sobrenome = $this->input->post('sobrenome', TRUE);
                    $cpf = $this->input->post('cpfUser', TRUE); /* cpfUserHidden pois está sem a máscara */
                    $rg = $this->input->post('rgUser', TRUE); /* rgUserHidden pois está sem a máscara */
                    $email = $this->input->post('email', TRUE);
                    $password = $this->input->post('password', TRUE);
                    $confirmPassword = $this->input->post('confirmPassword', TRUE);

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
                    if($this->UsuarioModel->EfetuaRegistro($dados)){
                        $this->session->set_flashdata('message', 'Usuário criado com sucesso.');
                        $this->session->set_flashdata('status', 1);
                        redirect("LoginController/index");
                    }else{
                        $this->session->set_flashdata('message', 'Erro ao criar usuário.');
                        $this->session->set_flashdata('status', 2);
                        redirect("LoginController/index");
                    }
            }
        }

        public function CarregaDadosViewEditar($id){
            foreach ($this->UsuarioModel->pegaDados($id) as $dados){
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

        /* 
            * 
            *         Verificações no Banco de Dados       *
            *  
        */
        public function VerificaRG($str){
                if($this->UsuarioModel->VerificaRG($str)){
                    /* existe cadastro */
                    $this->form_validation->set_message('VerificaRG', 'Já existe este RG cadastrado no banco de dados.');
                    return false;
                }else{
                    /* não existe cadastro, retorna TRUE para validar o campo*/
                    return true;
                }		
        }

        public function VerificaCPF($str){
                if($this->UsuarioModel->VerificaCPF($str)){
                    /* existe cadastro */
                    $this->form_validation->set_message('VerificaCPF', 'Já existe este CPF cadastrado no banco de dados.');
                    return false;
                }else{
                    /* não existe cadastro, retorna TRUE para validar o campo*/
                    return true;
                }
        }

        public function VerificaEmail($str){
                if($this->UsuarioModel->VerificaEmail($str)){
                        /* existe cadastro */
                        $this->form_validation->set_message('VerificaEmail', 'Já existe este e-mail cadastrado no banco de dados.');
                        return false;
                    }else{
                        /* não existe cadastro, retorna TRUE para validar o campo*/
                        return true;
                    }
        }
    }
