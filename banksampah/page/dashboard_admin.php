<?php
session_start();
if (empty($_SESSION['user']) && empty($_SESSION['pass'])) {
    header('location:logreg.php');
} else {   
error_reporting(E_ALL | E_STRICT); 
include_once("../system/config/koneksi.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Admin</title>
  <link rel="icon" href="..\asset\internal\img\img-local\logo.png" type="image/icon type">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini">
  <?php 
  $cek = mysqli_query($conn, "SELECT * FROM admin WHERE nia='".$_SESSION['nia']."'");
  $row = mysqli_fetch_array($cek);
?>
<div class="wrapper">


  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/logo.png" alt="logo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->

    
   
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="logo text-center">
    <a href="#" class="brand-link">
      <img src="dist/img/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light ">KTN</span>
    </a>
    </div>
   

    <!-- Sidebar -->
    <div class="sidebar">





      <!-- Sidebar user panel (optional) -->
      <div class="user-panel  text-center">
        <!-- <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> -->
        <div class="info text-center">
          <a href="dashboard_admin.php?page=data-admin" class="d-block"><?php echo $_SESSION["level"]; ?>, <br> <?php echo $row['nama'] ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?php
          $level  = $_SESSION['level'] == 'Admin';
          if($level){
          } else { ?>	

            <li class="nav-item">
            <a href="dashboard_admin.php?page=data-admin-full" class="nav-link">
              <i class="nav-icon fas fa-id-card"></i>
              <p>
                Data Admin
              </p>
            </a>
          </li>
          <?php } 
        ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-word"></i>
              <p>
                Buat Postingan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="dashboard_admin.php?page=data-nasabah-full" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Data Nasabah
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="dashboard_admin.php?page=data-sampah" class="nav-link">
              <i class="nav-icon fas fa-dumpster"></i>
              <p>
                Data Sampah
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="dashboard_admin.php?page=data-setor" class="nav-link">
              <i class="nav-icon fas fa-money-check-alt"></i>
              <p>
                Transaksi Setor
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="dashboard_admin.php?page=data-tarik" class="nav-link">
              <i class="nav-icon fas fa-money-bill-alt"></i>
              <p>
                Transaksi Tarik
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="dashboard_admin.php?page=data-report" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Grafik Monitoring
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="dashboard_admin.php?page=map" class="nav-link">
              <i class="nav-icon fas fa-map-marker-alt"></i>
              <p>
                Lokasi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <div class="box-1">
    <section>
      <?php 
        if(isset($_GET['page'])){
          $page = $_GET['page'];
          switch ($page) {
            case 'data-admin':
              include "../system/function/view_adminv2.php";
              break;
            case 'tambah-data-admin':
              include "../system/function/tambah-admin.php";
              break;
            case 'data-admin-full':
              include "../system/function/view-admin-full.php";
              break;
            case 'edit-admin-id':
              include "../system/function/edit-admin-id.php";
              break;
            case 'edit-admin':
              include "../system/function/edit-admin.php";
              break;
            case 'edit-sampah':
              include "../system/function/edit-sampah.php";
              break;
            case 'data-nasabah-full':
              include "../system/function/view-nasabah-full.php";
              break;
            case 'edit-nasabah-id':
              include "../system/function/edit-nasabah-id.php";
              break;
            case 'tambah-data-nasabah':
              include "../system/function/tambah-nasabah.php";
              break;
            case 'data-sampah':
              include "../system/function/view-sampah.php";
              break;
            case 'tambah-data-setor':
              include "../system/function/tambah-setor.php";
              break;
            case 'edit-setor':
              include "../system/function/edit-setor.php";
              break;
            case 'tambah-data-tarik':
              include "../system/function/tambah-tarik.php";
              break;
            case 'data-setor':
              include "../system/function/view-setor.php";
              break;
            case 'data-tarik':
              include "../system/function/view-tarik.php";
              break;
            case 'data-report':
              include "../system/function/view-report.php";
              break;
            case 'tambah-data-sampah':
              include "../system/function/tambah-sampah.php";
              break;	
            case 'map':
              include "../system/function/view_map.php";
              break;  
            case 'tanda_terima':
              include "../system/function/tanda_terima.php";
              break;			
            default:
              echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
              break;
          }
        }else{
          include "../system/function/view_adminv2.php";
        }
      ?>
    </section>
  </div>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->







<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
</body>
</html>
<?php } ?>