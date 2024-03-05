<?php
$kosardb = 0;
//Elindítja a SESSION-t ha eddig nem futott
if(!isset($_SESSION)){
  session_start();
  //Kiírja a kosárban található elemek számát
  if(isset($_SESSION['kosar_items'])){
    $kosardb = count($_SESSION['kosar_items']);
  }
}
?>

<div class="topnav" id="mytopNav">
<a href="../index/index.php" class="left"><img src="../img/kislogo2.png" alt="logo" class="navbarimg"><p class="pnav">JourneyMasters</p></a>
<div class="jobb">
<a href="../index/tervezes.php" id="elso">Tervezés</a>
<a href="../index/utazasok.php">Utazások</a>
<a href="../index/kosar.php"><i class="fa-solid fa-basket-shopping"></i><p class="kosardb"><?=$kosardb?></p></a>
<!--Ha nincs bejelentkezve a felhasználó, akkor a profil helyett a bejelentkezés oldalra dobja-->
<a href="<?php echo (isset($_SESSION['utasid'])) ? '../index/profil.php' : '../index/login.php'?>"><i class="fa-solid fa-person-walking-luggage" id="fordit"></i></a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()"><i class="fa fa-bars"></i></a>
</div>
</div>

<script>

function myFunction() {
  var x = document.getElementById("mytopNav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>