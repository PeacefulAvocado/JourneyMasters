<script src="../js/bekuld.js"></script>
<script src="../js/confirm.js"></script>
<?php
  require_once(__DIR__.'/../helpers/dbhandler.php');
  $dbhandler = new DbHandler();
  if(!isset($_SESSION)){
  session_start();
  }

  function encrypt($data, $key)
  {
      $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
      $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
      return base64_encode($encrypted . '::' . $iv);
  }

  $key = "dhsagjhkgsafg3t278fshfb2hg4r2467gr2bh23vr23gjh4b23hv2g3v42jhb2jh";

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

  if (isset($_POST['torles']))
  {
    $dbhandler->noreturnselect("update utazas set aktiv = 0 where utazasazon = ".$_POST['utazasid']);
  }

  if (isset($_POST['edit']))
  {
    $date = explode('-', $_POST['szulid']);
    $dbhandler->noreturnselect("UPDATE utasok 
    SET nev = '".$_POST['nev']."', 
        tel = '".$_POST['tel']."', 
        szulev = ".$date[0].", 
        szulho = ".$date[1].", 
        szulnap = ".$date[2].", 
        nem = '".$_POST['nem']."', 
        orszag = '".$_POST['orszag']."', 
        irszam = '".$_POST['irszam']."', 
        varos = '".$_POST['varos']."', 
        utca = '".$_POST['lakcim']."', 
        igtipus = '".$_POST['igtipus']."', 
        igszam = '".$_POST['igszam']."' 
    WHERE utasazon = ".$_SESSION['utasid']);

  }

  $utas = $dbhandler->select("select * from utasok where utasazon = ".$_SESSION['utasid'])[0];
  $_POST['nev'] = $utas['nev'];
  $_POST['tel'] = $utas['tel'];
  if (!isset($utas['szulho'][1]))
  {
      $utas['szulho'] = "0".$utas['szulho'];
  }
  if (!isset($utas['szulnap'][1]))
  {
      $utas['szulnap'] = "0".$utas['szulnap'];
  }
  $date = $utas['szulev']."-".$utas['szulho']."-".$utas['szulnap'];
  $_POST['szulid'] = $date;
  $_POST['nem'] = $utas['nem'];
  $_POST['orszag'] = $utas['orszag'];
  $_POST['irszam'] = $utas['irszam'];
  $_POST['varos'] = $utas['varos'];
  $_POST['lakcim'] = $utas['utca'];
  $_POST['igtipus'] = $utas['igtipus'];
  $_POST['igszam'] = $utas['igszam'];

  if (isset($_POST['pass']))
  {
    if ($_POST['ujjelszo'] == $_POST['ismetles'])
    {
      $jelszo = encrypt($_POST['ujjelszo'], $key);
      $dbhandler->noreturnselect("update userdata set jelszo = '$jelszo' where utasid = ".$_SESSION['utasid']);
      echo "<script>alert('Sikeres változtatás!')</script>";
    }
    else {
      echo "<script>alert('A két jelszó nem egyezik!')</script>";
    }
  }
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
        <input type="submit" value="Jelszó<?php echo "\n"?>módosítása" class="jelszobtn" name='pass' onclick = "return conf_submit()">
    </form>
</div>


<hr class="vonal">

<div class="utazasok">
  <p class="kiscim">Profilhoz tartozó utazások</p>

  <?php
    if ($utazasok == array())
    {
      echo "<p class='nincs'>Ehhez a profilhoz még nem tartoznak utazások!</p>";
    }
    else 
    {
      $utazasok = $dbhandler->select("select * from utazas where utasazon = ".$_SESSION['utasid']." and aktiv = 1");
      for ($i = 0; $i < count($utazasok); $i++)
      {
        $celpont = $utazasok[$i]['celpont'];
        $stars = $dbhandler->getKeresett('helyszin', 'csillag', 'nev', "'$celpont'")[0];
        $stars_str = "";
        for ($n = 0; $n < $stars; $n++) { 
            $stars_str .= "<i class='fa-solid fa-star'></i>";
        }
        $cim = $dbhandler->getKeresett('helyszin', 'varos', 'nev', "'$celpont'")[0].", ".$dbhandler->getKeresett('helyszin', 'cim', 'nev', "'$celpont'")[0];
        $fo = $dbhandler->select("select count(*) as '0' from csoport where csoportid = (select csoportid from csoport where utasid =".$_SESSION['utasid']." and utazasid = ".$utazasok[$i]['utazasazon'].")")[0][0];
        echo "
        <form action='".$_SERVER['PHP_SELF']."' method='post' class='tervezesegyeni'>
        <img src='../img/helyszinimg/".$celpont."/1.jpg' alt='Helyszín'>
        <p class='hotelnev'>".$celpont."</p>
        <p class='stars'>$stars_str</i></p>
        <p class='hotelcim'>$cim</p>
        <p class='fok'>$fo fő</p>
        <input type='hidden' name='utazasid' value='".$utazasok[$i]['utazasazon']."'>
        <button class='newbutton' onclick='' type='button'></button>
        <input type='submit' class='torlesbutton' name='torles' value=''>
      </form>
        ";
      }
      $utazasok = $dbhandler->select("select * from utazas where utasazon = ".$_SESSION['utasid']." and aktiv = 0");
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
          <form action='' method='post' class='tervezesegyeni inaktiv'>
            <img src='../img/helyszinimg/$celpont/1.jpg' alt='Helyszín'>
            <p class='hotelnev'>$celpont</p>
            <p class='stars'>$stars_str</i></p>
            <p class='hotelcim'>$cim</p>
            <p class='fok'>$fo fő</p>
          </form>
        ";
      }
  }
  ?>

    
 
