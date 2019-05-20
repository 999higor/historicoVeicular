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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
	  var urlBase = "http://fipeapi.appspot.com/api/1/carros/";
	  $.getJSON(urlBase + "marcas.json", function(data) {
	    var items = ["<option value=\"\">ESCOLHA UMA MARCA</option>"];
	    $.each(data, function(key, val) {
	      items += ("<option value='" + val.id + "'>" + val.name + "</option>");
	    });
	    $("#marcas").html(items);
	  });

	  $("#marcas").change(function() {
	    $.getJSON(urlBase + "veiculos/" + jQuery(this).val() + ".json", function(data) {
	      var items = ["<option value=\"\">ESCOLHA UM VEICULO</option>"];
	      $.each(data, function(key, val) {
	        items += ("<option value='" + val.id + "'>" + val.name + "</option>");
	      });
	      $("#veiculos").html(items);
	    });
	  });

	  $("#veiculos").change(function() {
	    $.getJSON(urlBase + "veiculo/" + jQuery("#marcas").val() + "/" + jQuery(this).val() + ".json", function(data) {
	      var items = ["<option value=\"\">ESCOLHA O ANO</option>"];
	      $.each(data, function(key, val) {
	        items += ("<option value='" + val.id + "'>" + val.name + "</option>");
	      });
	      $("#ano").html(items);
	    });
	  });
	});

</script>

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Registrar um Veículo</div>
      <div class="card-body">
        <form method="POST" action="<?php echo base_url();?>index.php/cadUsuarioController/CadastrarUsuario">
        <!--
placa
renavam
marca
modelo
anoModelo
anoFabricacao
idCliente -->
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="modelo" class="form-control" placeholder="Modelo" required="required" name="modelo" autofocus="autofocus">
                  <label for="modelo">Modelo do Veículo</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="renavan" class="form-control" placeholder="RENAVAN" name="renavan" required="required">
                  <label for="renavam">Código de RENAVAN</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="mara" class="form-control" placeholder="marca" name="marca" required="required" autofocus="autofocus">
                  <label for="marca">Marca</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="placa" class="form-control" placeholder="Placa" name="placa" required="required">
                  <label for="placa">Placa do Veículo</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                    <input type="text" id="anoFab" class="form-control" placeholder="Ano de Fabricação" name="anoFab" required="required">
                    <label for="anoFab">Ano de Fabricação</label>
                </div>
              </div>
              <div class="col-md-6">
                 <div class="form-label-group">
                    <input type="text" id="anoModelo" class="form-control" placeholder="Ano do Modelo" name="anoModelo" required="required">
                    <label for="anoModelo">Ano de Fabricação</label>
                </div>
              </div>
            </div>
          </div>
          <input type="submit" name="input">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="login.html">Login Page</a>
          <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
        </div>
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
