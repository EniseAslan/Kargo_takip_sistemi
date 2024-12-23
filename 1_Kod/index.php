<!DOCTYPE html>
<?php 
include("config.php");

if(isset($_POST['gonder'])) {
    $kod = $_POST['kod'];
    header("Location:kargobilgisi.php?c=".$kod);
}
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ana Sayfa</title>
    <link rel="stylesheet" href="anasayfa.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <!--Header -->
    <div class="header">
      <nav class="navbar navbar-expand-lg" style="background-color: #293775">
        <div class="container-fluid">
          <a class="navbar-brand" style="color: rgb(113, 119, 124)" href="index.php"
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
              <a
                class="nav-link active"
                style="color: rgb(0, 0, 0)"
                aria-current="page"
                href="index.php"
                >Ana Sayfa</a
              >
              <a
                class="nav-link active"
                style="color: rgb(0, 0, 0)"
                aria-current="page"
                href="admin.php"
                >Admin</a
              >
            </div>
          </div>
        </div>
      </nav>
    </div>
    <!--HeaderSonu-->
    <!---->
    <section class="hero">
      <div class="container text-center">
        <div class="row">
          <div class="col align-self-start">
            <div class="clearfix">
              <img
                src="img/kargo.png"
                class="col-md-6 float-md-end mb-3 ms-md-3"
                alt="..."
              />

              <h2>
                "KargonBizde ile kargonuz güvende! Takip kodunuzu girerek
                kargonuzun nerede olduğunu anında öğrenin. Hızlı, güvenilir ve
                kullanıcı dostu kargo takip hizmetimizle her adımda sizinleyiz.
                Kargonuz bizimle güvende, yolculuğunu takip edin!"
              </h2>
            </div>
          </div>

          <div class="col align-self-center">
            <div class="input-field">
              <div class="wrapper">
                <div class="title">Kargo Takip Kodu</div>
                <form action="" method="post">
                  <div class="field">
                    <input type="text" name="kod" required />
                    <label>Takip Kodu</label>
                  </div>
                  <div class="field">
                    <input type="submit" name="gonder" value="Giriş" />
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="footer">
      <!-- Sosyal medya-->

      <!-- <a href="#" class="f-icon">
        <img src="/1_Kod/img/instagram (1).png" />
        <img src="/1_Kod/img/social-media (1) (1).png" />
        <img src="/1_Kod/img/social-media (2).png" />
      </a> -->
    </div>
  </body>
</html>
