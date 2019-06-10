<div class="container">
  <div class="card card-register mx-auto mt-5">
    <div class="card-header">Registrar uma Empresa</div>
    <div class="card-body">
      <form method="POST" action="<?php echo base_url();?>index.php/EmpresaController/CadastrarEmpresa">
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-6">
              <div class="form-label-group">
                <input style="text-transform:uppercase;" type="text" id="razaoSocial" class="form-control" placeholder="Razão Social" required="required" name="razaoSocial" autofocus="autofocus">
                <label for="razaoSocial">Razão Social</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-label-group">
                <input style="text-transform:uppercase;" type="text" id="nomeFantasia" class="form-control" placeholder="Nome Fantasia" name="nomeFantasia" required="required">
                <label for="nomeFantasia">Nome Fantasia</label>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="form-label-group">
            <input type="text" id="cnpj" class="form-control" placeholder="CNPJ" name="cnpj" required="required">
            <label for="cnpj">CNPJ</label>
          </div>
        </div>
        <div class="form-group">
          <div class="form-label-group">
            <input type="text" id="email" class="form-control" placeholder="email" name="email" required="required">
            <label for="email">E-mail</label>
          </div>            
      </div>                
      <input class="btn btn-primary btn-block" type="submit" value="Enviar" name="input" class="text-center">   
      </form>
      <div class="text-center">
      </div>
    </div>
  </div>
</div>

<!-- JQuery Mask -->
<script src="<?php echo base_url()?>assets/vendor/validator/jquery.mask.min.js"></script>
<script>
      /* Máscaras que definem:
            - CPF e RG: somente números
            - Nome e Sobrenome: somente letras
      */
      $(document).ready(function(){
         $('#cnpj').mask('00.000.000/0000-00', {reverse: true});
      });

      /* Quando o botão enviar é clicado o texto do campo cpfUser e rgUser é copiado
         para os campos ocultos/hidden sem a mascara e enviados para o controler pelo 
         método .submit()
      */
      $('#btn').click(function(){
        /* .cleanVal() tira as pontuações de rg e cpf */
        $('#cnpj').val($('#cnpj').cleanVal()); 

        /* envia o formulário pro controller */
        $('#btn').submit();
      });
</script>