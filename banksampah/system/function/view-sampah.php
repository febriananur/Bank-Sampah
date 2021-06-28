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
    
<div class="content-wrapper">
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Sampah</h1>
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
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="card col-sm-12">
          <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                    <tr align="center">
                        <th>No</th>
                        <th>Jenis Sampah</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 0;
                        $query = mysqli_query($conn, "SELECT * FROM sampah ORDER BY jenis_sampah ASC");
                        while($row = mysqli_fetch_assoc($query)){$no++;
                    ?>
                    <tr align="center">
                        <td><?php echo "$no" ?></td>
                        <td><?php echo $row['jenis_sampah'] ?></td>
                        <td><?php echo $row['satuan'] ?></td>
                        <td><?php echo "Rp. ".number_format($row['harga'], 2, ",", ".")  ?></td>
                        <td><img src="../asset/internal/img/uploads/<?php echo $row['gambar'] ?>" width="100px" height="50px"></td>
                        <td><?php echo $row['deskripsi'] ?></td>
                        <td>

                            <a href="dashboard_admin.php?page=edit-sampah&id=<?php echo $row['id']; ?>">
                            
                            <button class="btn btn-warning"><i class="fas fa-pencil-alt"></i> edit</button> 
                            </a>
                            
                            <a onclick="return confirm('Anda yakin ingin menghapus data ini?')" href="../system/function/delete-sampah.php?id=<?php echo $row['jenis_sampah']; ?>">
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
      <a href="dashboard_admin.php?page=tambah-data-sampah">    
                <button class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</button>
                </a>

                <a target="_blank" href="../system/function/excel-sampah.php">
                <button class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Excel</button>
                </a>

                <a target="_blank" href="../system/function/print-sampah.php">
                <button class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Cetak</button>
            </a>
    </section>
    <br>
    <br>
</div>
<script type="text/javascript" src="../datatables/js/jquery.min.js"></script>
    <script type="text/javascript" src="../datatables/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
           $('#example').DataTable();
        } );
</script>
</body>