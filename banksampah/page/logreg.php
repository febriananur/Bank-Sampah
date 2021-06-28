<?php
  // use PHPMailer\PHPMailer\PHPMailer;
  // use PHPMailer\PHPMailer\SMTP;
  // use PHPMailer\PHPMailer\Exception;
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

    $sql  = mysqli_query($conn, "SELECT * FROM nasabah WHERE nin = '$nin'");

    if (mysqli_fetch_array($sql) > 0) {
      echo "
        <script>
          alert('Maaf akun sudah terdaftar');
        </script>";

      echo "<meta http-equiv='refresh'
      content='0; url=http://localhost/banks/banksampah/index.php'>";

      // return FALSE;      
    }

    mysqli_query($conn, "INSERT INTO nasabah VALUES ('$nin', '$nama', '$rt', '$alamat', '$telepon', '$email', '$password', '$saldo', '$sampah', 'belum_verifikasi')");
    
    // require '../../vendor/autoload.php';
    
    // $mail = new PHPMailer(true);

    // try {
    //   //Server settings
    //   $mail->SMTPDebug  = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    //   $mail->isSMTP();                                            //Send using SMTP
    //   $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    //   $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    //   $mail->Username   = 'fieryinferno33@gmail.com';                     //SMTP username
    //   $mail->Password   = 'NaonWeAh00';                               //SMTP password
    //   $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    //   $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //   //Recipients
    //   $mail->setFrom('fieryinferno33@gmail.com', 'Bank Sampah');
    //   $mail->addAddress('bagassetia271@gmail.com');
      
    //   $mail->isHTML(true);                                  //Set email format to HTML
    //   $mail->Subject = 'Verifikasi User';
    //   $mail->Body    = 'http://localhost/bank_sampah/banksampah/page/verifikasi.php?nin=' . $nin;

    //   $mail->send();
    // } catch (Exception $e) {
    //   echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    // }
    
    echo "
      <script>
        alert('Selamat berhasil input data!');
      </script>";

    echo "<meta http-equiv='refresh'
    content='0; url=http://localhost/banks/banksampah/index.php'>";
  }
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/internal/css/style.css">
    <title>Masuk Dan Daftar</title>
    <link rel="icon" href="..\asset\internal\img\img-local\logo.png" type="image/icon type">
    <script src="../asset/internal/js/27b0b64bf4.js"></script>
</head>
<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="cek_login.php" method="POST" class="sign-in-form">
                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="fa fa-user"></i>
                        <input type="text" name="user" id="user" placeholder="Username">
                    </div>
                    <div class="input-field">
                        <i class="fa fa-user"></i>
                        <input type="password" id="inputPassword" name="pass" placeholder="Password">
                    </div>
                    <button class="btn btn-lg btn-primary btn-block text-uppercase" name="login" value="Login" type="submit">Sign in</button>
                    
                    
                    <!-- <input type="submit" value="Login" class="btn solid"> -->

                </form>

                <form action="" method="POST" class="sign-up-form" onsubmit="return cek_data()">
                    <h2 class="title">Sign up</h2>
                    <div class="input-field">
                        <i class="fa  fa-id-card-o"></i>
                        <input style="cursor: not-allowed;" type="text" placeholder="no induk nasabah" name="nin" value="<?php echo $format; ?>" readonly/>
                    </div>
                    <div class="input-field">
                        <i class="fa fa-user"></i>
                        <input type="text" placeholder="nama nasabah" name="nama">
                    </div>
                <br>
                <div class="form-group">
                <label class="">Rukun Tetangga (RT)</label>
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
              <br>
                    <div class="input-field">
                        <i class="fa fa-address-card-o"></i>
                        <input type="text" placeholder="alamat" name="alamat">
                    </div>
                    <div class="input-field">
                        <i class="fa fa-mobile"></i>
                        <input type="text" placeholder="no telp/hp" name="telepon">
                    </div>
                    <div class="input-field">
                        <i class="fa fa-envelope"></i>
                        <input type="email" placeholder="email" name="email">
                    </div>
                    <div class="input-field">
                        <i class="fa fa-lock"></i>
                        <input type="password" id="inputPassword" name="password" placeholder="Password">
                    </div>
                    <button class="btn btn-lg btn-primary btn-block text-uppercase" name="simpan" value="Simpan" type="submit">Daftar</button>
                </form>
            </div>
        </div>


        <div class="panels-container">

            <div class="panel left-panel"> 
                <div class="content">
                    <h3>Baru Disini ?</h3>
                    <p>Silahkan Daftar terlebih dahulu</p>
                    <button class="btn transparent" id="sign-up-btn">Sign Up</button>
                    
                    <div class="back" style="padding-top:10px ">
                    <a href="../index.php">
                      <button class="btn transparent" ><i class="fa fa-home"></i> Back</button>
                    </a>
                    </div>
                    
                </div>
                <img src="..\asset\internal\img\img-local\undraw_programmer_imem.svg" alt="" class="image">
            </div>

            <div class="panel right-panel"> 
                <div class="content">
                    <h3>Sudah Member ?</h3>
                    <p>Silahkan Masuk terlebih dahulu</p>
                    <button class="btn transparent" id="sign-in-btn">Sign in</button>
                    <div class="back" style="padding-top:10px ">
                    <a href="../index.php">
                      <button class="btn transparent" style="" ><i class="fa fa-home"></i> Back</button>
                    </a>
                </div>
                </div>
                
                <img src="..\asset\internal\img\img-local\undraw_secure_login_pdn4.svg" alt="" class="image">
            </div>

        </div>
    </div>

    </div>
<script src="../asset/internal/js/app.js"></script>
</body>
</html>