<?php
require_once("../../vendor/autoload.php");
use Dompdf\Dompdf;
use Dompdf\Options;
if (isset($_POST['simpan'])) {
  require_once("../system/config/koneksi.php");
  ob_start();
    include "../system/function/dokumen_tanda_terima.php";
    $html = ob_get_contents();
  ob_end_clean();
  ob_clean();
  $filename = uniqid();
  $options  = new Options();
  $options->set('isRemoteEnabled', TRUE);
  $dompdf = new Dompdf($options);
  $dompdf->loadHtml($html);
  $dompdf->setPaper('legal', 'potrait');
  $dompdf->render();
  $output = $dompdf->output();
  file_put_contents('../asset/' . $filename . '.pdf', $output);

  require_once("../system/config/koneksi.php");
  $tanggal_tarik        = $_POST['tanggal_tarik'];
  $nin                  = $_POST['nin'];
  $saldo                = $_POST['saldo'];
  $jumlah_tarik         = $_POST['jumlah_tarik'];
  $nia                  = $_POST['nia'];
  $dokumen_tanda_terima = $filename . '.pdf';

  if($saldo < $jumlah_tarik) {
    echo "<script>alert('Maaf saldomu kurang!')</script>";
    echo "<meta http-equiv='refresh'
      content='0; url=http://localhost/bsk09/page/admin.php?page=data-nasabah-full'>";
  } else {
    echo "<script>alert('Berhasil melakukan transaksi tarik!!')</script>";
    $query    = "INSERT INTO tarik(id_tarik, tanggal_tarik, nin, saldo, jumlah_tarik, nia, dokumen_tanda_terima) VALUE ('NULL', '$tanggal_tarik', '$nin', '$saldo', '$jumlah_tarik', '$nia', '$dokumen_tanda_terima')";
    $queryact = mysqli_query($conn, $query);
    echo "
      <script>
        alert('Selamat berhasil input data!');
        window.location='?page=data-tarik';
      </script>
    ";
  }
  exit();
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

  <script type="text/javascript" src="../asset/plugin/datepicker/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../asset/plugin/datepicker/css/jquery.datepick.css"> 
  <script type="text/javascript" src="../asset/plugin/datepicker/js/jquery.plugin.js"></script> 
  <script type="text/javascript" src="../asset/plugin/datepicker/js/jquery.datepick.js"></script>
  <script type="text/javascript">
    function cek_data() {
      var x = daftar_user.tanggal_tarik.value;
      if(x=="") {
        alert("Maaf harap input tanggal tarik!");
        daftar_user.tanggal_tarik.focus(); 
        return false;
       }
      var p = daftar_user.nin.value;
      if (p =="p"){
        alert("Maaf harap input nomor induk nasabah!");
        return (false);
      } 
      var x = daftar_user.saldo.value;
      if(x==""){
        alert("Maaf saldo Anda masih kosong!");
        daftar_user.saldo.focus(); 
        return false;
      }
      var x=daftar_user.jumlah_tarik.value;
      var angka = /^[0-9]+$/;
      if(x==""){
        alert("Maaf harap input jumlah penarikan!");
        daftar_user.jumlah_tarik.focus(); 
        return false;
      }
      if(!x.match(angka)){
         alert ("Maaf jumlah tarik harus di input angka!");
          daftar_user.jumlah_tarik.focus();
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
          <form id="daftar_user" name='autoSumForm' action="" method="post" onsubmit="return cek_data()">
            <div class="form-group">
              <label class="text-left">Tanggal Penarikan</label>
              <input class="form-control" type="text" placeholder="Masukan tanggal setor" id="date" name="tanggal_tarik" />
              <script type="text/javascript">
                $('#date').datepick({dateFormat: 'yyyy-mm-dd'});
              </script>
            </div>
            <div class="form-group">
              <label class="">Nomor Induk Nasabah</label>
              <select class="form-control" class="nomornasabah" name="nin" id="nin" >
                <option value="p">---Pilih NIN---</option>
                <?php 
                  $query = mysqli_query($conn, "SELECT * FROM nasabah");
                  while ($row = mysqli_fetch_array($query)) {
                    echo '<option value="' . $row['nin'] . '">' . $row['nin'] . ' - ' . $row['nama'] . '</option>';
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label class="">Saldo (Rp)</label>
              <input class="form-control" type="text" placeholder="Otomatis terisi" style="cursor: not-allowed;" name="saldo" class="form-control saldo" id="saldo" readonly="" />		  
            </div>
            <div class="form-group">
              <label class="">Jumlah Penarikan)</label>
              <input class="form-control" type="text" placeholder="Masukan jumlah tarik" name="jumlah_tarik" />
            </div>
            <div class="form-group">
              <label class="">Nomor Induk Admin</label>
              <input class="form-control" type="text" style="cursor: not-allowed;" name="nia" value="<?php echo $_SESSION["nia"]; ?>" readonly />
            </div>
            <input type="submit" name="simpan" value="Simpan Data" />
          </form>
          <br>
          </div>
        </div>
      </div>
  </section>  
  </div>
</div>
<script src="js/jquery.min.js"></script>
  <script src="js/custom.js"></script>      
	<link href="js/select2.min.css" rel="stylesheet" />
	<script src="js/select2.min.js"></script>
	<script>
    $(document).ready(function() {
        $('.nomoradmin').select2();
      $('.nomornasabah').select2();
    });
	</script>
</body>
</html>