<link href="<?php echo base_url()?>assets/vendor/datepicker/css/daterangepicker.css" rel="stylesheet">

<div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Solicitar uma Manutenção</div>
      <div class="card-body">
        <form method="post" action="<?php echo base_url();?>index.php/ManutencaoController/CadastraManutencaoUsuario">        
            <input hidden id="hiddenCount" name="contagem" value="#">     
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <label class="control-label" for="date">Data estimada (Inicio)</label>
                        <input type="text" class="form-control"  id="dataInicio" name="dataInicio"maxlength="10"/> 
                    </div>
                    <div class="col-md-6">
                        <label class="control-label" for="date">Data estimada (Final)</label>
                        <input type="text" class="form-control" id="dataFim" name="dataFim" maxlength="10" /> 
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label" for="selectEmpresa">Empresa</label>
                <div class="col-md-12 ">
                    <select id="selectbasic" name="selectEmpresa" class="form-control">
                    <?php
                        foreach($empresa as $dados){
                            echo '<option value="'.$dados['id'].'">'.$dados['razaoSocial'].'</option>';
                        }
                     ?>   
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label" for="selectVeiculo">Veiculo</label>
                <div class="col-md-12 ">
                    <select id="selectbasic" name="selectVeiculo" class="form-control">
                    <?php
                        foreach($veiculo as $dados){
                            echo '<option value="'.$dados['id'].'">'.$dados['modelo'].' | PLACA: ' .$dados['placa'].'</option>';
                        }
                     ?>   
                    </select>
                </div>
            </div>
            <div class="form-group elemento-clonado">
            <label class="col-md-12 control-label" for="selectServico">Serviço</label> 
                <div class="col-md-12 ">
                    <select id="selectbasic" name="selectServico0" class="form-control selectbasic">
                    <?php
                        foreach($servico as $dados){
                            echo '<option value="'.$dados['id'].'">'.$dados['nome'].'</option>';
                        }
                     ?>   
                    </select>
                </div>
            </div>         

            <!-- ------------------------------------------- -->
            <div class="impressao-clonagem">
               
            </div>
            <!-- ------------------------------------------- -->

            <p class="add-one">Adicionar serviço</p> 
            <input class="btn btn-primary btn-block" type="submit" value="Enviar" name="input" class="text-center">   
        </form>
       <div class="text-center">
      </div>
    </div>
  </div>
</div>

<!-- Arquivos js necessários para o datePicker e a configuração -->
<script src="<?php echo base_url()?>assets/vendor/datepicker/js/moment.min.js"></script>
<script src="<?php echo base_url()?>assets/vendor/datepicker/js/datepicker.js"></script>
<script>
    $( document ).ready(function() {
        var count = 0; /* inicia contador do select */
        console.log(count);

    /* Formulario dinamico */
    $('.add-one').click(function(){
        count = count+1;
        $("#hiddenCount").val(count+1); /* define a contagem em um campo hidden para facilitar na hora de receber os dados */
        $('.elemento-clonado').first().clone().appendTo('.impressao-clonagem').show(); /* clona a div */
        $('select').last().attr('name', 'selectServico'+count); /* no ultimo select o valor vai ser alterado utilizando a contagem */
        attach_delete();
    });

    function attach_delete(){
        $('.delete').off();
            $('.delete').click(function(){
                console.log("click");
                $(this).closest('.form-group').remove();
            });
        }

    /* Date Picker */
    $(function(){          
        $('#dataInicio , #dataFim').daterangepicker({
            "singleDatePicker": true,
            "startDate": new Date(),
            "endDate": new Date(),
            "minDate": new Date(),
            "opens": "left",
            "locale": {
                "format": "DD-MM-YYYY",
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
            }
        }, function(start, end, label) {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        });
    });
});
</script>

