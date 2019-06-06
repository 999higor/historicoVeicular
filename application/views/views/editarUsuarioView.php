<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Registro de Usuário</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url()?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url()?>assets/css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Registrar um Usuário</div>
      <div class="card-body">
        <form method="POST" action="<?php echo base_url();?>index.php/UsuarioController/EditarUsuario">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input style="text-transform: uppercase;" type="text" id="nome" class="form-control" placeholder="Nome" required="required" name="nome" value="<?php echo set_value('nome', $nome);?>" autofocus="autofocus">
                  <label for="nome">Nome</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input style="text-transform: uppercase;" type="text" id="sobrenome" class="form-control" placeholder="Sobrenome" name="sobrenome" value="<?php echo set_value('sobrenome', $sobrenome);?>" required="required">
                  <label for="sobrenome">Sobrenome</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="cpfUser" class="form-control" placeholder="CPF" name="cpfUser" autofocus="autofocus" disabled value="<?php echo set_value('cpfUser', $cpf);?>" required>
                  <label for="cpfUser">CPF</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="rgUser" class="form-control" placeholder="RG" name="rgUser" value="<?php echo set_value('rgUser', $rg);?>" disabled required>
                  <label for="rgUser">RG</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="email" class="form-control" placeholder="Endereço de e-mail" name="email" value="<?php echo set_value('email', $email);?>" required>
              <label for="email">E-mail</label>
            </div>
          </div>
          <div class="form-group">
            <input type="checkbox" id="cbConfirma">Confirmar alteração
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="password" class="form-control" name="password" placeholder="Senha" required>
                  <label for="password">Senha</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="confirmPassword" class="form-control" placeholder="Confirmar senha" name="confirmPassword" required>
                  <label for="confirmPassword">Confirmar Senha</label>
                  <span class="class-danger" id='error'></span>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <!-- Caso o controller retornar algum erro irá aparecer uma div de alerta com a mensagem de erro -->
          <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
          <input class="btn btn-primary" type="submit" id="btn"  name="input">
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url()?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- JQuery Mask -->
  <script src="<?php echo base_url()?>assets/vendor/validator/jquery.mask.min.js"></script>
  <script>
      /* Máscaras que definem:
            - CPF e RG: somente números
            - Nome e Sobrenome: somente letras
      */
      $(document).ready(function(){
          $('#cpfUser').mask('000.000.000-00', {reverse: true});
          $('#rgUser').mask('00.000.000-0', {reverse: true});
          $('#nome').mask('Z',{translation:  {'Z': {pattern: /[a-zA-Z ]/, recursive: true}}});
          $('#sobrenome').mask('Z',{translation:  {'Z': {pattern: /[a-zA-Z ]/, recursive: true}}});
          
          $('#btn').prop('disabled', true);
          $('#password').prop('disabled',true);
          $('#confirmPassword').prop('disabled',true);
      });

      $(document).ready(function(){
        $('#cbConfirma').click(function(){
            if($(this).prop("checked") == true){
                $('#password').prop('disabled',false);
                $('#confirmPassword').prop('disabled',false);
            }
            else if($(this).prop("checked") == false){
                $('#password').prop('disabled',true);
                $('#confirmPassword').prop('disabled',true);
            }
        });
    });

      /* Quando o botão enviar é clicado o texto do campo cpfUser e rgUser é copiado
         para os campos ocultos/hidden sem a mascara e enviados para o controler pelo 
         método .submit()
      */
      $('#btn').click(function(){
        /* .cleanVal() tira as pontuações de rg e cpf */
        $('#cpfUser').val($('#cpfUser').cleanVal());
        $('#rgUser').val($('#rgUser').cleanVal());

        /* envia o formulário pro controller */
        $('#btn').submit();
      });

      /* Quando os inputs 'password' e 'confirmPassword' são digitados faz a verificação se eles são iguais */
      $('#password, #confirmPassword').on('keyup', function () {
          if ($('#password').val() != $('#confirmPassword').val()) {
              /* se forem diferentes desabilita o botão e mostra alerta */
              $('#error').html('As senhas precisam ser idênticas.').css('color', 'red');
              $('#btn').prop('disabled', true);
          }else{
            /*se forem iguais retira o alerta e habilita o  botão de enviar */
              $('#error').html('').css('color', 'green');
              $('#btn').prop('disabled', false);
          } 
      });
  </script>

</body>
</html>
