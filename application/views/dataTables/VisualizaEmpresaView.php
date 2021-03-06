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
                            <td><a href="'.base_url().'index.php/EmpresaController/loadEditaEmpresa?id='.$dados['id'].'"><i class="fa fa-edit"></i></a></td>                              
                            <td><a href="#" data-id="'.$dados['id'].'" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></a></td>
                          </tr>';
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
         <div class="card-footer small text-muted">Atualizado "<?php echo date('d/m/Y \à\s H:i:s');?></div>
        </div>

      <!-- Modal de Deletar Empresa-->
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Continuar com a exclusão do registro?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="<?php echo base_url(); ?>index.php/EmpresaController/DeletarEmpresa">
                  <label>Clique em "Confirmar" para deletar a Empresa.</label>
                  <input type="hidden" id="id" name="id" value="#">
                  <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <input class="btn btn-primary " type="submit" value="Enviar" name="input" class="text-center">   
                  </div>
              </form>
            </div>
          </div>
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

            /* quando o modal é aberto ativa a função */
          $('#deleteModal').on('show.bs.modal', function(e) {
              /* pega o valor de ID pela tag data-id no link */
              var idEmpresa = $(e.relatedTarget).data('id');
              /* preenche o valor do campo hidden id com o valor idEmpresa obtido anteriormente */ 
              $(e.currentTarget).find('input[name="id"]').val(idEmpresa);
          });
        </script>    
     