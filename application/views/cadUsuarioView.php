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
  <script src="<?php echo base_url()?>assets/js/validator.min.js"></script>

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url()?>assets/css/sb-admin.css" rel="stylesheet">

  <script>
    function validaCampos() {
      var p1 = document.getElementById('password').value;  
      var p2 = document.getElementById('confirmPassword').value;

      if(p1 != p2){
        alert("As senhas não conferem.");
      }
    }
  </script>
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
                  <input type="text" id="sobrenome" pattern="[a-zA-Z\s]+$" class="form-control" placeholder="Sobrenome" name="sobrenome" required="required">
                  <label for="sobrenome">Sobrenome</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="cpfUser" class="form-control" placeholder="CPF" name="cpfUser" required="required" autofocus="autofocus">
                  <label for="cpfUser">CPF</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="rgUser" class="form-control" placeholder="RG" name="rgUser" required="required">
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
                  <input type="password" id="password" class="form-control" name="password" placeholder="Senha" required="required">
                  <label for="password">Senha</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="confirmPassword" class="form-control" onblur="validaCampos();" placeholder="Confirmar senha" name="confirmPassword" required>
                  <label for="confirmPassword">Confirmar Senha</label>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <input class="btn btn-primary" type="submit" name="input">
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url()?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
