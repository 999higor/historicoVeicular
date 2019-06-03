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
    var cont = 0;

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
	      var items = ["<option value='0'>ESCOLHA O ANO</option>"];
	      $.each(data, function(key, val) {
	        items += ("<option value='" + val.id + "'>" + val.name + "</option>");
	      });
	      $("#ano").html(items);
	    });
	  });


    $("#ano").change(function() {
        if(cont == 1){
            var comboAno = document.getElementById("anoMod");
            while (comboAno.length) {
                comboAno.remove(0);
            }
        }
        cont = 1;

        var ano = $('#ano :selected').text();
        var comboAno = document.getElementById("anoMod");

        if($('#ano :selected').val() == 0){
            var opt0 = document.createElement("option");
            opt0.value = "0";
            opt0.text = "";
            comboAno.add(opt0, comboAno.options[0]);
        }else{
            var opt0 = document.createElement("option");
            opt0.value = "/";
            opt0.text = "ESCOLHA O ANO DO MODELO";
            comboAno.add(opt0, comboAno.options[0]);

            var opt0 = document.createElement("option");
            opt0.value = parseInt(ano.substring(-20,4))- 2;
            opt0.text = parseInt(ano.substring(-20,4))- 2;
            comboAno.add(opt0, comboAno.options[0]);

            var opt1 = document.createElement("option");
            opt1.value = parseInt(ano.substring(-20,4)) - 1;
            opt1.text = parseInt(ano.substring(-20,4)) - 1;
            comboAno.add(opt1, comboAno.options[1]);

            var opt2 = document.createElement("option");
            opt2.value = ano.substring(-20,4);
            opt2.text = ano.substring(-20,4);
            comboAno.add(opt2, comboAno.options[2]);

            var opt3 = document.createElement("option");
            opt3.value = parseInt(ano.substring(-20,4)) + 1;
            opt3.text = parseInt(ano.substring(-20,4)) + 1;
            comboAno.add(opt3, comboAno.options[3]);
        }
    });

    //altera o valor do campo hidden para ser enviado ao controller
    $("#ano").change(function() {
        var marca = $('#marcas :selected').text();
        var modelo = $('#veiculos :selected').text();
        var ano = $('#ano :selected').text();
        $('#marca_').val(marca);
        $('#modelo_').val(modelo);
        $('#anof').val(ano);
    });
  });
</script>

</head>
<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Cadastro de Veículo</div>
      <div class="card-body">
        <form method="POST" action="<?php echo base_url();?>index.php/cadVeiculoController/CadastraVeiculo">

          <input type="hidden" id="id" name="id" value="<?php echo $this->session->userdata('id');?>">
          <input type="hidden" id="marca_" name="marca_" value="#">
          <input type="hidden" id="modelo_" name="modelo_" value="#">
          <input type="hidden" id="anof" name="anof" value="#">
          <input type="hidden" id="anom" name="anom" value="#">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <select id="marcas" class="form-control" name="marcas" required="required" autofocus="autofocus"></select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <select id="veiculos" class="form-control" required="required" name="veiculos" autofocus="autofocus"></select>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-label-group">
                        <select id="ano" class="form-control"name="ano" required="required"></select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-label-group">
                    <select id="anoMod" class="form-control" name="anoMod" required="required"></select>
                    </div>
                </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="renavam" class="form-control" placeholder="RENAVAM" name="renavam" maxlength="11" required="required">
                  <label for="renavam">Código de RENAVAM</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="placa" class="form-control" placeholder="Placa" name="placa" maxlength="7" required="required">
                  <label for="placa">Placa do Veículo</label>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" name="button" class="btn btn-primary">Cadastrar</button>
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
