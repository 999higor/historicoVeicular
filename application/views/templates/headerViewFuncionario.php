<?php
  //echo $this->session->userdata('cpf');
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

  <title>SB Admin - Página Inicial</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url()?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="<?php echo base_url()?>assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url()?>assets/css/sb-admin.css" rel="stylesheet"> 

</head>
<body id="page-top">
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="<?php echo base_url();?>index.php/MainController"><b>Software</b> .Admin</a>
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <!-- <div class="input-group">
        <input type="text" class="form-control" placeholder="Pesquisar" aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div> -->
      <label style="color: white"><b>Funcionário</b></label>
    </div>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">     
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <h1 style="color:gray" class="dropdown-header">Você está logado como <b><?php echo $this->session->userdata('nome').' '.$this->session->userdata('sobrenome');?></b>.</h1>
          <div class="dropdown-divider"></div>      
          <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/UsuarioController/loadEditaUsuario" >Editar conta</a>
          <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/LoginController/logout" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>
  </nav>

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
          <a class="btn btn-primary" href="<?php echo base_url(); ?>index.php/LoginController/logout">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <div id="wrapper">
    <!-- Sidebar  -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
          <a class="nav-link dropdown-toggle" id="dropdownVeiculos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-car"></i>
            <span>Veículos</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownVeiculos">
            <a class="dropdown-item" href="<?php echo base_url();?>index.php/VeiculoController/loadVisualizaVeiculos">Visualizar Veiculo</a>
            <a class="dropdown-item" href="<?php echo base_url();?>index.php/VeiculoController/loadCadastraVeiculo">Cadastrar Veiculo</a>
          </div>
      </li>
      <li class="nav-item active">
          <a class="nav-link dropdown-toggle" id="dropdownEmpresas" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-building"></i>
            <span>Empresas</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownEmpresas">
            <a class="dropdown-item" href="<?php echo base_url();?>index.php/EmpresaController/loadVisualizaEmpresa">Visualizar Empresas</a>
            <a class="dropdown-item" href="<?php echo base_url();?>index.php/EmpresaController/loadCadastraEmpresa">Cadastrar Empresa</a>
          </div>
      </li>
      <li class="nav-item active">
          <a class="nav-link dropdown-toggle" id="dropdownProduto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-dolly-flatbed"></i>
            <span>Produtos</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownProduto">
            <a class="dropdown-item" href="<?php echo base_url();?>index.php/ProdutoController/loadVisualizaProduto">Visualizar Produtos</a>
            <a class="dropdown-item" href="<?php echo base_url();?>index.php/ProdutoController/loadCadastraProduto">Cadastrar Produto</a>
          </div>
      </li>
      <li class="nav-item active">
          <a class="nav-link dropdown-toggle" id="dropdownServicos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-dolly-flatbed"></i>
            <span>Serviços</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownServicos">
            <a class="dropdown-item" href="<?php echo base_url();?>index.php/ServicoController/loadVisualizaServico">Visualizar Serviços</a>
            <a class="dropdown-item" href="<?php echo base_url();?>index.php/ServicoController/loadCadastraServico">Cadastrar Serviço</a>
          </div>
      </li>
      <li class="nav-item active">
          <a class="nav-link dropdown-toggle" id="dropdownManutencao" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-dolly-flatbed"></i>
            <span>Manutenção</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownManutencao">
            <a class="dropdown-item" href="<?php echo base_url();?>index.php/ManutencaoController/..">Visualizar Manutenções</a>
            <a class="dropdown-item" href="<?php echo base_url();?>index.php/ManutencaoController/loadCadastraManutencao">Cadastrar Manutenção</a>
          </div>
      </li>
    </ul>

    <div id="content-wrapper">
      <div class="container-fluid">
      <?php
            if(empty($message)){
              $message = $this->session->flashdata('message');
              $status = $this->session->flashdata('status');
            }

            if(isset($message)){
              if($status == 1){
                echo "<div class='alert alert-success' role='alert'>";
                      echo "<label text-align='center'>".$message."</label>";
                echo "</div>";

              }else if($status == 2){
                echo "<div class='alert alert-danger' role='alert'>";
                      echo "<label text-align='center'>".$message."</label>";
                echo "</div>";
              }else if($status == 3){
                echo "<div class='alert alert-secondary' role='alert'>";
                      echo "<label text-align='center'>".$message."</label>";
                echo "</div>";
              }
            }
      ?>

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
  <!-- <script src="<?php //echo base_url()?>assets/js/demo/datatables-demo.js"></script> -->

</body>
</html>
