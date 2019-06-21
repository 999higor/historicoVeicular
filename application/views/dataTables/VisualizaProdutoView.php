<!-- Se o cliente tiver algum veiculo cadastrado no nome dele entrará nesse if,
        ali dentro o servidor irá escrever a DataTable -->
        <?php
        if(empty($produto)){
          echo "<div class='card mb-3' style='display:none'>";
        }else
          echo "<div class='card mb-3'>";
        ?>    
          <div class='card-header'>
            <i class='fas fa-table'></i>
            Produtos cadastrados para a empresa <b><?php echo $nomeEmpresa;?></b> (mostrando somente produtos ativos)</div>
              <div class='card-body'>
                <div class='table-responsive'>
                  <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>Marca</th>
                        <th>Quantidade</th>     
                        <th>Valor</th>
                        <th></th>                           
                        <th></th>                                  
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Nome</th>
                        <th>Marca</th>
                        <th>Quantidade</th>     
                        <th>Valor</th>     
                        <th></th>                           
                        <th></th>    
                      </tr>
                    </tfoot>
                    <tbody> 
                    <?php
                        foreach($produto as $dados){
                          echo '<tr>
                                  <td>'.$dados['nome'].'</td>
                                  <td>'.$dados['marca'].'</td>
                                  <td>'.$dados['quantidade'].'</td>
                                  <td>'.$dados['valor'].'</td>
                                  <td><a href="'.base_url().'index.php/ProdutoController/loadEditarProduto?id='.$dados['id'].'"><i class="fa fa-edit"></i></a></td>                              
                                  <td><a href="#" data-id="'.$dados['id'].'" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></a></td>
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

            <!-- Modal de Deletar Servico-->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Continuar desativando o registro?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method="POST" action="<?php echo base_url(); ?>index.php/ProdutoController/DesabilitarProduto">
                        <label>Clique em "Confirmar" para desativar o produto.</label>
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
                        searching: true,                           
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
                    var idProduto = $(e.relatedTarget).data('id');
                    /* preenche o valor do campo hidden id com o valor idServico obtido anteriormente */ 
                    $(e.currentTarget).find('input[name="id"]').val(idProduto);
                });
            </script>