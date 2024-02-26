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
<h1>Foglalásom részletei</h1>
    <div class="grid">

        <div class="kepes">
            <?php echo "<img class ='kep' src='../img/helyszinimg/$hotel_nev/1.jpg'>"; ?>
            <div class="adatok">
                <?php
                $varos = $dbhandler->getKeresett('helyszin', 'varos', 'nev', "'$hotel_nev'")[0];
                $cim = $dbhandler->getKeresett('helyszin', 'cim', 'nev', "'$hotel_nev'")[0];
                $stars = $dbhandler->getKeresett('helyszin', 'csillag', 'nev', "'$hotel_nev'")[0];
                $stars_str = "";
                for ($n = 0; $n < $stars; $n++) { 
                    $stars_str .= "<i class='fa-solid fa-star'></i>";
                }
                    echo "
                        <p class='hotelnev'>$hotel_nev <span class='stars'>$stars_str</span></p>
                        <p class='cim'>$varos, $cim</p>
                    ";
                ?>
            </div>
        </div>
        <div class="reszletek">

        </div>
    </div>
</div>