<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Cadastro de Produto</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url()?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url()?>assets/css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Registrar um Produto</div>
      <div class="card-body">
        <form method="POST" action="<?php echo base_url();?>index.php/cadProdutoController/CadastrarProduto">   

          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="marca" class="form-control" placeholder="Marca" name="marca" required="required">
              <label for="marca">Marca</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="nome" class="form-control" placeholder="Nome" name="nome" required="required">
              <label for="nome">Nome</label>
            </div>            
        </div>

        <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="quantidade" class="form-control" placeholder="Quantidade" required="required" name="quantidade" autofocus="autofocus">
                  <label for="quantidade">Quantidade</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="valor" class="form-control" placeholder="Preço" name="valor" required="required">
                  <label for="valor">Preço</label>
                </div>
              </div>
            </div>
          </div>
                 
        <input class="btn btn-primary btn-block" type="submit" value="Enviar" name="input" class="text-center">   
        </form>
        <div class="text-center">
           

        </div>
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
         $('#quantidade').mask('00000000000', {reverse: true});
         $('#valor').mask("###0.00", {reverse: true});
         
      });

      /* Quando o botão enviar é clicado o texto do campo cpfUser e rgUser é copiado
         para os campos ocultos/hidden sem a mascara e enviados para o controler pelo 
         método .submit()
      */
      $('#btn').click(function(){
        /* .cleanVal() tira as pontuações de rg e cpf */
        $('#quantidade').val($('#quantidade').cleanVal());
        //$('#valor').val($('#valor').cleanVal());

        /* envia o formulário pro controller */
        $('#btn').submit();
      });
      </script>

</body>

</html>
