<?php
    require_once(__DIR__."/../helpers/dbhandler.php");
    $dbhandler = new DbHandler();
    $csomag = $_GET['csomag'];
    $hotel_nev = $_GET['helyszin'];
    $csomagid = $_GET['csomagid'];
    $ellatas = $_GET['ellatas'];
    $utasok_szama = $_GET['utasok_szama'];
?>
<script src="https://kit.fontawesome.com/7ad21db75c.js" crossorigin="anonymous"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">



<div class="foglalas">
    <div class="kepes">
        <?php echo "<img class ='kep' src='../img/helyszinimg/$hotel_nev/1.jpg'>"; ?>
        <div class="adatok">

        </div>
    </div>
</div>