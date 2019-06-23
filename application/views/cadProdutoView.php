<div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Registrar um Produto</div>
      <div class="card-body">
            <form method="POST" action="<?php echo base_url();?>index.php/ProdutoController/CadastrarProduto">   
                <div class="form-group">
                    <div class="form-label-group">
                      <input type="text" id="nome" class="form-control" placeholder="Nome" name="nome" autofocus required>
                      <label for="nome">Nome</label>
                    </div>            
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                      <input type="text" id="marca" class="form-control" placeholder="Marca" name="marca" value="Não definida">
                      <label for="marca">Marca</label>
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