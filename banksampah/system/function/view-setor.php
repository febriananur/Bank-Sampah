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
    <!-- Main content -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Transaksi Setor</h1>
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
    <br>
    <section class="content">
    <a href="dashboard_admin.php?page=tambah-data-setor">
    <button class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>Tambah</button>
    </a>

    <a target="_blank" href="../system/function/excel-setor.php">
    <button class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i>Excel</button>
    </a>

    <a target="_blank" href="../system/function/print-setor.php">
    <button class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i>Cetak</button>
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
        <th>ID</th>
        <th>Tanggal</th>
        <th>NIN</th>
        <th>Jenis Sampah</th>
        <th>Berat</th>
        <th>Harga</th>
        <th>Total</th>
        <th>NIA</th>
        <th>Dokumen Tanda Terima</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
          <th>ID</th>
          <th>Tanggal</th>
          <th>NIN</th>
          <th>Jenis Sampah</th>
          <th>Berat</th>
          <th>Harga</th>
          <th>Total</th>
          <th>NIA</th>
          <th>Dokumen Tanda Terima</th>
          <th>Aksi</th>       
      </tr>   
    </tfoot>
      <tbody>
        <?php
          $query = mysqli_query($conn, "SELECT * FROM setor ORDER BY id_setor ASC");
          while($row = mysqli_fetch_assoc($query)){
        ?>
        <tr align="center">
          <td><?php echo $row['id_setor'] ?></td>
          <td><?php echo $row['tanggal_setor'] ?></td>
          <td><?php echo $row['nin'] ?></td>
          <td><?php echo $row['jenis_sampah'] ?></td>
          <td><?php echo number_format($row['berat'])." Kg"  ?></td>
          <td><?php echo "Rp. ".number_format($row['harga'], 2, ",", ".")  ?></td>
          <td><?php echo "Rp. ".number_format($row['total'], 2, ",", ".")  ?></td>
          <td><?php echo $row['nia'] ?></td>
          <td><a href="../asset/<?= $row['dokumen_tanda_terima']; ?>" target="_blank"><button class="btn btn-primary"><i class="far fa-eye"></i> Lihat</button> </a></td>
          <td>
            <a href="dashboard_admin.php?page=edit-setor&id=<?php echo $row['id_setor']; ?>">
            <button class="btn btn-warning"><i class="fas fa-pencil-alt"></i> edit</button> 
            </a>
            <a onclick="return confirm('Anda yakin ingin menghapus data ini?')" href="../system/function/delete-setor.php?id=<?php echo $row['id_setor']; ?>">
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