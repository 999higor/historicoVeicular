<div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Editar um tipo de Serviço</div>
      <div class="card-body">
      <form method="post" action="<?php echo base_url();?>index.php/ServicoController/EditarServico">
            <div class="form-group">
                <input value="<?php echo set_value('id', @$id);?>" name="id" hidden>
                <div class="form-label-group">
                    <input type="text" id="nome" class="form-control" placeholder="Nome do Serviço" name="nome" value="<?php echo set_value('nome', @$nome);?>" required>
                    <label for="nome">Nome do Serviço</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-label-group">
                    <input type="text" id="valor" class="form-control" placeholder="Valor" name="valor" value="<?php echo set_value('valor', @$valor);?>" required>
                    <label for="valor">Valor</label>
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
        $('#valor').mask("###0.00", {reverse: true});
    });
  </script>
