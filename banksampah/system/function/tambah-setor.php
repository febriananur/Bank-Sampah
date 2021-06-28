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

    $tanggal_setor        = $_POST['tanggal_setor'];
    $nin                  = $_POST['nin'];
    $jenis_sampah         = $_POST['jenis_sampah'];
    $berat                = $_POST['berat'];
    $harga                = $_POST['harga'];
    $total                = $_POST['total'];
    $nia                  = $_POST['nia'];
    $dokumen_tanda_terima = $filename . '.pdf';
    $query                = "INSERT INTO setor(id_setor, tanggal_setor, nin, jenis_sampah, berat, harga, total, nia, dokumen_tanda_terima) VALUE ('NULL', '$tanggal_setor', '$nin', '$jenis_sampah', '$berat', '$harga', '$total', '$nia', '$dokumen_tanda_terima')";
    $queryact             = mysqli_query($conn, $query);

    echo "
      <script>
        alert('Selamat berhasil input data!');
        window.location='?page=data-setor';
      </script>
    ";
    // echo "<meta http-equiv='refresh'
    // content='0; url=http://localhost/bsk09/page/admin.php?page=data-setor'>";
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
      var x = daftar_user.tanggal_setor.value;
      if(x==""){
        alert("Maaf harap input tanggal setor!");
        daftar_user.tanggal_setor.focus(); 
        return false;
      }
      var pnin  = daftar_user.nin.value;
      if (pnin =="pnin"){
        alert("Maaf harap input nomor induk nasabah!");
        return (false);
      }
      var pjs = daftar_user.jenis_sampah.value;
      if (pjs =="pjs"){
        alert("Maaf harap input jenis sampah!");
        return (false);
      }
      var x = daftar_user.berat.value;
      var angka = /^[0-9]+$/;
      if(x==""){
        alert("Maaf harap input berat sampah!");
        daftar_user.berat.focus(); 
        return false;
      }
      if (!IsNumeric(x)) {
       alert ("Berat sampah harus di input angka!");
          daftar_user.berat.focus();
          return false;
      }
      var x = daftar_user.harga.value;
      if(x==""){
        alert("Maaf harga sampah masih kosong!");
        daftar_user.harga.focus(); 
        return false;
      }
      var x = daftar_user.total.value;
      if(x==""){
        alert("Maaf total transaksi penyetoran masih kosong!");
        daftar_user.total.focus(); 
        return false;
      } else {
        confirm("Apakah Anda yakin sudah input data dengan benar?");
      }
      return true;
    }
    
    $(document).ready(function(){ // Ketika halaman sudah diload dan siap
      $("#btn-tambah-form").click(function(){ // Ketika tombol Tambah Data Form di klik
        var jumlah      = parseInt($("#jumlah-form").val()); // Ambil jumlah data form pada textbox jumlah-form
        var nextform    = jumlah + 1; // Tambah 1 untuk jumlah form nya
        var berat       =  parseInt($("#berat2").val());
        var hargatotal  = berat * 5000;
        // Kita akan menambahkan form dengan menggunakan append
        // pada sebuah tag div yg kita beri id insert-form
        $("#insert-form").append("<b>Data ke " + nextform + " :</b>" +
          "<table>" +
        
          "<div class='form-group'><label class='text-left'>Tanggal Penyetoran</label><input type='date' placeholder='Masukan tanggal setor' id='date'  name='tanggal_setor' /></div>" +
          
          "<div class='form-group'><label class=''>Nomor Induk Nasabah</label><select class='nomornasabah' name='nin' ><option value='pnin'>---Pilih NIN---</option><?php $query = mysqli_query($conn, "SELECT * FROM nasabah"); while ($row = mysqli_fetch_array($query)) {echo '<option value='.$row['nin'].'>'. $row['nin'] . '</option>';}?></select></div>"+
          
          "<div class='form-group'><label class=''>Jenis Sampah</label><select class='jensampah2' name='jenis_sampah2' onchange='changeValue(this.value)' id='jenis_sampah2' ><option value='pjs'>---Pilih Jenis Sampah---</option><?php $query = mysqli_query($conn, "SELECT * FROM sampah"); $jsArray2 = 'var dtsampah2 = new Array();\n'; while ($row = mysqli_fetch_array($query)) { echo '<option value='. $row['jenis_sampah'].'>' . $row['jenis_sampah'] . '</option>';     $jsArray2 .= 'dtsampah2['. $row['jenis_sampah'] .'] = {harga:' . addslashes($row['harga']) . '};\n';}?></select></div>"+
          
          "<div class='form-group'><label class=''>Berat Sampah</label><input type='text' placeholder='Masukan berat sampah' id='berat2' name='berat' onkeyup='sum();' /></div>" +
          
          "<div class='form-group'><label class=''>Harga Sampah (Rp)</label><input type='text' placeholder='tomatis terisi' style='cursor: not-allowed;' id='harga2'name='harga2'value='"+hargatotal+" onkeyup='sum();' readonly /></div>" +
          
          "<div class='form-group'><label class=''>Total (Rp)</label><input type='text' placeholder='Otomatis terisi' style='cursor: not-allowed;' id='total'  name='total' readonly /></div>" +
          
          "<div class='form-grou'><label class=''>Nomor Induk Admin</label><input type='text' style'cursor: not-allowed;' name='nia'value='<?php echo $_SESSION['nia']; ?>' readonly /></div>" +
          
          "<br><br>");

        
        $("#jumlah-form").val(nextform); // Ubah value textbox jumlah-form dengan variabel nextform
      });
    
      // Buat fungsi untuk mereset form ke semula
      $("#btn-reset-form").click(function(){
        $("#insert-form").html(""); // Kita kosongkan isi dari div insert-form
        $("#jumlah-form").val("1"); // Ubah kembali value jumlah form menjadi 1
        
      });
    });
	</script> 
  </head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <div class="content-wrapper">
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="card col-sm-8">
          <form id="daftar_user"  name='autoSumForm' action="" method="post" onsubmit="return cek_data()">
          <h2 style="font-size: 30px; color: #262626;">Setor Sampah</h2>
          <button type="button" id="btn-tambah-form">Tambah Data Form</button>
          <button type="button" id="btn-reset-form">Reset Form</button><br><br>
          <div class="form-group">
            <label class="text-left">Tanggal Penyetoran</label>
            <input type="text"  placeholder="Masukan tanggal setor" id="date"  name="tanggal_setor" autocomplete="off" />
            <script type="text/javascript">  $('#date').datepick({dateFormat: 'yyyy-mm-dd'});</script>	
          </div>
          <div class="form-group">
      <label class="">Nomor Induk Nasabah</label>
      <select class="nomornasabah form-control"  name="nin" >
        <option value="pnin">---Pilih NIN---</option>
        <?php 
          $query  = mysqli_query($conn, "SELECT * FROM nasabah");
          while ($row = mysqli_fetch_array($query)) {
            echo '<option value="' . $row['nin'] . '">' . $row['nin'] . ' - ' . $row['nama'] . '</option>';
          }
        ?>
      </select>
    </div>
    <div class="form-group">
      <label class="">Jenis Sampah</label>
      <select class="jensampah form-control" class="form-control" name="jenis_sampah" id="jenis_sampah" onchange="changeValue(this.value)" >
        <option value="pjs">---Pilih Jenis Sampah---</option>
        <?php 
          $query    = mysqli_query($conn, "SELECT * FROM sampah");
          $jsArray  = "var dtsampah = new Array();\n";
          while ($row = mysqli_fetch_array($query)) {
            echo '<option value="' . $row['jenis_sampah'] . '">' . $row['jenis_sampah'] . '</option>';    
            $jsArray .= "dtsampah['" . $row['jenis_sampah'] . "'] = {harga:'" . addslashes($row['harga']) . "'};\n";
          }
        ?>
      </select>
    </div>
    <div class="form-group">
      <label class="">Berat Sampah</label>
      <input type="text" class="form-control" placeholder="Masukan berat sampah" id="berat" name="berat" onkeyup="sum();" />
    </div>
    <div class="form-group">
      <label class="">Harga Sampah (Rp)</label>
      <input type="text" class="form-control" placeholder="Otomatis terisi" style="cursor: not-allowed;" id="harga" name="harga" value="<?= $row !== NULL ? $row['harga'] : '' ; ?>" onkeyup="sum();" readonly />
    </div>
    <div class="form-group">
      <label class="">Total (Rp)</label>
      <input type="text" class="form-control" placeholder="Otomatis terisi" style="cursor: not-allowed;" id="total"  name="total" readonly />
    </div>
    <div class="form-group">
      <label class="">Nomor Induk Admin</label>
      <input type="text" class="form-control" style="cursor: not-allowed;" name="nia" value="<?php echo $_SESSION["nia"]; ?>" readonly />
    </div>
    <input type="submit" name="simpan" value="Simpan" />
		<div id="insert-form"></div>
		<hr>

          <br>
           </form>
           <input type="hidden" id="jumlah-form" value="1">
  <script type="text/javascript">    
    <?php echo $jsArray; ?>  
    function changeValue(jenis_sampah){
      console.log(dtsampah);  
      document.getElementById('harga').value = dtsampah[jenis_sampah]['harga'];
      sum();  
    };

    function sum() {
      var txtFirstNumberValue   = document.getElementById('berat').value;
      var txtSecondNumberValue  = document.getElementById('harga').value;
      var result                = parseFloat(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
      if (!isNaN(result)) {
        document.getElementById('total').value = result;
      }
    }  

           </script>
           <script src="js/jquery.min.js"></script>
           <script src="js/custom.js"></script>      

          <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
          <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
         
          <script>
            $(document).ready(function() {
                $('.nomoradmin').select2();
              $('.nomornasabah').select2();
              $('.jensampah').select2();
            });
          </script>
          </div>
        </div>
      </div>
  </section>  
  </div>
</div>
</body>
</html>