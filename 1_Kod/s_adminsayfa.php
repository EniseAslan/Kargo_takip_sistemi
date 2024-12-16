<!DOCTYPE html>
<?php 
include("config.php");
session_start();

if(empty($_SESSION['email'])) {
    header("Location:s_admin.php");
} 

$sirketler = $baglanti->prepare("select * from kargo_sirketi");
$sirketler->execute();
$sirketlerF = $sirketler->fetchAll(PDO::FETCH_ASSOC);


?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="s_adminsayfa.css" />

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <style>
      .cargo-list {
        display: none;
      }
      .company-name {
        cursor: pointer;
      }
    </style>
  </head>
  <body>
    <div class="header">
      <nav class="navbar navbar-expand-lg" style="background-color: #293775">
        <div class="container-fluid">
          <a class="navbar-brand" style="color: aliceblue" href="index.php"
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
              <a class="nav-link active" aria-current="page" href="index.php"
                >Ana Sayfa</a
              >
            </div>
          </div>
        </div>
      </nav>
    </div>
    <!--  Container   -->

    <div class="container text-center">
      <div class="row">
        <div class="col">
          <div class="container_bir">
            <div class="container mt-5">
              <h1 class="text-center mb-4">Şirketler</h1>
              <div id="companies" class="list-group">
                <!--x-->
                <?php
                foreach ($sirketlerF as $sirket)
                echo '
                <div class="list-group-item">
                  <p class="company-name fw-bold">'.$sirket['Sirket_Adi'].'</p>
                  <ul class="cargo-list">
                    <p>'
                      .$sirket['Tel_No'].
                    '</p>
                    <button type="button" class="btn btn-secondary">
                      Düzenle
                    </button>
                  </ul>
                </div>';
                ?>
                <!--x-->
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="container_bir">
            <div class="container mt-5">
              <h1 class="text-center mb-4">Kargolar</h1>
              <div id="companies" class="list-group">
                <!--x-->
                <?php
                foreach ($sirketlerF as $sirket)
                {
                echo '
                <div class="list-group-item">
                  <p class="company-name fw-bold">'.$sirket['Sirket_Adi'].'</p>
                  <ul class="cargo-list">';
                      $kargolar = $baglanti->prepare("select * from kargo_bilgisi where Sirket_ID=?");
                      $kargolar->execute(array($sirket['Sirket_ID']));
                      $kargolarF = $kargolar->fetchAll(PDO::FETCH_ASSOC);
                      foreach ($kargolarF as $kargo) 
                      {
                      echo '
                    <li>Takip numarası:'.$kargo['Takip_Kodu'].'</li>
                    <button type="button" class="btn btn-secondary btn-sm">
                      Düzenle
                    </button>';
                        }
                  echo '</ul>
                </div>';
                }
                ?>
                <!--x-->
              </div>
            </div>
          </div>

          <script>
            document.querySelectorAll(".company-name").forEach((company) => {
              company.addEventListener("click", () => {
                document.querySelectorAll(".cargo-list").forEach((list) => {
                  list.style.display = "none";
                });

                const cargoList = company.nextElementSibling;
                cargoList.style.display = "block";
              });
            });
          </script>
        </div>
      </div>
    </div>

    <div class="footer">
      <!-- Sosyal medya-->

      <a href="#" class="f-icon">
        <img src="/img/instagram (1).png" />
        <img src="/img/social-media (1) (1).png" />
        <img src="/img/social-media (2).png" />
      </a>
    </div>
  </body>
</html>
