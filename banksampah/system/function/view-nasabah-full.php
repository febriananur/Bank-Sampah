<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KTN</title>

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
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper"> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Nasabah</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard Admin</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="card">
            <div class="card-header">
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                <tr>
              <th>NIN</th>
              <th>Nama</th>
              <th>RT</th>
              <th>Alamat</th>
              <th>Telepon</th>
              <th>E-mail</th>
              <th>Saldo</th>
              <th>Sampah</th>
              <th>Aksi</th>
      </tr>
                </thead>
                <tbody>
        <?php
          $query = mysqli_query($conn, "SELECT * FROM nasabah ORDER BY nin ASC");
          while($row = mysqli_fetch_assoc($query)){
        ?>
        <tr align="center">
          <td><?php echo $row['nin'] ?></td>
          <td><?php echo $row['nama'] ?></td>
          <td><?php echo $row['rt'] ?></td>
          <td><?php echo $row['alamat'] ?></td>
          <td><?php echo $row['telepon'] ?></td>
          <td><?php echo $row['email'] ?></td>
          <td>
            <?php
              $saldonya = mysqli_query($conn, "SELECT SUM(total) AS totalsaldo FROM setor WHERE nin='".$row['nin']."'");
              $tariknya = mysqli_query($conn, "SELECT SUM(jumlah_tarik) AS totaltarik FROM tarik WHERE nin='".$row['nin']."'");
              $var_saldo = mysqli_fetch_array($saldonya);$var_tarik = mysqli_fetch_array($tariknya);
              $tot_saldo_total=($var_saldo['totalsaldo'])-($var_tarik['totaltarik']);
              $saldoakhir = mysqli_query($conn, 
              "update nasabah SET saldo=$tot_saldo_total WHERE nin='".$row['nin']."'");                    
            ?>                    
            <?php echo "Rp. ".number_format($row['saldo'], 2, ",", ".")  ?></td>
          <td>
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModal<?= $row['nin']; ?>">
            <i class="far fa-eye"></i> Lihat
            </button>
            
            <div class="modal fade" id="exampleModal<?= $row['nin']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <table id="example" class="display" cellspacing="0" width="100%" border="0" >
                      <thead>
                        <tr>
                          <th>Tanggal Setor</th>
                          <th>Jenis Sampah</th>
                          <th>Harga</th>
                          <th>Berat</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Tanggal Setor</th>
                          <th>Jenis Sampah</th>
                          <th>Harga</th>
                          <th>Berat</th>
                          <th>Total</th>
                        </tr>   
                      </tfoot>
                      <tbody>
                        <?php
                          $querysampah  = mysqli_query($conn, "SELECT * FROM setor WHERE nin='".$row['nin']."'");
                          while ($key = mysqli_fetch_assoc($querysampah)) { 
                        ?>
                            <tr align="center">
                              <td><?php echo $key['tanggal_setor'] ?></td>
                              <td><?php echo $key['jenis_sampah'] ?></td>
                              <td><?php echo $key['harga'] ?></td>
                              <td><?php echo $key['berat'] ?></td>
                              <td><?php echo $key['total'] ?></td>
                            </tr>
                          <?php } 
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          </td>
          <td>

              <a href="dashboard_admin.php?page=edit-nasabah-id&id=<?php echo $row['nin']; ?>">
              <button class="btn btn-warning"><i class="fas fa-pencil-alt"></i> edit</button> 
              </a>
              
              <a onclick="return confirm('Anda yakin ingin menghapus data ini?')" href="../system/function/delete-nasabah.php?id=<?php echo $row['nin']; ?>">
              <button class="btn btn-danger"><i class="far fa-trash-alt"></i> hapus</button>
              </a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        
        <!-- Main row -->
                <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
  <a href="dashboard_admin.php?page=tambah-data-nasabah">
    <button class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</button>
    </a>

    <a target="_blank" href="../system/function/excel-admin.php">
    <button class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Excel</button>
    </a>

    <a target="_blank" href="../system/function/print-admin.php">
    <button class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Cetak</button>
    </a>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script>
        $(document).ready(function() {
           $('#example').DataTable();
        } );
</script>
</body>
</html>