</div>
<hr class="vonal">

<div class="profiladatok">
  <div class='utasdata'>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" id="edit">
  <label for="nev">Név:</label>
<input type='text' name='nev' id='nev' value="<?php echo isset($_POST['nev']) ? $_POST['nev'] : '' ?>">
<label for="tel">Telefonszám:</label>
<input type='tel' name='tel' id='tel' value="<?php echo isset($_POST['tel']) ? $_POST['tel'] : '' ?>">
<label for="szulid">Születési idő:</label>
<input type='date' name='szulid' id='szulid' value="<?php echo isset($_POST['szulid']) ? $_POST['szulid'] : '' ?>">
<label for="nem">Neme:</label>
<select name='nem' id='nem' value="<?php echo isset($_POST['nem']) ? $_POST['nem'] : '' ?>">
    <option value='Férfi' id='nem_ferfi'>Férfi</option>
    <option value='Nő' id='nem_no'>Nő</option>
    <option value='Egyéb' id='nem_egyeb'>Egyéb</option>
</select>
<label for="orszag">Ország:</label>
<input type='text' name='orszag' id='orszag' value="<?php echo isset($_POST['orszag']) ? $_POST['orszag'] : '' ?>">
<label for="irszam">Irányítószám:</label>
<input type='text' name='irszam' id='irszam' value="<?php echo isset($_POST['irszam']) ? $_POST['irszam'] : '' ?>">
<label for="varos">Település:</label>
<input type='text' name='varos' id='varos' value="<?php echo isset($_POST['varos']) ? $_POST['varos'] : '' ?>">
<label for="lakcim">Lakcím:</label>
<input type='text' name='lakcim' id='lakcim' value="<?php echo isset($_POST['lakcim']) ? $_POST['lakcim'] : '' ?>">
<label for="igtipus">Igazolványtípus:</label>
<select name='igtipus' id='igtipus' value="<?php echo isset($_POST['igtipus']) ? $_POST['igtipus'] : '' ?>">
    <option value='Személyi igazolvány' id='igtipus_szemelyi'>Személyi igazolvány</option>
    <option value='Útlevél' id='igtipus_utlevel'>Útlevél</option>
</select>
<label for="igszam">Igazolványszám:</label>
<input type='text' name='igszam' id='igszam' value="<?php echo isset($_POST['igszam']) ? $_POST['igszam'] : '' ?>">
  </div>
</div>
  <input type="hidden" name="edit" value = "true">
    <input type="button" value="Módosítás" class="adatmodositas" onclick="send_profil()">

</form>
</div>
</div>
</div>

