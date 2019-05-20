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

  <title>SB Admin - Login</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url()?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url()?>assets/css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
      <form method="POST" action="<?php echo base_url();?>index.php/LoginController/verificaLogin">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="cpfLogin" name="cpfLogin" class="form-control" placeholder="Digite seu CPF" autofocus="autofocus" required>
              <label for="cpfLogin">CPF</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="passwrd" name="passwrd" class="form-control" placeholder="Digite a senha" required>
              <label for="passwrd">Senha</label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">
                Remember Password
              </label>
            </div>
          </div>
          <input class="btn btn-primary btn-block" type="submit" value="Enviar">

          <?php echo $this->session->flashdata("error") ?>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="<?php echo base_url();?>index.php/cadUsuarioController">Registrar um usuário</a>
        </div>
        <hr>
          <?php
            if(isset($message)){
              if($status == 1){
                echo "<div class='alert alert-success' role='alert'>";
                      echo "<label text-align='center'>".$message."</label>";
                echo "</div>";

              }else if($status == 2){
                echo "<div class='alert alert-danger' role='alert'>";
                      echo "<label text-align='center'>".$message."</label>";
                echo "</div>";
              }
            }
          ?>
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