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
            <h1 class="m-0">Data Admin</h1>
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
                    <th>No</th>
                    <th>NIA</th>
                    <th>Nama Admin</th>
                    <th>No Telp</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>aksi</th>
                  </tr>
                </thead>
                <t<?php
                $no = 0;
                $query = mysqli_query($conn, "SELECT * FROM admin ORDER BY nia ASC");
                while($row = mysqli_fetch_assoc($query)){$no++;
            ?>
            <tr align="center">
                <td><?php echo "$no" ?></td>
                <td><?php echo $row['nia'] ?></td>
                <td><?php echo $row['nama'] ?></td>
                <td><?php echo $row['telepon'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['level'] ?></td>
                <td>
                    
                    <a href="dashboard_admin.php?page=edit-admin-id&id=<?php echo $row['nia']; ?>">
                    <button class="btn btn-warning"><i class="fas fa-pencil-alt"></i> edit</button> 
                    </a>
    
                    <a onclick="return confirm('Anda yakin ingin menghapus data ini?')" href="../system/function/delete-admin.php?id=<?php echo $row['nia']; ?>">
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
  <a href="dashboard_admin.php?page=tambah-data-admin">
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
