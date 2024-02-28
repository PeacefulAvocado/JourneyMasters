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