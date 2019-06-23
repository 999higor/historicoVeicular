<div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Registrar um tipo de Serviço</div>
      <div class="card-body">
        <form method="POST" action="<?php echo base_url();?>index.php/ServicoController/CadastrarServico">
            <div class="form-group">
                <div class="form-label-group">
                    <input type="text" id="nome" class="form-control" placeholder="Nome do Serviço" name="nome" required>
                    <label for="nome">Nome do Serviço</label>
                </div>
            </div>
            <hr>
            <input class="btn btn-primary btn-block" type="submit" value="Enviar" name="input" class="text-center">   
        </form>
       <div class="text-center">
      </div>
    </div>
  </div>
</div>