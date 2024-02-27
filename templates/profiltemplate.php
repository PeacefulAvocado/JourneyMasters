<?php
  
  session_start();
  if(!isset($_SESSION['utasid'])){
      header("Location: ../index/login.php");
      exit();
  }
?>
<div class="profilmain">
<div class="profil">
<p class="emailcim">dzsonasz@gmail.com</p>
<hr class="vonal">
<div class="jelszovaltoztato">
    <form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="jelszo">
        <div class="jelszavak">
        <label for="ujjelszo">Új jelszó:</label>
        <input type="password" name="ujjelszo" id="ujjelszo" class="textinput">
        <label for="ismetles">Új jelszó ismétlése:</label>
        <input type="password" name="ismetles" id="ismetles" class="textinput">
        </div>
        <input type="submit" value="Jelszó<?php echo "\n"?>módosítása" class="jelszobtn">
    </form>
</div>


<hr class="vonal">

<div class="utazasok">
  <p class="kiscim">Profilhoz tartozó utazások</p>

  
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
      <button class="modositasbutton" onclick="alert('asda')" type="button"></button>
      <input type="submit" class="torlesbutton" value="">
    </form>


    <form action="../index/foglalas.php" method="post" class="tervezesegyeni inaktiv">
      <img src="../img/sydneyproba.jpg" alt="Sydney">
      <p class="hotelnev">Morocco Central</p>
      <p class="stars"><i class='fa-solid fa-star'></i></p>
      <p class="hotelcim">Sydney, Australia 30 Grosvenor St.</p>
      <p class="fok">3 fő</p>
      <input type="hidden" name="csomag" value="false">
      <input type="hidden" name="datum"  value="">
      <input type="hidden" name="hotelcim" value="">
      <button class="newbutton" onclick="alert('asda')" type="button" disabled></button>
      <button class="modositasbutton" onclick="alert('asda')" type="button"></button>
      <input type="submit" class="torlesbutton" value="">
    </form>
 
</div>
<hr class="vonal">

<div class="profiladatok">
    <p class="kiscim">Utazási adatok</p>
    <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
    <div class="adatok">
        <label for="nev">Név:</label>
        <input type="text" name="nev">
        <label for="tel">Telefonszám:</label>
        <input type="tel" name="tel">
        <label for="szulid">Szuletési idő:</label>
        <input type="date" name="szulid">
        <label for="lakcim">Lakcím:</label>
        <input type="text" name="lakcim">
        <label for="igtipus">Igazolványtípus:</label>
        <select name="igtipus" id="igtipus">
          <option value="Személyi igazolvány">Személyi igazolvány</option>
          <option value="Útlevél">Útlevél</option>
        </select>
        <label for="igszam">Igazolványszám:</label>
        <input type="text" name="igszam">
    </div>
    <input type="submit" value="Módosítás" class="adatmodositas">

</form>
    
</div>






</div>
</div>
