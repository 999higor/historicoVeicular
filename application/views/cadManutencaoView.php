<link href="<?php echo base_url()?>assets/vendor/datepicker/css/daterangepicker.css" rel="stylesheet">
<div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Registrar uma Manutenção</div>
      <div class="card-body">
        <form method="get" action="<?php echo base_url();?>index.php/ServicoController/CadastrarServico">
            <div class="form-group">
                <label class="control-label" for="date">Data estimada</label>
                <input type="text" class="daterange form-control"  value="" name="datas" />
            </div>
            <div class="form-group">
            <label class="col-md-12 control-label" for="selectbasic">Empresa</label>
                <div class="col-md-12 ">
                    <select id="selectbasic" name="selectbasic" class="form-control">
                    <?php
                        foreach($empresa as $dados){
                            echo '<option value="'.$dados['id'].'">'.$dados['razaoSocial'].'</option>';
                        }
                     ?>   
                    </select>
                </div>
            </div>

            <div class="form-group">
            <label class="col-md-12 control-label" for="selectbasic">Veiculo</label>
                <div class="col-md-12 ">
                    <select id="selectbasic" name="selectbasic" class="form-control">
                    <?php
                        foreach($veiculo as $dados){
                            echo '<option value="'.$dados['id'].'">'.$dados['modelo'].' ___ PLACA: ' .$dados['placa'].'</option>';
                        }
                     ?>   
                    </select>
                </div>
            </div>

            <div class="form-group">
            <label class="col-md-12 control-label" for="selectbasic">Serviço</label>
                <div class="col-md-12 ">
                    <select id="selectbasic" name="selectbasic" class="form-control">
                    <?php
                        foreach($servico as $dados){
                            echo '<option value="'.$dados['id'].'">'.$dados['nome'].'</option>';
                        }
                     ?>   
                    </select>
                </div>
            </div>
            <input class="btn btn-primary btn-block" type="submit" value="Enviar" name="input" class="text-center">   
        </form>
       <div class="text-center">
      </div>
    </div>
  </div>
</div>

<script>
    $(function() {           
        $('.daterange').daterangepicker();  
    });

</script>

<script src="<?php echo base_url()?>assets/vendor/datepicker/js/moment.min.js"></script>
<script src="<?php echo base_url()?>assets/vendor/datepicker/js/daterangepicker.js"></script>