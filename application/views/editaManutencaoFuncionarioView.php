<?php $ultimaAlteração = date("d/m/Y H:i:s", strtotime($dados['ultimaModificacao']));?>
<link href="<?php echo base_url()?>assets/vendor/datepicker/css/daterangepicker.css" rel="stylesheet">
<div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Alterar Manutenção</div>
      <div class="card-body">
      <form method="post" action="<?php echo base_url();?>index.php/ManutencaoController/EditarManutencaoFuncionario">
        <input hidden name="hiddenCount" id="hiddenCount" value="#">
        <input hidden name="dtInicio" id="dtInicio" value="<?php echo $dados['dataInicial'];?>">
        <input hidden name="dtFinal" id="dtFinal" value="<?php echo $dados['dataFinal'];?>">
        <input hidden name="idManutencao" id="idManutencao" value="<?php echo $dados['idManutencao'];?>">
        <div class="form-group">
            <div class="row">
                    <div class="col">
                        <b><label for="exampleFormControlInput1">Modelo do Veículo</label></b>
                        <input readonly type="text" name="modeloVeiculo" class="form-control form-control-plaintext" id="exampleFormControlInput1" value="<?php echo $dados['modeloVeiculo'];?>">
                    </div>
                    <div class="col">
                        <b><label for="exampleFormControlInput1">Placa do Veículo</label></b>
                        <input readonly type="text" name="placaVeiculo" class="form-control form-control-plaintext" id="exampleFormControlInput1" value="<?php echo $dados['placaVeiculo']; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <b><label for="exampleFormControlInput1">Status</label></b>
                        <input readonly type="text" name="status" class="form-control form-control-plaintext" id="exampleFormControlInput1" value="<?php echo $dados['realizado'];?>">
                    </div>
                    <div class="col">
                        <b><label class="control-label" for="date">Agendada para:</label></b>
                        <input type="text" name="dataAtribuida" class="form-control"  id="dataInicio" name="dataInicio" maxlength="10"/> 
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <b><label for="exampleFormControlInput1">Nome do Solicitante</label></b>
                        <input readonly type="text" name="nomeSolicitante" class="form-control form-control-plaintext" id="exampleFormControlInput1" value="<?php echo $dados['nomeSolicitante']."".$dados['sobrenomeSolicitante'];?>">
                    </div>
                    <div class="col">
                        <b><label for="exampleFormControlInput1">Hora de Solicitação</label></b>
                        <input readonly type="text" name="dthrSolicitacao" class="form-control form-control-plaintext" id="exampleFormControlInput1" value="<?php echo $dados['dthrSolicitacao']; ?>">
                    </div>
                </div>
            </div>

            <!-- Data Table Serviço -->
            <!-- <div class="form-group servicoHidden" style="display:none">
                <table id="servico" class="table" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome do Serviço</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        // foreach($servico as $dados){
                        //     echo '<tr>
                        //               <td>'.$dados['id'].'</td>
                        //               <td>'.$dados['nome'].'</td>
                        //           <tr>';
                        // }
                    ?>
                    </tbody>
                </table>
            </div> -->
            <!-- Data Table Serviço
            <div class="form-group">
                <table id="servico" class="table" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome do Produto</th>
                            <th>Marca do Produto</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        // foreach($produtosCadastrados as $dados){
                        //     echo '<tr>
                        //               <td>'.$dados['id'].'</td>
                        //               <td>'.$dados['nome'].'</td>
                        //           <tr>';
                        // }
                    ?>
                    </tbody>
                </table>
            </div> -->

            <!-- Elemento que será clonado -->
            <div class="elemento-clonado form-group" style="display:none">
                <b><label for="cbproduto">Selecione um produto</label></b>
                <div class="row">
                    <div class="col-md-11">
                            <select id="selectProduto" name="#" class="browser-default custom-select">
                            <?php
                                
                                foreach($produto as $dados){
                                    echo '<option value="'.$dados['id'].'">'.$dados['nome'].'</option>';
                                }
                            ?>         
                            </select>
                    </div>
                    <span class="input-group-btn">
                        <button class="add-one btn btn-secondary" type="button">
                        <span class="fa fa-plus"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <p class="add-one remove-paragrafo"><span class="add-one fa fa-plus"> </span> Adicionar produtos utilizados</p>               
                <div class="impressao-clonagem ">
                    <!-- Aqui serão inseridos os produtos -->
                </div>  
            </div>
            <div class="text-center">
                <input class="btn btn-secondary" value="Alterar Manutenção" type="submit" name="submit">
            </div>
        </form>
       <div class="text-center">
       <hr>
       <label>Última modificação feita em: <b><?php echo $ultimaAlteração;?></b></label>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url()?>assets/vendor/datepicker/js/moment.min.js"></script>
<script src="<?php echo base_url()?>assets/vendor/datepicker/js/datepicker.js"></script>
<script>
 $(document).ready(function() {
    var count = 0; /* inicia contador do select */
    /* Pega as datas para Aplicar no datePicker */
    var dataInicio = $( "#dtInicio" ).val();
    var dataFinal = $( "#dtFinal" ).val();

    /* Converte as datas */
    var dataInicio = moment(dataInicio, "YYYY-MM-DD").format("DD.MM.YYYY");
    var dataFinal = moment(dataFinal, "YYYY-MM-DD").format("DD.MM.YYYY");

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

    $(document).on('click','.add-one',function(){
        count = count+1;
        console.log(count);
        $('#hiddenCount').val(count); /* define a contagem em um campo hidden para facilitar na hora de receber os dados */
        $('.elemento-clonado').first().clone().appendTo('.impressao-clonagem').show(); /* clona a div */
        $('select').last().attr('name', 'selectProduto'+count); /* no ultimo select o valor vai ser alterado utilizando a contagem */
        $('.remove-paragrafo').hide();
    });
});
</script>