
<?php
 if (isset($_POST['simpan'])) {
  require_once("../system/config/koneksi.php");
  $jenis_sampah = $_POST['jenis_sampah'];
  $satuan = $_POST['satuan'];
  $harga = $_POST['harga'];
  $nama_file = $_FILES['gambar']['name'];
  $source = $_FILES['gambar']['tmp_name'];
  $folder = '../asset/internal/img/uploads/';
  $deskripsi = $_POST['deskripsi'];

  move_uploaded_file($source, $folder.$nama_file);

  $query = mysqli_query($conn,"INSERT INTO sampah VALUES ('','$jenis_sampah','$satuan','$harga','$nama_file','$deskripsi')");
  
  if ($query){
    echo "
        <script>
          alert('Berhasil Menambah Data!');
        </script>
        ";

        echo "<meta http-equiv='refresh'
              content='0; url=http://localhost/banks/banksampah/page/dashboard_admin.php?page=data-sampah'>";
  }else{
    echo "
        <script>
          alert('Gagal Menambah Data!');
        </script>
        ";

        echo "<meta http-equiv='refresh'
              content='0; url=http://localhost/banks/banksampah/page/dashboard_admin.php?page=data-sampah'>";
  }
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
            var x=daftar_user.jenis_sampah.value;
            var x1=parseInt(x);
            
            if(x==""){
               alert("Maaf harap input jenis sampah!");
               daftar_user.jenis_sampah.focus(); 
               return false;
            } 
            if(isNaN(x1)==false){
               alert ("Maaf jenis sampah harus di input huruf!");
               daftar_user.jenis_sampah.focus();
               return false;
            }
            var p=daftar_user.satuan.value;
            if (p =="p"){
               alert("Maaf harap input satuan sampah!");
               return (false);
            }
            var x=daftar_user.harga.value;
            var angka = /^[0-9]+$/;
            var panjang=x.length;

            if(x==""){
               alert("Maaf harap input harga!");
               daftar_user.harga.focus();  
               return false;
            }
            if (!x.match(angka)) {
               alert ("Maaf harga harus di input angka!");
               daftar_user.harga.focus();
               return false;
            }
            if(panjang<3 || panjang>5){
               alert("harga di input minimum 3 karakter dan maksimum 5 karakter!");
               daftar_user.harga.focus();
               return false;
            }
            if(daftar_user.gambar.value==""){
               alert("Maaf harap input gambar!");
               daftar_user.gambar.focus();  
               return false;
         }
            var x=daftar_user.deskripsi.value;
            var panjang=x.length;
            
            if(x==""){
               alert("Maaf harap input deskripsi!");
               daftar_user.deskripsi.focus(); 
               return false;
            } 
            if(panjang>50){
               alert ("deskripsi di input maksimum 50 karakter!");
               daftar_user.deskripsi.focus();
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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
         <div class="row">
          <div class="card col-sm-8">
               <form id="daftar_user" action="" method="post" enctype="multipart/form-data" onsubmit="return cek_data()">
               <div class="form-group">
               <label class="text-left">Jenis Sampah</label>
               <input class="form-control" type="text" placeholder="Masukan jenis sampah" name="jenis_sampah" />
               </div>

               <div class="form-group">
               <label class="">Satuan</label>
               <select class="form-control" name="satuan">
                     <option value="p">---Pilih Satuan---</option>
                     <option value="KG">Kilogram</option>
                     <option value="PC">Pieces</option>
                     <option value="LT">Liter</option>
               </select>
               </div>

               <div class="form-group">
               <label class="">Harga (Rp)</label>
               <input class="form-control" type="text" placeholder="Masukan harga (Rp)" name="harga" />
               </div>

               <div class="form-group">
               <label class="">Gambar</label>
               <input  type="file" name="gambar"/>
               </div>

               <div class="form-group">
               <label class="">Deskripsi</label>
               <input class="form-control" type="text" placeholder="Masukan deskripsi sampah" name="deskripsi"/>
               </div>

               <input type="submit" name="simpan" value="Simpan"></input>
               <br>
               <br>
               </form>
          </div>
         </div>
      </div>
      </section>
</div>
</div>

</body>
</html>
