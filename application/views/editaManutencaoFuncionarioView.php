<link href="<?php echo base_url()?>assets/vendor/datepicker/css/daterangepicker.css" rel="stylesheet">
<div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Alterar Manutenção</div>
      <div class="card-body">
      <form>
        <input hidden name="hiddencount" id="hiddencount" value="#">
        <input hidden name="dtInicio" id="dtInicio" value="<?php echo $dados['dataInicial'];?>">
        <input hidden name="dtFinal" id="dtFinal" value="<?php echo $dados['dataFinal'];?>">
        <div class="form-group">
            <div class="row">
                    <div class="col">
                        <b><label for="exampleFormControlInput1">Modelo do Veículo</label></b>
                        <input readonly type="text" class="form-control form-control-plaintext" id="exampleFormControlInput1" value="<?php echo $dados['modeloVeiculo'];?>">
                    </div>
                    <div class="col">
                        <b><label for="exampleFormControlInput1">Placa do Veículo</label></b>
                        <input readonly type="text" class="form-control form-control-plaintext" id="exampleFormControlInput1" value="<?php echo $dados['placaVeiculo']; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <b><label for="exampleFormControlInput1">Status</label></b>
                        <input readonly type="text" class="form-control form-control-plaintext" id="exampleFormControlInput1" value="<?php echo $dados['realizado'];?>">
                    </div>
                    <div class="col">
                        <b><label class="control-label" for="date">Agendada para:</label></b>
                        <input type="text" class="form-control"  id="dataInicio" name="dataInicio" maxlength="10"/> 
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <b><label for="exampleFormControlInput1">Nome do Solicitante</label></b>
                        <input readonly type="text" class="form-control form-control-plaintext" id="exampleFormControlInput1" value="<?php echo $dados['nomeSolicitante']."".$dados['sobrenomeSolicitante'];?>">
                    </div>
                    <div class="col">
                        <b><label for="exampleFormControlInput1">Hora de Solicitação</label></b>
                        <input readonly type="text" class="form-control form-control-plaintext" id="exampleFormControlInput1" value="<?php echo $dados['dthrSolicitacao']; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <p class="add-one"><span class="add-one fa fa-plus"> </span> Adicionar produtos utilizados</p>               
                <div class="impressao-clonagem ">
                    <!-- Aqui serão inseridos os produtos -->
                </div>  
            </div>

        </form>
       <div class="text-center">
       <hr>
       <label>Última modificação feita em: <b><?php echo $dados['ultimaModificacao'];?></b></label>
      </div>
    </div>
  </div>
</div>

<div class="elemento-clonado" style="display:none">
    <b><label for="exampleFormControlInput1">Selecione um produto</label></b>
    <div class="row">
        <div class="col-md-11">
                <select class="browser-default custom-select">
                <?php
                    foreach($produto as $dados){
                        echo '<option value="'.$dados['id'].'">'.$dados['nome'].'</option>';
                    }
                ?>         
                </select>
        </div>
        <span class="input-group-btn">
            <button class="btn-add btn btn-secondary" type="button">
            <p class="add-one"><span class="add-one fa fa-plus"> </span></p>
            </button>
        </span>
    </div>
</div>

<script src="<?php echo base_url()?>assets/vendor/datepicker/js/moment.min.js"></script>
<script src="<?php echo base_url()?>assets/vendor/datepicker/js/datepicker.js"></script>
<script>
 $( document ).ready(function() {
    var count = 0; /* inicia contador do select */
    /* Pega as datas para Aplicar no datePicker */
    var dataInicio = $( "#dtInicio" ).val();
    var dataFinal = $( "#dtFinal" ).val();

    /* Converte as datas */
    var dataInicio = moment(dataInicio, "YYYY-MM-DD").format("DD.MM.YYYY");
    var dataFinal = moment(dataFinal, "YYYY-MM-DD").format("DD.MM.YYYY");

    /* Formulario dinamico */
    $('.add-one').click(function(){
        count = count+1;
        $("#hiddenCount").val(count); /* define a contagem em um campo hidden para facilitar na hora de receber os dados */
        $('.elemento-clonado').first().clone().appendTo('.impressao-clonagem').show(); /* clona a div */
        $('select').last().attr('name', 'selectProduto'+count); /* no ultimo select o valor vai ser alterado utilizando a contagem */
        attach_delete();
    });

    $(function(){          
        $('#dataInicio').daterangepicker({
            "singleDatePicker": true,
            "startDate": dataInicio,
            "endDate": dataFinal,
            "minDate": dataInicio,
            "maxDate": dataFinal,
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

$('.btn-add').click(function(){
        count = count+1;
        $("#hiddenCount").val(count); /* define a contagem em um campo hidden para facilitar na hora de receber os dados */
        $('.elemento-clonado').first().clone().appendTo('.impressao-clonagem').show(); /* clona a div */
        $('select').last().attr('name', 'selectProduto'+count); /* no ultimo select o valor vai ser alterado utilizando a contagem */
        attach_delete();
});


</script>