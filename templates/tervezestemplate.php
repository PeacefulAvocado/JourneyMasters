<script src="https://kit.fontawesome.com/7ad21db75c.js" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

<!--Daterange picker-->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script src="../js/bekuld.js"></script>

<?php
    require_once(__DIR__."/../helpers/dbhandler.php");
    $dbhandler = new DbHandler();
?>

<div class="tervezesmain">
<div class="tervezes">
<div class="valaszto">

<form class="tervezesform" action="" method="get" id="kereso">
    <div class="formtop">
        <p class="tervezescim">Tervezés:</p>
        <img src="../img/globepin.png" alt="Földgömb" class="ikon">
    </div>
    <div class="orange">
        <label for="indulas" class="indulaslabel">Indulás</label>
        <?php
        $indulas = ""; 
        if(isset($_GET['indulas'])){
          $indulas = $_GET['indulas'];
        }
        $celpont = ""; 
        if(isset($_GET['celpont'])){
          $celpont = $_GET['celpont'];
        }

        ?>
        <input type="text" name="honnan" id="honnan" class="helyinput" value="<?php echo $indulas?>">
        <label for="celpont" class="celpontlabel">Célpont</label>
        <input type="text" name="celpont" id="celpont" class="helyinput" oninput="emptyContainers()"  value="<?php echo $celpont?>">
    </div>
        <div class="datumdiv">
        <label for="daterange" class="kezdetlabel">Indulás dátuma:</label>
        <label for="daterange" class="veglabel">Visszaút dátuma:</label>
        <input type="text" name="daterange" class="daterange" value="01/01/2024 - 01/15/2024" id="daterange">
        </div>
</form>
</div>
<div class="szallashelyek">
  <p class="kiscim">Szálláshelyek</p>
  <hr class="vonal">
  <div class="szallashelycontainer" id="helyszinek">
    <?php 
    $helyszin = $dbhandler->select("select * from helyszin where aktiv = 1 and varos like '%%' limit 0, 3");
    for($i = 0; $i < 3;$i++) {
      $hotel_nev = $helyszin[$i]['nev'];
      $varos = $helyszin[$i]['varos'];
      $cim = $helyszin[$i]['cim'];
      $csillag = $helyszin[$i]['csillag'];
      $ar = $helyszin[$i]['ar'];
      $stars = "";
      for($j = 0; $j < $csillag;$j++) {
        $stars.="<i class='fa-solid fa-star'></i>";
      }

      echo "<form action='../index/reszletek.php' method='get' class='tervezesegyeni' id='hely'>
      <img src='../img/sydneyproba.jpg' alt='$varos'>
      <p class='hotelnev'>$hotel_nev</p>
      <p class='stars'>$stars</p>
      <br>
      <p class='hotelcim'>$varos, $cim</p>
      <p class='ar'>$ar Ft / fő -től</p>
      <input type='hidden' name='csomag' value='false'>
      <input type='hidden' name='hotelcim' value='$cim'>
      <input type='button' value='' class='newbutton button' onclick='bekuld()'>
    </form>";
    }
    ?>

</div>
<button class='tobb' id="loadMoreHelyszinBtn">Több<br>betöltése</button>
<!--<p id="end_of_page" class='vege' style="display: none;">A végére ért</p>-->
</div>


<div class="csomagok">
  <p class="kiscim">Csomagok</p>
  <hr class="vonal">
  <div class="csomagcontainer" id="csomagcontainer">
  <?php 
    $csomagok = $dbhandler->select("SELECT * from helyszin inner join csomagok on helyszin.nev = csomagok.celpont where csomagok.aktiv = 1 and varos like '%%' limit 0, 3");

    for($i = 0; $i < count($csomagok);$i++) {
      
      $varos = $csomagok[$i]['varos'];
      $celpont = $csomagok[$i]['celpont'];
      $honnan = $csomagok[$i]['honnan'];
      $mettol = $csomagok[$i]['mettol'];
      $meddig = $csomagok[$i]['meddig'];
      $ar = $csomagok[$i]['ar'];
      $utazasmod = $csomagok[$i]['utazasmod'];
      $csomagid = $csomagok[$i]['csomagid'];
      
      if ($utazasmod == 'Repülő') 
        {
            $utazasmod = "plane";
        }
        else if ($csomagok[$i]['utazasmod'] == 'Vonat') 
        {
            $utazasmod = "train";
        }
        else {
            $utazasmod = "bus";
        }


      echo "<form action='../index/foglalas.php' method='get' class='csomagform' id='a1'>
      <img src='../img/helyszinimg/$celpont/1.jpg' alt='$varos'>
      <p class='varosnev'>$varos</p>
      <br>
      <p class='repter'>$honnan<i class='fa-solid fa-$utazasmod' style='color:#000000'></i>$varos</p>
      <br>
      <p class='datum'>$mettol  — $meddig</p>
      <p class='ar'>$ar Ft / fő -től</p>
      <input type='hidden' name='csomag' value='true'>
      <input type='hidden' name='helyszin' id='helyszin' value='$celpont'>
      <input type='hidden' name='csomagid' value='$csomagid'>
      <input type='submit' value='' class='newbutton button'>
    </form>";
    }
    ?>
    
  </div>
  <button class='tobb' id="loadMoreCsomagBtn">Több<br>betöltése</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../js/load-more-tervez-helyszin.js"></script>
<script src="../js/emptyDiv.js"></script>