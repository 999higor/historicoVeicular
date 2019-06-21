<link href="<?php echo base_url()?>assets/vendor/datepicker/css/daterangepicker.css" rel="stylesheet">
<div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Solicitar uma Manutenção</div>
      <div class="card-body">
        <form method="get" action="<?php echo base_url();?>">             
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <label class="control-label" for="date">Data estimada (Inicio)</label>
                        <input type="text" class=" form-control"  value="" id="dataInicio" name="dataInicio" /> 
                    </div>
                    <div class="col-md-6">
                        <label class="control-label" for="date">Data estimada (Final)</label>
                        <input type="text" class=" form-control"  value="" id="dataFim" name="dataFim" /> 
                    </div>
                </div>
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
        $('#dataInicio , #dataFim').daterangepicker({
            "singleDatePicker": true,
            "startDate": new Date(),
            "endDate": new Date(),
            "minDate": new Date(),
            "opens": "left",
            "locale": {
                "format": "DD/MM/YYYY",
                "separator": " - ",
                "applyLabel": "Aplicar",
                "cancelLabel": "Cancelar",
                "fromLabel": "De",
                "toLabel": "Até",
                "customRangeLabel": "Customizar",
                "weekLabel": "Sem",
                "daysOfWeek": [
                    "Dom",
                    "Seg",
                    "Ter",
                    "Qua",
                    "Qui",
                    "Sex",
                    "Sab"
                ],
                "monthNames": [
                    "Janeiro",
                    "Fevereiro",
                    "Março",
                    "Abril",
                    "Maio",
                    "Junho",
                    "Julho",
                    "Agosto",
                    "Setembro",
                    "Outubro",
                    "Novembro",
                    "Dezembro"
                ]
            },
        }, function(start, end, label) {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        });
    });
</script>

<script src="<?php echo base_url()?>assets/vendor/datepicker/js/moment.min.js"></script>
<script src="<?php echo base_url()?>assets/vendor/datepicker/js/daterangepicker.js"></script>