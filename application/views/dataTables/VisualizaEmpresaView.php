<!-- Se o cliente tiver algum veiculo cadastrado no nome dele entrará nesse if,
        ali dentro o servidor irá escrever a DataTable -->
        <?php
        if(empty($empresa)){
          echo "<div class='card mb-3' style='display:none'>";
        }else
          echo "<div class='card mb-3'>";
          ?>        
          <div class="card-header">
            <i class="fas fa-table"></i>
            Empresas</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Razão Social</th>
                    <th>Nome Fantasia</th>
                    <th>CNPJ</th>     
                    <th>E-mail</th>  
                    <th></th>                           
                    <th></th> 
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Razão Social</th>
                    <th>Nome Fantasia</th>
                    <th>CNPJ</th>     
                    <th>E-mail</th>  
                    <th></th>                           
                    <th></th>        
                  </tr>
                </tfoot>
                <tbody> 
                <?php
                  foreach($empresa as $dados){
                    echo '<tr>
                            <td>'.$dados['razaoSocial'].'</td>
                            <td>'.$dados['nomeFantasia'].'</td>
                            <td>'.$dados['cnpj'].'</td>
                            <td>'.$dados['email'].'</td>
                            <td><a href="'.base_url().'index.php/ProdutoController/loadVisualizaProduto"><i class="fa fa-edit"></i></a></td>                              
                            <td><a href=""><i class="fa fa-trash"></i></a></td>
                          </tr>';
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
         <div class="card-footer small text-muted">Atualizado "<?php echo date('d/m/Y \à\s H:i:s');?></div>
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
     