<?php
  require_once("../system/config/koneksi.php");

 if (isset($_POST['simpan'])) {
  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $telepon = $_POST['telepon'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = "UPDATE nasabah SET nama = '$nama', alamat = '$alamat', telepon = '$telepon', username = '$username', password = '$password' WHERE nin='".$id."' ";
  $queryact = mysqli_query($conn, $query);
  echo "<meta http-equiv='refresh'
   content='0; url=http://localhost/banks/banksampah/page/dashboard_admin.php?page=data-nasabah-full'>";
 }

?>
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
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="card col-sm-12">
                    <?php if(isset($_GET['id'])){$id=$_GET['id']; ?>
                    <?php 
                        $cek = mysqli_query($conn, "SELECT * FROM setor WHERE id_setor='".$_GET['id']."'");
                        $row = mysqli_fetch_array($cek);
                      ?>
            
            <form action="" method="post">

              <div class="form-group" style="padding-top :12px;">
                <label class="">Tanggal Penyetoran</label>
                <input class="form-control" type="text" id="date" name="tanggal_setor" value="<?php echo $row['tanggal_setor'] ?> "/>
                <script type="text/javascript">
                  $('#date').datepick({dateFormat: 'yyyy-mm-dd'});
                </script>
              </div>
              <div class="form-group">
                <label class="">Nomor Induk Nasabah</label>
                <input class="form-control" type="text" name="nin" disabled="disabled" value="<?php echo $row['nin'] ?>" required/>
              </div>
              <div class="form-group">
                <label class="">Jenis Sampah</label>
                <input class="form-control" type="text" name="jenis_sampah" value="<?php echo $row['jenis_sampah'] ?>" required/>
              </div>
              <div class="form-group">
                <label class="">Berat (Kg)</label>
                <input class="form-control" type="text" name="berat" value="<?php echo $row['berat'] ?>" required/>
              </div>
              <div class="form-group">
                <label class="">Harga (Rp)</label>
                <input class="form-control" type="text" name="harga" value="<?php echo $row['harga'] ?>" required/>
              </div>
              <div class="form-group">
                <label class="">Total (Rp)</label>
                <input class="form-control" type="text" disabled="disabled" name="total" value="<?php echo $row['total'] ?>"/>
              </div>
              <div class="form-group">
                <label class="">Nomor Induk Admin</label>
                <input class="form-control" type="text" disabled="disabled" name="nia" value="<?php echo $row['nia'] ?>"/>
              </div>


              <input name="id" type="hidden"  value="<?php echo $_GET['id']; ?>" />
              <input class="button" type="submit" name="simpan" value="Simpan Data" style="background-color:#44e34f;"/>
              <br>
              <br>

              </form>     
                <?php } else {
                    $cek = mysqli_query($conn, "SELECT * FROM nasabah WHERE nin='".$_SESSION['nin']."'");
                    $row = mysqli_fetch_array($cek);
                  ?>
              
                <form action="" method="post">
                <label class="text-left">Nomor Induk Admin</label>
                <input class="form-control" type="text" name="nia" disabled="disabled" value="<?php echo @$_SESSION['nin'] ?>" />
                        <input name="id" type="hidden"  value="<?php echo @$_SESSION['nin'] ?>" />

              <div class="form-group">
                <label class="">Nama Nasabah</label>
                <input class="form-control" type="text" name="nama" value="<?php echo $row['nama'] ?> "/>
              </div>
              <div class="form-group">
                <label class="">Alamat</label>
                <input class="form-control" type="text" name="alamat" value="<?php echo $row['alamat'] ?>" required/>
              </div>
              <div class="form-group">
                <label class="">Nomor Telepon</label>
                <input class="form-control" type="text" name="telepon" value="<?php echo $row['telepon'] ?>" required/>
              </div>
              <div class="form-group">
                <label class="">Username</label>
                <input class="form-control" type="text" name="username" value="<?php echo $row['username'] ?>" required/>
              </div>
              <div class="form-group">
                <label class="">Password</label>
                <input class="form-control" type="text" name="password" value="<?php echo $row['password'] ?>" required/>
              </div>
              <div class="form-group">
                <label class="">Saldo (Rp)</label>
                <input class="form-control" type="text" disabled="disabled" name="saldo" value="<?php echo $row['saldo'] ?>"/>
              </div>
              <div class="form-group">
                <label class="">Sampah (Kg)</label>
                <input class="form-control" type="text" disabled="disabled" name="saldo" value="<?php echo $row['sampah'] ?>"/>
              </div>
              
              <input class="button" type="submit" onclick="" name="simpan" value="Simpan Data" />
              <br>
              <br>

              </form>
          <?php } ?>

          </div>
        </div>
      </div>  
    </section>
  </div>
</div>
</body>
</html>    