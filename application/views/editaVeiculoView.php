<div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Edite seu Veículo</div>
      <div class="card-body">
      <form method="post" action="<?php echo base_url();?>index.php/VeiculoController/EditarVeiculo">
            <div class="form-group">
                <input value="<?php echo set_value('id', @$id);?>" name="id" hidden>
                <div class="form-label-group">
                    <input type="text" id="marca" class="form-control" placeholder="marca do Serviço" name="marca" value="<?php echo set_value('marca', @$marca);?>" required>
                    <label for="marca">Marca do Veículo</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-label-group">
                    <input type="text" id="modelo" class="form-control" placeholder="modelo" name="modelo" value="<?php echo set_value('modelo', @$modelo);?>" required>
                    <label for="modelo">Modelo</label>
                </div>            
            </div>
            <div class="form-group">
                <div class="form-label-group">
                    <input type="text" id="anoModelo" class="form-control" placeholder="anoModelo" name="anoModelo" value="<?php echo set_value('anoModelo', @$anoModelo);?>" required>
                    <label for="anoModelo">Ano Modelo</label>
                </div>            
            </div>
            <div class="form-group">
                <div class="form-label-group">
                    <input type="text" id="anoFabricacao" class="form-control" placeholder="anoFabricacao" name="anoFabricacao" value="<?php echo set_value('anoFabricacao', @$anoFabricacao);?>" required>
                    <label for="ano">Ano Fabricação</label>
                </div>            
            </div>
            <div class="form-group">
                <div class="form-label-group">
                    <input type="text" id="placa" class="form-control" placeholder="placa" name="placa" value="<?php echo set_value('placa', @$placa);?>" required>
                    <label for="placa">Placa</label>
                </div>            
            </div>
            <div class="form-group">
                <div class="form-label-group">
                    <input type="text" id="renavam" class="form-control" placeholder="renavam" name="renavam" value="<?php echo set_value('renavam', @$renavam);?>" required>
                    <label for="renavam">Renavam</label>
                </div>            
            </div>
            <input class="btn btn-primary btn-block" type="submit" value="Editar" name="input" class="text-center">   
        </form>
       <div class="text-center">
      </div>
    </div>
  </div>
</div>