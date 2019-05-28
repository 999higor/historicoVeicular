<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin - Register</title>

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
        <form method="POST" action="<?php echo base_url();?>index.php/cadUsuarioController/CadastrarUsuario">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="nome" class="form-control" placeholder="Nome" required="required" name="nome" autofocus="autofocus">
                  <label for="nome">Nome</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="sobrenome" class="form-control" placeholder="Sobrenome" name="sobrenome" required="required">
                  <label for="sobrenome">Sobrenome</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="hidden" name="cpfUserHidden" id="cpfUserHidden" value="#">
                  <input type="text" id="cpfUser" class="form-control" placeholder="CPF" name="cpfUser" autofocus="autofocus" required>
                  <label for="cpfUser">CPF</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="hidden" name="rgUserHidden" id="rgUserHidden" value="#">
                  <input type="text" id="rgUser" class="form-control" placeholder="RG" name="rgUser" required>
                  <label for="rgUser">RG</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="email" class="form-control" placeholder="Endereço de e-mail" name="email" required>
              <label for="email">E-mail</label>
            </div>
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
          $("#btn").prop("disabled", true);
          $("confirmPassword").prop("disabled", true);
      });

      /* Define um campo oculto com o valor de CPF sem a Máscara (removendo os pontos) */
      $('#cpfUser').focusout(function(){
          $('#cpfUserHidden').val($('#cpfUser').cleanVal());
      });

      /* Define um campo oculto com o valor de RG sem a Máscara (removendo os pontos) */
      $('#rgUser').focusout(function(){
          $('#rgUserHidden').val($('#rgUser').cleanVal());
      });
      
      $("#password").focusout(function(){
        $("#confirmPassword").prop("disabled", false);
          $("#confirmPassword").focusout(function(){
                if()
          })
      });
  </script>

</body>
</html>
