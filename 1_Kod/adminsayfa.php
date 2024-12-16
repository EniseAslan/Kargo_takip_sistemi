<!DOCTYPE html>
<?php 
include("config.php");
session_start();

if(empty($_SESSION['email'])) {
    header("Location:admin.php");
} 

$sirketBilgisi = $baglanti->prepare("select * from kargo_sirketi where Sirket_Email=?");
$sirketBilgisi->execute(array($_SESSION['email']));
$sirketBilgisiF = $sirketBilgisi->fetch();
$sirketID = $sirketBilgisiF['Sirket_ID'];

$kargolar = $baglanti->prepare("select * from kargo_bilgisi where Sirket_ID=?");
$kargolar->execute(array($sirketID));
$kargolarF = $kargolar->fetchAll(PDO::FETCH_ASSOC);
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
            
              
            </div>
            <a href="logout.php" class="btn btn-light">Çıkış</a>
          </div>
        </div>
      </nav>
    </div>
    <!--  Container   -->

    <div class="container_bir">
      <h1 class="text-center mb-4">Kargo Şirketleri</h1>
      <div id="companies" class="list-group">
        <!--x-->
        <?php
        foreach ($kargolarF as $kargo)
        {
        $kargodurumu = $kargo['Durum_Bilgisi'];
        switch($kargodurumu){
            case 1:
                $durum = "Kargo Firmasına Verildi";
                break;
            case 2:
                $durum = "Sipariş Yolda";
                break;
            case 3:
                $durum = "Teslimat Şubesinde";
                break;
            case 4:
                $durum = "Kurye Dağıtımında";
                break;
            case 5:
                $durum = "Teslim Edildi";
                break;
        }
        echo '
        <div class="list-group-item">
          <p class="company-name fw-bold">
            Takip Numarası:'.$kargo['Takip_Kodu'].
            '<a
              href="adminpanel.php?c='.$kargo['Takip_Kodu'].'"
              style="margin-left: 100px"
              class="btn btn-secondary btn-sm"
            >
              Düzenle
            </a>
          </p>

          <ul class="cargo-list">
            <li>'.$durum.'</li>
          </ul>
        </div>';
        }
        ?>
        <!--x-->
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
