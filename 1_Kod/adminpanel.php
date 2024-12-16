<!DOCTYPE html>
<?php 
include("config.php");
if(!$_GET && !$_POST) { 
    header("Location: /admin.php");
}
$takipKodu = @$_GET["c"];
if(isset($_POST['Gonder'])) {
    $yeniDurum = $_POST['Secim'];
    if($yeniDurum == 1 || $yeniDurum == 2 || $yeniDurum == 3 || $yeniDurum == 4 || $yeniDurum == 5){
        $durumGuncelle = $baglanti->prepare("update kargo_bilgisi set Durum_Bilgisi=? where Takip_Kodu=?");
        $durumGuncelle->execute(array($yeniDurum,$takipKodu));
        if($durumGuncelle) {
            echo "Güncelleme başarılı";
        }
    }
    
}


$KargoBilgisi = $baglanti->prepare("select * from kargo_bilgisi where Takip_Kodu = ?");
$KargoBilgisi->execute(array($takipKodu));
$KargoBilgisiF = $KargoBilgisi->fetch();
if(!$KargoBilgisiF) {
    echo "Kargo takip numarası hatalı"; //HATA SAYFASI OLMADIĞI İÇİN GEÇİCİ EKLENEN KOD
    die();
}
else {
    $Alici_ID = $KargoBilgisiF["Alici_ID"];
    $Gonderici_ID = $KargoBilgisiF["Gonderici_ID"];
    $KargoDurumu = $KargoBilgisiF["Durum_Bilgisi"];
    $TahminiTeslimTarihi = $KargoBilgisiF["Tahmini_Teslim_Tarihi"];
}

    $GondericiBilgisi = $baglanti->prepare("select * from gonderici where Gonderici_ID = ?");
    $GondericiBilgisi->execute(array($Gonderici_ID));
    $GondericiBilgisiF = $GondericiBilgisi->fetch();
    if($GondericiBilgisiF) {
        $GondericiAdSoyad = $GondericiBilgisiF["Gonderici_Ad_Soyad"];
    }

    $AliciBilgisi = $baglanti->prepare("select * from alici where Alici_ID = ?");
    $AliciBilgisi->execute(array($Alici_ID));
    $AliciBilgisiF = $AliciBilgisi->fetch();
    if($AliciBilgisiF) {
        $AliciAdSoyad = $AliciBilgisiF["Ad_Soyad"];
        $AliciAdres = $AliciBilgisiF["Adres"];
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
?>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="adminpanel.css" />
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
              <a href="logout.php" class="btn btn-light">Çıkış</a>
            </div>
          </div>
        </div>
      </nav>
    </div>



</head>
<body>

<section>
    <div class="container">
        <div class="contactInfo">
              <form action="" method="post">
                  <h2>Kargo Durumu</h2>
                  <br><br><br>
            <select class="form-select" aria-label="Default select example" name="Secim">
                <option selected>Kargo Durumları</option>
                <option value="1">Kargo Firmasına Verildi</option>
                <option value="2">Sipariş Yolda</option>
                <option value="3">Teslimat Şubesinde</option>
                <option value="4">Kurye Dağıtımında</option>
                <option value="5">Teslim Edildi</option>
              </select><br><br>
              <input type="submit" name="Gonder" class="btn btn-outline-dark"/>
              </form>
        </div>
        <div class="contactForm">
           <div class="Form1">
            <div class="container-md">
                <p style= <?php printf($Durum1Rengi) ?> >Kargo Firmasına Verildi</p>
            <p style= <?php printf($Durum2Rengi) ?> >Sipariş Yolda</p>
            <p style= <?php printf($Durum3Rengi) ?> >Teslimat Şubesinde</p>
            <p style= <?php printf($Durum4Rengi) ?> >Kurye Dağıtımında</p>
            <p style= <?php printf($Durum5Rengi) ?> >Teslim Edildi</p>
            
            </div>
            <div class="container-lg">
                <p>
                    Gönderici Bilgisi: <?php printf($GondericiAdSoyad) ?>
                    

                </p>
                <p>
                    Kargo Adres Bilgisi: <?php printf($AliciAdres) ?>
                </p>
                <p>
                    Tahmini Teslim Tarihi: <?php printf($TahminiTeslimTarihi) ?>
                </p>
            </div>

              </div>
              <div class="card" style="width: 8rem; height: 9rem; padding: 8px; margin-top:20px ;">
                <img src="/1_Kod/img/image.png" class="card-img-top" alt="...">
                <div class="card-body">
                  
                  <a href="#" style="width: 100px; height: 40px;" class="btn btn-dark">Onay</a>
                </div>
              </div>
            </div>
        </div>
    </div>

</section>









    
    <div class="footer">
        <!-- Sosyal medya-->
  
        <a href="#" class="f-icon">
          <img src="img/instagram (1).png" />
          <img src="img/social-media (1) (1).png" />
          <img src="img/social-media (2).png" />
        </a>
      </div>
    
</body>
</html>