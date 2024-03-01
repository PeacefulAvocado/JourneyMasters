<?php
    require_once(__DIR__.'/../helpers/dbhandler.php');
    $dbhandler = new DbHandler();
    session_start();
    if(!isset($_SESSION['utasid'])){
        header("Location: ../index/login.php");
        exit();
    }

   
?>
<script src='https://kit.fontawesome.com/7ad21db75c.js' crossorigin='anonymous'></script>
<link rel='preconnect' href='https://fonts.googleapis.com'>
<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
<link href='https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap' rel='stylesheet'>

<div class="kosarmain">
<div class="kosar">
<p class="kosarcim">Kosaram</p>
<hr class="vonal">


<div class="utazasok">
    <p class="kiscim">Félbehagyott foglalásaim</p>

  <?php 

     $kosar_items = $_SESSION['kosar_items'];
     //Végigmegy a $_SESSION['kosar_items'] tömbön, eldönti, hogy az adott elem csomag-e vagy nem, és ennek megfelelően lekérdezi, majd betölti az adatokat egy formba
     print_r($_SESSION);
  foreach($kosar_items as $item) {
    
    if($item['csomage'] == "true") {
        $csomagid = $item['csomagid'];
        $mettol = $dbhandler->getKeresett('csomagok', 'mettol', 'csomagid', $csomagid)[0];
        $meddig = $dbhandler->getKeresett('csomagok', 'meddig', 'csomagid', $csomagid)[0];
        $honnan = $dbhandler->getKeresett('csomagok', 'honnan', 'csomagid', $csomagid)[0];
        $celpont = $dbhandler->getKeresett('csomagok', 'celpont', 'csomagid', $csomagid)[0];

        
    } else {
      $hotel_nev = $item['hotel_nev'];
      $stars = $dbhandler->getKeresett('helyszin', 'csillag', 'nev', "'$hotel_nev'")[0];

      $cim = $dbhandler->getKeresett('helyszin', 'cim', 'nev', "'$hotel_nev'")[0];
      $varos = $dbhandler->getKeresett('helyszin', 'varos', 'nev', "'$hotel_nev'")[0];
      $mettol = $item['mettol'];
      $meddig = $item['meddig'];
      $stars_str = "";
      for ($n = 0; $n < $stars; $n++) { 
          $stars_str .= "<i class='fa-solid fa-star'></i>";
      }
      

      echo " <form action='../index/foglalas.php' method='post' class='tervezesegyeni'>
      <img src='../img/sydneyproba.jpg' alt='$varos'>
      <p class='hotelnev'>".$item['hotel_nev']."</p>
      <p class='stars'>$stars_str</p>
      <p class='hotelcim'>$cim</p>
      <p class='datum'>".$mettol."—".$meddig."</p>
      <p class='fok'>".$item['utasok_szama']." fő</p>
      <input type='hidden' name='csomag' value='false'>
      <input type='hidden' name='datum'  value=''>
      <input type='hidden' name='hotelcim' value=''>
      <button class='newbutton' onclick='alert("."asda".")' type='button'></button>
      <input type='submit' class='torlesbutton' value=''>
    </form>";
    }
    
  }

  ?>
   


    <form action="../index/foglalas.php" method="post" class="tervezesegyeni">
      <img src="../img/sydneyproba.jpg" alt="Sydney">
      <p class="hotelnev">Morocco Central</p>
      <p class="stars"><i class='fa-solid fa-star'></i></p>
      <p class="hotelcim">Sydney, Australia 30 Grosvenor St.</p>
      <p class="fok">3 fő</p>
      <input type="hidden" name="csomag" value="false">
      <input type="hidden" name="datum"  value="">
      <input type="hidden" name="hotelcim" value="">
      <button class="newbutton" onclick="alert('asda')" type="button"></button>
      <input type="submit" class="torlesbutton" value="">
    </form>
 
</div>
</div>