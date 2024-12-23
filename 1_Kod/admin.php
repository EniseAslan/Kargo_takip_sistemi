<!DOCTYPE html>
<?php 
include("config.php");
session_start();
if(!empty($_SESSION['email'])) {
    header("Location:adminsayfa.php");
} 

if(isset($_POST['Giris'])) {
    $email = $_POST["Email"];
    $sifre = $_POST["Sifre"];
    $giris = $baglanti->prepare("select * from kargo_sirketi where Sirket_Email =? and Sirket_Password=?");
    $giris->execute(array($email,$sifre));
    $girisF = $giris->fetch();
    if($girisF) {
        echo "Giriş başarılı";
        $_SESSION['email'] = $email;
        header("Location:adminsayfa.php");
    }
    else {
        echo "Giriş başarısız";
    }
}
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="admin.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <title>Document</title>
  </head>
  <body>
    <div class="header">
      <nav class="navbar navbar-expand-lg" style="background-color: #293775">
        <div class="container-fluid">
          <a class="navbar-brand" style="color: aliceblue" href="#"
            >KargonBizde</a
          >
          <!--Header Kısmı-->
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-link active" aria-current="page" href="#"
                >Ana Sayfa</a
              >
            </div>
          </div>
        </div>
      </nav>
    </div>

    <!--Login-->
    <div class="wrapper">
      <div class="title">Admin Girişi</div>
      <form action="" method="post">
        <div class="field">
          <input type="text" name="Email" required />
          <label>Email Adresiniz</label>
        </div>
        <div class="field">
          <input type="password" name="Sifre" required />
          <label>Şifreniz</label>
        </div>
        <div class="field">
          <input type="submit" name="Giris" value="Giriş" />
        </div>
      </form>
    </div>

    <div class="footer">
      <!-- Sosyal medya-->

      <a href="#" class="f-icon">
        <img src="/1_Kod/img/instagram (1).png" />
        <img src="/1_Kod/img/social-media (1) (1).png" />
        <img src="/1_Kod/img/social-media (2).png" />
      </a>
    </div>
  </body>
</html>
