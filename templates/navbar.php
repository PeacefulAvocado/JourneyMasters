
<div class="topnav" id="mytopNav">
<a href="../index/index.php" class="left"><img src="../img/kislogo2.png" alt="logo" class="navbarimg"><p class="pnav">JourneyMasters</p></a>
<div class="jobb">
<a href="../index/tervezes.php" id="elso">Tervezés</a>
<a href="../index/utazasok.php">Utazások</a>
<a href="../index/kosar.php"><i class="fa-solid fa-basket-shopping"></i></a>
<a href="<?php echo (isset($_SESSION['utasid'])) ? '../index/login.php' : '../index/profil.php'?>"><i class="fa-solid fa-person-walking-luggage" id="fordit"></i></a>
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