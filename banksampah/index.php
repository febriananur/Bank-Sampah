<?php
require 'system/config/koneksi.php'
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KTN</title>
  <link rel="icon" href="asset\internal\img\img-local\logo.png" type="image/icon type">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Contrail+One|Raleway" rel="stylesheet">
  <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="asset/internal/css/style-index2.css">
  <link rel="stylesheet" href="asset/internal/css/main.css">
  
  <!-- preloader -->
  <script src="asset/internal/js/preloader.js" type="text/javascript"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $(".preloader").fadeOut();
    })
  </script>
  <!-- preloader -->


    <style>
    .carousel .item {
  height: 300px;
}

.item img {
    position: absolute;
    top: 0;
    left: 0;
    min-height: 300px;
}


.carousel .carousel-item {
  height: 500px;
}

.carousel-item img {
    position: absolute;
    object-fit:cover;
    top: 0;
    left: 0;
    min-height: 500px;
}
    </style>
</head>

<body id="home">

  <!--Pre Loader-->
  <div class="preloader">
    <div class="loading">
      <img src="asset/internal/img/img-local/spiner.gif" width="80">
    </div>
  </div>


  <!-- navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark shadow-sm bg-primary">
  <div class="container-fluid">

    <a class="navbar-brand" href="#">KTN</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active"  href="#about">about</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#stepby">Petunjuk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#team">Tim Kami</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="blog.html">Blog</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<!-- jumbotron -->
<section class="jumbotron jumbotron-image text-center">
  <h1 class="display-4">SiSTEM BANK SAMPAH</h1>
  
  <br>  
  <div class="bt">
     <a class="btn btn-primary btn-lg" href="page/logreg.php" role="button">Masuk atau Daftar</a>
     <!-- <a class="btn btn-primary btn-lg" href="page/register.php" role="button">Daftar</a> -->
  </div>
</section>




<!-- about -->
<section id="about">
<div class="container">
    <h3 class="text-center">Tentang kami</h3>
    <div class="row justify-content-center fs-5 text-center">
      <div class="col-md-4">
        <p>Kami adalah Cv dalam bidang teknologi yang bernama Kreasi Teknologi Nusantara yang membuat dan mengembangkan suatu perangkat lunak(Software) maupun perangkat keras(Hardware).</p>
      </div>
      <div class="col-md-4">
        <p>dalam kasus ini kami mengembangkan perangkat lunak yang bertujuan untuk mengelola data sampah yang akan ditukar dengan uang menarik kan ?.</p>
      </div>
    </div>
</div>
  </section>

<!-- stepbystep -->
<section id="stepby">
  <div class="judul text-center">
  <h2>How To ?</h2>
  </div>

<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000">
      <img src="asset\internal\img\img-content\1.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
       <h1>Daftarkan </h1>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="2000">
      <img src="asset\internal\img\img-content\2.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h1>Kumpulkan</h1>
      </div>
    </div>
    <div class="carousel-item">
      <img src="asset\internal\img\img-content\3.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h1>Tukarkan</h1>
      </div>
    </div>
    <div class="carousel-item">
      <img src="asset\internal\img\img-content\4.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h1>Dapatkan Uang</h1>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


</section>
<!-- team -->
<section id="team">
<div class="container">
  <div class="row text-center">
      <div class="col">
      <h2>Our Team</h2>
      </div>
  </div>
  <div class="row">
    <div class="col-md-3">
    <div class="card">
    <div class="img text-center" style="padding-top:10px;">
    <img src="asset\internal\img\img-local\team\p1.jpg" alt="team" style="width:200px">
    </div>
      <div class="card-body">
        <p class="card-text">Team Leader</p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card">
    <div class="img text-center" style="padding-top:10px;">
    <img src="asset\internal\img\img-local\team\p2.jpg" alt="team" style="width:200px">
    </div>
      <div class="card-body">
        <p class="card-text">IT Programmer</p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card">
    <div class="img text-center" style="padding-top:10px;">
    <img src="asset\internal\img\img-local\team\p3.jpg" alt="team" style="width:200px">
    </div>
      <div class="card-body">
        <p class="card-text">IT Programmer</p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card">
    <div class="img text-center" style="padding-top:10px;">
    <img src="asset\internal\img\img-local\team\p4.jpg" alt="team" style="width:200px">
    </div>
      <div class="card-body">
        <p class="card-text">IT Programmer</p>
      </div>
    </div>
  </div>
  </div>
</section>

  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#0099ff" fill-opacity="1" d="M0,160L48,176C96,192,192,224,288,218.7C384,213,480,171,576,149.3C672,128,768,128,864,138.7C960,149,1056,171,1152,170.7C1248,171,1344,149,1392,138.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>


<footer class="text-white text-center p-3">
   
      <p>Created by KTN 2021</p>
</footer>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="asset/internal/js/index.js"></script>
</body>

</html>