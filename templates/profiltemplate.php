<?php
  require_once(__DIR__.'/../helpers/dbhandler.php');
  $dbhandler = new DbHandler();
  if(!isset($_SESSION)){
  session_start();
  }
  if(!isset($_SESSION['utasid'])){
      header("Location: ../index/login.php");
      exit();
  }

  if (isset($_POST['kijel']))
  {
    $_SESSION['utasid'] = null;
    echo "<script>alert('Sikeresen kijelentkezett!')
    window.location.href = '../index/login.php';</script>";
  }
  $email = $dbhandler->getKeresettNoAktiv('userdata', 'email', 'utasid', $_SESSION['utasid'])[0];

  $utazasok = $dbhandler->select("select * from utazas where utasazon = ".$_SESSION['utasid']); 

?>
<div class="profilmain">
<div class="profil">
<p class="emailcim"><?= $email ?></p>
<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
    <input type="submit" name="kijel" value="Kijelentkezés" class="kijel">
</form>
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

  <?php
    if ($utazasok == array())
    {
      echo "<p>Ehhez a profilhoz még nem tartoznak utazások!</p>";
    }
    else 
    {
    for ($i = 0; $i < count($utazasok); $i++)
    {
      $celpont = $utazasok[$i]['celpont'];
      $stars = $dbhandler->getKeresett('helyszin', 'csillag', 'nev', "'$celpont'")[0];
      $stars_str = "";
      for ($n = 0; $n < $stars; $n++) { 
          $stars_str .= "<i class='fa-solid fa-star'></i>";
      }
      $cim = $dbhandler->getKeresett('helyszin', 'varos', 'nev', "'$celpont'")[0].", ".$dbhandler->getKeresett('helyszin', 'cim', 'nev', "'$celpont'")[0];
      $fo = $dbhandler->select("select count(*) as '0' from csoport where csoportid = (select csoportid from csoport where utasid =".$_SESSION['utasid'].");")[0][0];
      echo "
      <form action='../index/foglalas.php' method='post' class='tervezesegyeni'>
      <img src='../img/helyszinimg/".$celpont."/1.jpg' alt='Sydney'>
      <p class='hotelnev'>".$celpont."</p>
      <p class='stars'>$stars_str</i></p>
      <p class='hotelcim'>$cim</p>
      <p class='fok'>$fo fő</p>
      <input type='hidden' name='csomag' value='false'>
      <input type='hidden' name='datum'  value=''>
      <input type='hidden' name='hotelcim' value=''>
      <button class='newbutton' onclick='alert('asda')' type='button'></button>
      <input type='submit' class='torlesbutton' value=''>
    </form>
      ";
    }
  }
  ?>

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
        <label>Név:</label>
        <input type="text" name="nev">
        <label>Telefonszám:</label>
        <input type="tel" name="tel">
        <label>Szuletési idő:</label>
        <input type="date" name="szulid">
        <label>Lakcím:</label>
        <input type="text" name="lakcim">
        <label>Igazolványtípus:</label>
        <select name="igtipus" id="igtipus">
          <option value="Személyi igazolvány">Személyi igazolvány</option>
          <option value="Útlevél">Útlevél</option>
        </select>
        <label>Igazolványszám:</label>
        <input type="text" name="igszam">
    </div>
    <input type="submit" value="Módosítás" class="adatmodositas">

</form>
    
</div>






</div>
</div>
