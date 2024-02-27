<script src="https://kit.fontawesome.com/7ad21db75c.js" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



<div class="tervezesmain">
<div class="tervezes">
<div class="valaszto">

<form class="tervezesform" action="" method="get">
    <div class="formtop">
        <p class="tervezescim">Tervezés:</p>
        <img src="../img/globepin.png" alt="Földgömb" class="ikon">
    </div>
    <div class="orange">
        <label for="indulas" class="indulaslabel">Indulás</label>
        <input type="text" name="indulas" id="indulas" class="helyinput">
        <label for="celpont" class="celpontlabel">Célpont</label>
        <input type="text" name="celpont" id="celpont" class="helyinput">
    </div>
        <div class="datumdiv">
        <label for="daterange" class="kezdetlabel">Indulás dátuma:</label>
        <label for="daterange" class="veglabel">Visszaút dátuma:</label>
        <input type="text" name="daterange" class="daterange" value="01/01/2024 - 01/15/2024">
        </div>
</form>
</div>
<div class="szallashelyek">
  <p class="kiscim">Szálláshelyek</p>
  <hr class="vonal">
  <div class="szallashelycontainer">
    <form action="../index/foglalas.php" method="get" class="tervezesegyeni">
      <img src="../img/sydneyproba.jpg" alt="Sydney">
      <p class="hotelnev">Morocco Central</p>
      <p class="stars"><i class='fa-solid fa-star'></i></p>
      <br>
      <p class="hotelcim">Sydney, Australia 30 Grosvenor St.</p>
      <p class="ar">93.100 Ft / fő -től</p>
      <input type="hidden" name="csomag" value="false">
      <input type="hidden" name="datum" id="datum" value="">
      <input type="hidden" name="hotelcim" value="">
      <input type="submit" value="" class="newbutton button">
    </form>
  </div>
</div>


<div class="csomagok">
  <p class="kiscim">Csomagok</p>
  <hr class="vonal">
  <div class="csomagcontainer">
    <form action="../index/foglalas.php" method="get" class="csomagform" id='a1'>
      <img src="../img/sydneyproba.jpg" alt="Sydney">
      <p class="varosnev">Sydney</p>
      <br>
      <p class='repter'>BUD<i class='fa-solid fa-plane' style="color:#000000"></i>SDY</p>
      <br>
      <p class='datum'>2024.01.01  — 2224.01.01</p>
      <p class="ar">93.100 Ft / fő -től</p>
      <input type="hidden" name="csomag" value="true">
      <input type="hidden" name="helyszin" id="helyszin" value="">
      <input type="hidden" name="csomagid" value="">
      <input type="submit" value="" class="newbutton button">
    </form>
  </div>
</div>





</div>
</div>




<script>
$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'right'
  }, function(start, end, label) {
    
  });
});
</script>