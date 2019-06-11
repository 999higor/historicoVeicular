<!-- Se o cliente tiver algum veiculo cadastrado no nome dele entrará nesse if,
        ali dentro o servidor irá escrever a DataTable -->         
<?php
  if(empty($veiculo)){
      echo "<div class='card mb-3' style='display:none'>";
  }else
      echo "<div class='card mb-3'>";
?>   
<div class='card-header'>
  <i class='fas fa-table'></i>
  Veículos cadastrados</div>
    <div class='card-body'>
      <div class='table-responsive'>
        <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
          <thead>
            <tr>
              <th>Modelo</th>
              <th>Marca</th>
              <th>Placa</th>     
              <th>Ano de Fabricação/Modelo</th>               
              <th>Renavam</th>   
              <th></th>                           
              <th></th>               
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Modelo</th>
              <th>Marca</th>
              <th>Placa</th>     
              <th>Ano de Fabricação/Modelo</th>               
              <th>Renavam</th>
              <th></th>                           
              <th></th>          
            </tr>
          </tfoot>
          <tbody> 
          <?php
            foreach($veiculo as $dados){
              echo '<tr>
                        <td>'.$dados['modelo'].'</td>
                        <td>'.$dados['marca'].'</td>
                        <td>'.$dados['placa'].'</td>
                        <td>'.$dados['anoModelo'].'/'.$dados['anoFabricacao'].'</td>
                        <td>'.$dados['renavam'].'</td>
                        <td><a href="'.base_url().'index.php/VeiculoController/loadEditaVeiculo?id='.$dados['id'].'"><i class="fa fa-edit"></i></a></td>                              
                        <td><a href="'.base_url().'"><i class="fa fa-trash"></i></a></td>
                    </tr>';
            }
            ?> 
          </tbody>
          </table>
        </div>
      </div>
      <div class='card-footer small text-muted'>Atualizado <?php echo date('d/m/Y \à\s H:i:s');?></div>
    </div>
  </div>               
   
  <script>
      $(document).ready(function() {
            $('#dataTable').dataTable({   
              searching: false,                           
              oLanguage: {
                sLengthMenu: "Mostrar _MENU_ registros por página",
                sZeroRecords: "Nenhum registro encontrado",
                sInfo: "Mostrando _START_ .. _END_ de _TOTAL_ registro(s)",
                sInfoEmpty: "Mostrando 0 / 0 de 0 registros",
                sInfoFiltered: "(filtrado de _MAX_ registros)",
                sSearch: "Pesquisar: ",
                oPaginate: {
                    sFirst: "Início",
                    sPrevious: "Anterior",
                    sNext: "Próximo",
                    sLast: "Último"
                  }
              }
            })
      });
  </script>