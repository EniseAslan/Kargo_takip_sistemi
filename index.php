<!DOCTYPE html>
<?php 
include("config.php");

$takipKodu = @$_GET["c"];

if(!$_GET) { //ANASAYFA OLMADIĞI İÇİN GEÇİCİ EKLENEN KOD
    header("Location: /index.php?c=1");
}

$KargoBilgisi = $baglanti->prepare("select * from kargo_bilgisi where Takip_Kodu = ?");
$KargoBilgisi->execute(array($takipKodu));
$KargoBilgisiF = $KargoBilgisi->fetch();
if(!$KargoBilgisiF) {
    echo "Kargo takip numarası hatalı"; //HATA SAYFASI OLMADIĞI İÇİN GEÇİCİ EKLENEN KOD
    die();
}
if($KargoBilgisiF) {
    $Alici_ID = $KargoBilgisiF["Alici_ID"];
    $Gonderici_ID = $KargoBilgisiF["Gonderici_ID"];
    $KargoDurumu = $KargoBilgisiF["Durum_Bilgisi"];
    $TahminiTeslimTarihi = $KargoBilgisiF["Tahmini_Teslim_Tarihi"];
    
    $AliciBilgisi = $baglanti->prepare("select * from alici where Alici_ID = ?");
    $AliciBilgisi->execute(array($Alici_ID));
    $AliciBilgisiF = $AliciBilgisi->fetch();
    if($AliciBilgisiF) {
        $AliciAdSoyad = $AliciBilgisiF["Ad_Soyad"];
        $AliciAdres = $AliciBilgisiF["Adres"];
    }

    $GondericiBilgisi = $baglanti->prepare("select * from gonderici where Gonderici_ID = ?");
    $GondericiBilgisi->execute(array($Gonderici_ID));
    $GondericiBilgisiF = $GondericiBilgisi->fetch();
    if($GondericiBilgisiF) {
        $GondericiAdSoyad = $GondericiBilgisiF["Gonderici_Ad_Soyad"];
    }
    $AtlananAdimRengi = "#2e3b85";
    $GelinmeyenAdimRengi = "#717588";
    $BulunanAdimRengi = "#b5093d";
    
    $Durum1Rengi = "color:".$GelinmeyenAdimRengi;
    $Durum2Rengi = "color:".$GelinmeyenAdimRengi;
    $Durum3Rengi = "color:".$GelinmeyenAdimRengi;
    $Durum4Rengi = "color:".$GelinmeyenAdimRengi;
    $Durum5Rengi = "color:".$GelinmeyenAdimRengi;
    
    switch($KargoDurumu){
        case 1:
            $Durum1Rengi = "color:".$BulunanAdimRengi;
            break;
        case 2:
            $Durum1Rengi = "color:".$AtlananAdimRengi;
            $Durum2Rengi = "color:".$BulunanAdimRengi;
            break;
        case 3:
            $Durum1Rengi = "color:".$AtlananAdimRengi;
            $Durum2Rengi = "color:".$AtlananAdimRengi;
            $Durum3Rengi = "color:".$BulunanAdimRengi;
            break;
        case 4:
            $Durum1Rengi = "color:".$AtlananAdimRengi;
            $Durum2Rengi = "color:".$AtlananAdimRengi;
            $Durum3Rengi = "color:".$AtlananAdimRengi;
            $Durum4Rengi = "color:".$BulunanAdimRengi;
            break;
        case 5:
            $Durum1Rengi = "color:".$AtlananAdimRengi;
            $Durum2Rengi = "color:".$AtlananAdimRengi;
            $Durum3Rengi = "color:".$AtlananAdimRengi;
            $Durum4Rengi = "color:".$AtlananAdimRengi;
            $Durum5Rengi = "color:".$BulunanAdimRengi;
    }
}

?>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="index.css" type="text/css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <!--header-->
    <div>
      <nav class="navbar navbar-expand-lg" style="background-color: #293775">
        <div class="container-fluid">
          <a class="navbar-brand" style="color: aliceblue" href="#"
            >KargonBizde</a
          >
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
    <div class="container">
      <div class="content">
        <div class=""><img src="img/resim.PNG" alt="resim" /></div>
        <div class="header">
          <p>KARGO ADRES BİLGİSİ VE GÖNDERİ DURUM TAKİBİ</p>
          <br />
          <div class="column">
          <div class="header-info">
            <p style= <?php printf($Durum1Rengi) ?> >Kargo Firmasına Verildi</p>
            <p style= <?php printf($Durum2Rengi) ?> >Sipariş Yolda</p>
            <p style= <?php printf($Durum3Rengi) ?> >Teslimat Şubesinde</p>
            <p style= <?php printf($Durum4Rengi) ?> >Kurye Dağıtımında</p>
            <p style= <?php printf($Durum5Rengi) ?> >Teslim Edildi</p>
            
          </div>
          <div class="header-info2">
            <p>Adres:</p>
            <p><?php printf($AliciAdres) ?></p>
          </div>
        </div>
        </div>
      </div>
      <div class="content">
        <div class="delivery-1">
          <div class="info-section">
            <div class="cargo-icon">
              <img src="img/Cargo.png" alt="Kargo İkonu" />
            </div>

            <div class="cargo-info">
              <p>
                Alıcı Adı Soyadı: <?php printf($AliciAdSoyad) ?> <br />Kargo Takip Numarası: <?php printf($takipKodu) ?> <br />------------------<br />Satıcı
                Adı Soyadı: <?php printf($GondericiAdSoyad) ?>
              </p>
            </div>
          </div>
          <div class="delivery-2">
            <div class="delivery-info">
              <div class="delivery-image">
                <img src="img/image.png" alt="Teslim Görseli" />
              </div>
            </div>

            <div class="delivery-date">
              <p>Tahmini Teslim Tarihi: <?php printf($TahminiTeslimTarihi) ?></p>
            </div>
          </div>
        </div>
        <div class="buttons-section">
          <button>
            <img src="img/chat (1).png" alt="Chat Icon" class="button-icon" />
            Teslimat Adresini Güncelle
          </button>
          <button>
            <img src="img/chat (1).png" alt="Chat Icon" class="button-icon" />
            Öneri ve Şikayetler
          </button>
        </div>
      </div>
    </div>

    <div class="footer">
      <!-- Sosyal medya-->

      <a href="#" class="f-icon">
        <img src="img/instagram (1).png" />
        <img src="img/social-media (1) (1).png" />
        <img src="img/social-media (2).png" />
      </a>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
