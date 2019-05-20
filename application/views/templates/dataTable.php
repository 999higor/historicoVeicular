<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Veículos cadastrados</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID do Veículo</th>
                    <th>Placa</th>
                    <th>Renavam</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Ano de Fabricação/Modelo</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>ID do Veículo</th>
                    <th>Placa</th>
                    <th>Renavam</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Ano de Fabricação/Modelo</th>
                  </tr>
                </tfoot>
                <tbody>                  
                <?php
                  foreach($veiculo as $info):
                      echo "<tr>";
                         echo '<td>'.$info['id'].'</td>';
                         echo '<td>'.$info['placa'].'</td>';
                         echo '<td>'.$info['renavam'].'</td>';
                         echo '<td>'.$info['marca'].'</td>';
                         echo '<td>'.$info['modelo'].'</td>';
                         echo '<td>'.$info['anoFabricacao'].'/'.$info['anoModelo'].'</td>';

                      echo "<tr>";
                  endforeach;
               ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Atualizado <?php echo date('d/m/Y \à\s H:i:s');?></div>
        </div>
      </div>