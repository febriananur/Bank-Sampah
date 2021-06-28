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
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Transaksi Tarik</h1>
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
    <!-- Main content -->
    <br>
    <section class="content">
          <a href="dashboard_admin.php?page=tambah-data-tarik">
    <button class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</button>
    </a>

    <a target="_blank" href="../system/function/excel-tarik.php">
    <button class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Excel</button>
    </a>

    <a target="_blank" href="../system/function/print-tarik.php">
    <button class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Cetak</button>
    </a>
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
     <div class="card-body table-responsive p-0">
     <table class="table table-hover text-nowrap" id="example" class="display" cellspacing="0" width="100%" border="0" >
        <thead>
          <tr>
            <th>No</th>
            <th>ID</th>
            <th>Tanggal</th>
            <th>NIN</th>
            <th>Saldo</th>
            <th>Jumlah Tarik</th>
            <th>NIA</th>
            <th>Dokumen Tanda Terima</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $no     = 0;
            $query  = mysqli_query($conn, "SELECT * FROM tarik ORDER BY id_tarik ASC");
            while($row = mysqli_fetch_assoc($query)){
              $no++; ?>
              <tr align="center">
                <td><?php echo "$no" ?></td>
                <td><?php echo $row['id_tarik'] ?></td>
                <td><?php echo $row['tanggal_tarik'] ?></td>
                <td><?php echo $row['nin'] ?></td>
                <td><?php echo "Rp. ".number_format($row['saldo'], 2, ",", ".")  ?></td>
                <td><?php echo "Rp. ".number_format($row['jumlah_tarik'], 2, ",", ".")  ?></td>
                <td><?php echo $row['nia'] ?></td>
                <td><a href="../asset/<?= $row['dokumen_tanda_terima']; ?>" target="_blank"><button class="btn btn-primary"><i class="far fa-eye"></i> Lihat</button></a></td>
                <td>
                  <a href="a">
                  <button class="btn btn-warning"><i class="fas fa-pencil-alt"></i> edit</button> 
                  </a>
                  <a onclick="return confirm('Anda yakin ingin menghapus data ini?')" href="../system/function/delete-tarik.php?id=<?php echo $row['id_tarik']; ?>">
                  <button class="btn btn-danger"><i class="far fa-trash-alt"></i> hapus</button>
                  </a>
                </td>
              </tr>
          <?php } ?>
        </tbody>
    </table>
    </div>
          </div>
        </div>
      </div>
  
    </section>
      
   </div>
  </div>
</div>


</body>
</html>
