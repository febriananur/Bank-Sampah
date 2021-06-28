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
<br>
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="card col-sm-12">
          <table class="table table-hover text-nowrap">
          <thead>
                    <tr align="center">
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jenis Sampah</th>
                    <th>Berat</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>NIA</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 0; 
                    $query = mysqli_query($conn, "SELECT * FROM setor WHERE nin='".$_SESSION['nin']."' ORDER BY id_setor DESC");
                    while($row = mysqli_fetch_array($query)){$no++;
                            ?>
                <tr align="center">
                    <td><?php echo "$no" ?></td>
                    <td><?php echo $row['tanggal_setor'] ?></td>
                    <td><?php echo $row['jenis_sampah'] ?></td>
                    <td><?php echo number_format($row['berat'])." Kg"  ?></td>
                    <td><?php echo "Rp. ".number_format($row['harga'], 2, ",", ".")  ?></td>
                    <td><?php echo "Rp. ".number_format($row['total'], 2, ",", ".")  ?></td>
                    <td><?php echo $row['nia'] ?></td>
                </tr>
                <?php } ?>
                </tbody>
            </tabel>
                      
          </div>
          </div>
        </div>
      </section>
      
      </div>
      <br>
      <a target="_blank" href="../system/function/print-histori-setor.php">
              <button><i class="fa fa-print" aria-hidden="true"></i>Cetak</button>
      </a>
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
    </html>