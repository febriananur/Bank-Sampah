<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AdminLTE 3 | Dashboard</title>
      
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
<section class="content">
    <div class="container-fluid">
    <br>
      <div class="row">
      <div class="card col-sm-6">
      <div class="form-group">
            <label class="text-left">Nomor Induk Nasabah</label>
            <input class="form-control" type="text" style="cursor: not-allowed;" disabled="disabled" value="<?php echo @$_SESSION['nin']; ?>" />
         </div>
         <div class="form-group">
          <label class="">Nama Nasabah</label>
          <input class="form-control" type="text" value="<?php echo @$_SESSION['nama_n']; ?>"/>
         </div>
         <div class="form-group">
          <label class="">Alamat</label>
          <input class="form-control" type="text" style="cursor: not-allowed;" disabled="disabled" value="<?php echo @$_SESSION['alamat']; ?>"/>
         </div>
         <div class="form-group">
          <label class="">Nomor Telepon</label>
          <input class="form-control" type="text" value="<?php echo @$_SESSION['telepon_n']; ?>"/>
         </div>
         <div class="form-group">
          <label class="">E-mail</label>
          <input class="form-control" type="text" value="<?php echo @$_SESSION['email_n']; ?>"/>
         </div>
         <div class="form-group">
          <label class="">Password</label>
          <input class="form-control" type="password"  value="<?php echo @$_SESSION['pass_n']; ?>"/>
         </div>
         <div class="form-group">
          <label class="">Saldo Total (Rp)</label>
          <?php
          			$saldonya = mysqli_query($conn, "SELECT SUM(total) AS totalsaldo FROM setor WHERE nin='".$_SESSION['nin']."'");

          			$tariknya = mysqli_query($conn, "SELECT SUM(jumlah_tarik) AS totaltarik FROM tarik WHERE nin='".$_SESSION['nin']."'");

          			$var_saldo = mysqli_fetch_array($saldonya);$var_tarik = mysqli_fetch_array($tariknya);
          			$tot_saldo_total=($var_saldo['totalsaldo'])-($var_tarik['totaltarik']);
          ?>		  
          <input class="form-control" type="text" style="cursor: not-allowed;" disabled="disabled" value="<?php echo $tot_saldo_total; ?>"/>

         </div>
         <div class="form-group">
          <label class="">Berat Sampah (Kg)</label>
          
          <input class="form-control" type="text" style="cursor: not-allowed;" disabled="disabled" value="<?php 
            $query = mysqli_query($conn, "SELECT SUM(berat) AS totalberat FROM setor WHERE nin='".$_SESSION['nin']."'");
            while($row = mysqli_fetch_array($query)){
			echo $row['totalberat']; }?>"/>
         </div>
        
         <input class="form-control" type="button" name="simpan" value="Simpan Data" style="background-color:#19f73e;" />
         <br>
         </div>       
      </div>
    </div>
    </section>
</div>
</div>
</body>
</html>
