<?php
  require_once("../system/config/koneksi.php");
  $no   = mysqli_query($conn, "SELECT nin FROM nasabah ORDER BY nin DESC");
  $nin  = mysqli_fetch_array($no);
  $kode = $nin['nin'];

  $urut   = substr($kode, 7, 3);
  $tambah = (int) $urut + 1;
  $bln    = date("m");
  $thn    = date("y");

  if(strlen($tambah) == 1){
    $format = "NSB".$thn.$bln."00".$tambah;
  }else if (strlen($tambah) == 2) {
    $format = "NSB".$thn.$bln."0".$tambah;
  }else{
    $format = "NSB".$thn.$bln.$tambah;
  }

  if(isset($_POST['simpan'])){
    $nin      = $_POST['nin'];
    $nama     = $_POST['nama'];
    $rt       = $_POST['rt'];
    $alamat   = $_POST['alamat'];
    $telepon  = $_POST['telepon'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $saldo    = $_POST['saldo'];
    $sampah   = $_POST['sampah'];

    $sql = mysqli_query($conn, "SELECT * FROM nasabah WHERE nin = '$nin'");

    if (mysqli_fetch_array($sql) > 0) {
      echo "<script>
              alert('Maaf akun sudah terdaftar');
            </script>";

            echo "<meta http-equiv='refresh'
            content='0; url=http://localhost/bsk09/page/admin.php?page=data-nasabah-full'>";

            return FALSE;      
    }

    mysqli_query($conn, "INSERT INTO nasabah VALUES ('$nin','$nama','$rt','$alamat','$telepon','$email','$password','$saldo','$sampah')");

    echo "<script>
              alert('Selamat berhasil input data!');
            </script>";

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


  <script type="text/javascript">
    function cek_data() {
      var x   = daftar_user.nama.value;
      var x1  = parseInt(x);
       
      if(x  == ""){
        alert("Maaf harap input nama nasabah!");
        daftar_user.nama.focus(); 
        return false;
      } 
      if(isNaN(x1)==false){
        alert ("Maaf nama harus di input huruf!");
        daftar_user.nama.focus();
        return false;
      }
      var p = daftar_user.rt.value;
      if (p =="p"){
        alert("Maaf harap input rukun tetangga (RT)!");
        return (false); 
      }
      var x   = daftar_user.alamat.value;
      var x1  = parseInt(x);
       
      if(x==""){
        alert("Maaf harap input alamat nasabah!");
        daftar_user.alamat.focus(); 
        return false;
      }
      var x     = daftar_user.telepon.value;
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
      var x         = daftar_user.email.value;
      var cek_email = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

      if(x  == ""){
        alert("Maaf harap input email!");
        daftar_user.email.focus(); 
        return false;
      }
      if(!x.match(cek_email)){
        alert("Format penulisan email tidak sesuai!");
        daftar_user.email.focus();
        return false;
      }
      var x       = daftar_user.password.value;
      var panjang = x.length;

      if(x==""){
        alert("Maaf harap input password!");
        daftar_user.password.focus(); 
        return false;
      }
      if(panjang<6 || panjang>20){
          alert("Password di input minimum 6 karakter dan maksimum 20 karakter!");
          daftar_user.password.focus();
          return false;
      }else{
      confirm("Apakah Anda yakin sudah input data dengan benar?");
      }
      return true;
    }
  </script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <div class="content-wrapper">
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="card col-sm-8">
          <form id="daftar_user" action="" method="post" onsubmit="return cek_data()">
            <div class="form-group">
              <label class="text-left">Nomor Induk Nasabah</label>
              <input class="form-control" style="cursor: not-allowed;" type="text" name="nin" value="<?php echo $format; ?>" readonly/>
            </div>

            <div class="form-group">
              <label class="left">Nama Nasabah</label>
              <input class="form-control" type="text" name="nama" placeholder="Masukan nama nasabah" />
            </div>

            <div class="form-group">
              <label class="form-control">Rukun Tetangga (RT)</label>
                <select name="rt">
                  <option value="p">---Pilih RT---</option>
                  <option value="1">RT01</option>
                  <option value="2">RT02</option>
                  <option value="3">RT03</option>
                  <option value="4">RT04</option>
                  <option value="5">RT05</option>
                  <option value="6">RT06</option>
                  <option value="7">RT07</option>
                  <option value="8">RT08</option>
                  <option value="9">RT09</option>
              </select>
            </div>

            <div class="form-group">
              <label class="">Alamat</label>
              <input class="form-control" type="text" placeholder="Masukan alamat" name="alamat" />
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
              <input class="form-control" type="hidden" name="saldo" />
            </div>
            <div class="form-group">
              <input class="form-control" type="hidden" name="sampah" />
            </div>

            <input class="form-control" type="submit" name="simpan" value="Simpan" style="background-color: #2577fa;color:#f1f1f1;"></input>
            <br>
           </form>


          </div>
        </div>
      </div>
  </section>  
  </div>
</div>







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