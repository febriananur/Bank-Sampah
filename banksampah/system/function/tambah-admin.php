<?php

 require_once("../system/config/koneksi.php");

    $no = mysqli_query($conn, "SELECT nia FROM admin ORDER BY nia DESC");
    $nia = mysqli_fetch_array($no);
    $kode = $nia['nia'];

    $urut = substr($kode, 7, 2);
    $tambah = (int) $urut + 1;
    $bln = date("m");
    $thn = date("y");

    if(strlen($tambah) == 1){
        $format = "ADM".$thn.$bln."0".$tambah;
    }else{
        $format = "ADM".$thn.$bln.$tambah;
    }

    if(isset($_POST['simpan'])){
      $nia = $_POST['nia'];
      $nama = $_POST['nama'];
      $telepon = $_POST['telepon'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $level = $_POST['level'];

      $sql = mysqli_query($conn, "SELECT * FROM admin WHERE nia = '$nia'");

      if (mysqli_fetch_array($sql) > 0) {
        echo "<script>
                alert('Maaf akun sudah terdaftar!');
              </script>";

              echo "<meta http-equiv='refresh'
              content='0; url=http://localhost/bsk09/page/admin.php?page=data-admin-full'>";

              return FALSE;      
      }

      mysqli_query($conn, "INSERT INTO admin VALUES ('$nia','$nama','$telepon','$email','$password','$level')");

      echo "<script>
                alert('Selamat berhasil input data!');
              </script>";

      echo "<meta http-equiv='refresh'
      content='0; url=http://localhost/bsk09/page/admin.php?page=data-admin-full'>";
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
  <script type="text/javascript">

function cek_data() {
   var x=daftar_user.nama.value;
   var x1=parseInt(x);
   
   if(x==""){
      alert("Maaf harap input nama admin!");
      daftar_user.nama.focus(); 
      return false;
   } 
   if(isNaN(x1)==false){
      alert ("Maaf nama harus di input huruf!");
      daftar_user.nama.focus();
      return false;
   }
   var x=daftar_user.telepon.value;
   var angka = /^[0-9]+$/;

   if(x==""){
      alert("Maaf harap input nomor telepon!");
      daftar_user.telepon.focus();  
      return false;
   }
   if (!x.match(angka)) {
      alert ("Maaf nomor telepon harus di input angka!");
      daftar_user.telepon.focus();
      return false;
   }
   if(x.length!=12){
      alert("Nomor telepon harus 12 karakter!");
      daftar_user.telepon.focus();
      return false;
   }
   var x=daftar_user.email.value;
   var cek_email = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

   if(x==""){
      alert("Maaf harap input email!");
      daftar_user.email.focus(); 
      return false;
   }
   if(!x.match(cek_email)){
      alert("Format penulisan email tidak sesuai!");
      daftar_user.email.focus();
      return false;
   }
   var x=daftar_user.password.value;
   var panjang=x.length;

   if(x==""){
      alert("Maaf harap input password!");
      daftar_user.password.focus(); 
      return false;
   }
   if(panjang<6 || panjang>20){
      alert("Password di input minimum 6 karakter dan maksimum 20 karakter!");
      daftar_user.password.focus();
      return false;
    }
    var p=daftar_user.level.value;
    if (p =="p"){
      alert("Maaf harap input level admin!");
      return (false);
  }else{
  confirm("Apakah Anda yakin sudah input data dengan benar?");
  }
   return true;
}
</script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="card col-sm-8">
              <form id="daftar_user" action="" method="post" onsubmit="return cek_data()">
                <div class="card-body">

                  <div class="form-group">
                    <label class="text-left">Nomor Induk Admin</label>
                    <input class="form-control" style="cursor: not-allowed;" type="text" name="nia" value="<?php echo $format; ?>" readonly/>
                  </div>

                  <div class="form-group">
                    <label class="left">Nama Admin</label>
                    <input class="form-control" type="text" name="nama" placeholder="Masukan nama admin" />
                  </div>

                  <div class="form-group">
                    <label class="">Nomor Telepon</label>
                    <input class="form-control" type="text" placeholder="Masukan nomor telepon" name="telepon" />
                  </div>

                  <div class="form-group">
                    <label class="">E-mail</label>
                    <input class="form-control" type="text" placeholder="Masukan alamat email" name="email" />
                  </div>

                  <div class="form-group">
                    <label class="">Password</label>
                    <input class="form-control" type="text" placeholder="Masukan password" name="password" />
                  </div>

                  <div class="form-group">
                    <label class="">Level</label>
                    <select class="form-control" name="level">
                        <option value="p">---Pilih Level---</option>
                        <option value="Master-admin">Master-admin</option>
                        <option value="Admin">Admin</option>
                    </select>
                  </div>

                  <input type="submit" name="simpan" value="Simpan"></input>

                  </div>
              </form>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


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
