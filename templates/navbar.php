<div class="navbar">
<a href="../index/index.php"><img src="../img/kislogo2.png" alt="logo" class="navbarimg">
<p class="pnav">JourneyMasters</p></a>
<ul class="topnav" id="mytopNav">
    <li><a href="../index/tervezes.php" id="elso">Tervezés</a></li>
    <li><a href="../index/utazasok.php">Utazások</a></li>
    <li><a href="../index/kosar.php"><i class="fa-solid fa-basket-shopping"></i></a></li>
    <li><a href="<?php echo (isset($_SESSION['utasid'])) ? '../index/login.php' : '../index/profil.php'?>"><i class="fa-solid fa-person-walking-luggage" id="fordit"></i></a></li>
    <li><a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a></li>
</ul>
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