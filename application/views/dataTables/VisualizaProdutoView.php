<!-- Se o cliente tiver algum veiculo cadastrado no nome dele entrará nesse if,
        ali dentro o servidor irá escrever a DataTable -->
        <?php
        if(!empty($produto)){
          echo "
          <div class='card mb-3'>
          <div class='card-header'>
            <i class='fas fa-table'></i>
            Veículos cadastrados</div>
          <div class='card-body'>
            <div class='table-responsive'>
              <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                <thead>
                  <tr>
                    <th>Marca</th>
                    <th>Nome</th>
                    <th>Quantidade</th>     
                    <th>Valor</th>                                
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Razão Social</th>
                    <th>Nome Fantasia</th>
                    <th>CNPJ</th>     
                    <th>E-mail:</th>         
                  </tr>
                </tfoot>
                <tbody> 
                ";          
                foreach($produto as $info):
                      echo '<tr>';
                         echo '<td style="text-transform:uppercase">'.$info['marca'].'</td>';
                         echo '<td style="text-transform:uppercase">'.$info['nome'].'</td>';
                         echo '<td style="text-transform:uppercase">'.$info['quantidade'].'</td>';
                         echo '<td style="text-transform:uppercase">'.$info['valor'].'</td>';
                      echo '<tr>';
                endforeach;                  
                echo "
                </tbody>
                </table>
              </div>
            </div>
            <div class='card-footer small text-muted'>Atualizado ".date('d/m/Y \à\s H:i:s')."</div>
          </div>
        </div>             
        ";
      };
?>       