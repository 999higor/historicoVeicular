<?php
/* echo $this->session->userdata('');*/
   defined('BASEPATH') OR exit('No direct script access allowed');
   date_default_timezone_set('America/Sao_Paulo');
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url()?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="<?php echo base_url()?>assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url()?>assets/css/sb-admin.css" rel="stylesheet">

</head>
<body id="page-top">
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="<?php echo base_url();?>index.php/MainController">Nome do Software</a>
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">Settings</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/LoginController/logout" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>
  </nav>

  <div id="wrapper">
    <!-- Sidebar  -->
    <ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url();?>index.php/cadVeiculoController/index">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Cadastrar Veículo</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li>
    </ul>
    <div id="content-wrapper">
      <div class="container-fluid">

   <!-- Se o cliente tiver algum veiculo cadastrado no nome dele entrará nesse if,
        ali dentro o servidor irá escrever a DataTable -->
        <?php
        if(!empty($veiculo)){
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
                ";                
                foreach($veiculo as $info):
                      echo '<tr>';
                         echo '<td>'.$info['id'].'</td>';
                         echo '<td>'.$info['placa'].'</td>';
                         echo '<td>'.$info['renavam'].'</td>';
                         echo '<td>'.$info['marca'].'</td>';
                         echo '<td>'.$info['modelo'].'</td>';
                         echo '<td>'.$info['anoFabricacao'].'/'.$info['anoModelo'].'</td>';
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
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2019</span>
          </div>
        </div>
      </footer>
    </div>
    <!-- /.content-wrapper -->
  </div>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirmar</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Selecione "Logout" se desejas mesmo sair.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="<?php echo base_url(); ?>index.php/MainController/logout">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url()?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="<?php echo base_url()?>assets/vendor/chart.js/Chart.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/datatables/jquery.dataTables.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url()?>assets/js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="<?php echo base_url()?>assets/js/demo/datatables-demo.js"></script>
  <script src="<?php echo base_url()?>assets/js/demo/chart-area-demo.js"></script>

</body>

</html>
