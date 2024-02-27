<?php
    require_once(__DIR__."/../helpers/dbhandler.php");
    $dbhandler = new DbHandler();
    $csomag = $_GET['csomag'];
    $hotel_nev = $_GET['helyszin'];
    $csomagid = $_GET['csomagid'];
    $ellatas = $_GET['ellatas'];
    $utasok_szama = $_GET['utasok_szama'];
    switch ($ellatas)
    {
        case "Csak Szállás":
            $etkezesek = "Nincs";
            $szorzo = 0;
            break;
        case "All inclusive":
            $etkezesek = "Reggeli<br>Ebéd<br>Vacsora<br>Szobaszervíz";
            $szorzo = 1;
            break;
        case "Félpanzió":
            $etkezesek = "Reggeli<br>Vacsora";
            $szorzo = 0.5;
            break;
        case "Teljes panzió":
            $etkezesek = "Reggeli<br>Ebéd<br>Vacsora";
            $szorzo = 0.8;
            break;
        case "Szállás és Reggeli":
            $etkezesek = "Reggeli";
            $szorzo = 0.2;
            break;

    }
?>
<script src="https://kit.fontawesome.com/7ad21db75c.js" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">



<div class="foglalas">
<h1>Foglalásom részletei</h1>
    <div class="grid">

        <div class="kepes">
            <?php echo "<a href='../index/reszletek.php?csomag=$csomag&helyszin=$hotel_nev&csomagid=$csomagid' target='_blank'>"; ?>
            <?php echo "<img class ='kep' src='../img/helyszinimg/$hotel_nev/1.jpg'>"; ?>
            <div class="adatok">
                <?php
                $ar = $dbhandler->getKeresett('csomagok', 'ar', 'csomagid', $csomagid)[0];
                $mettol = $dbhandler->getKeresett('csomagok', 'mettol', 'csomagid', $csomagid)[0];
                $meddig = $dbhandler->getKeresett('csomagok', 'meddig', 'csomagid', $csomagid)[0];
                $honnan = $dbhandler->getKeresett('csomagok', 'honnan', 'csomagid', $csomagid)[0];
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
            </a>
        </div>
        <div class="reszletek">
                <div class="ellatas">
                    <p class="e1">Ellátás: </p>
                    <?php echo "<p class='e2'>$ellatas</p>";?>
                </div>
                <div class='etkezesek'>
                    <p class="et1">Étkezések:</p>
                    <p class="et2"><?php echo $etkezesek; ?></p>
                </div>
                <div class="utazok_szama">
                    <p class ="kicsi">Utazók száma: </p><br>
                    <b><?php echo "<p class='nagy'>$utasok_szama fő</p>"; ?></b>
                </div>
                <div class="utazas">
                <!--<select name="utazas" id="utazas" onchange="Icon()">
                        <option value="Repülő">Repülő</option>
                        <option value="Vonat">Vonat</option>
                        <option value="Busz">Busz</option>
                        <option value="Egyéni">Egyéni</option>
                </select>-->
                    <?php echo "<p class='ut'><b>$honnan <span id='icon'><i class='fa-solid fa-plane'></i></span> $varos</b></p>";?>
                </div>
                <?php echo "<p class='idopont'>$mettol — $meddig</p>"; ?>
                <div class="ar">
                    <div class="reszek">
                        <p class="sz1">Szállás</p>
                        <?php echo "<p class='sz2'>$utasok_szama x $ar HUF</p>"; ?>
                        <p class="sz1">Ellátás</p>
                        <?php echo "<p class='sz2'>$utasok_szama x ".($ar * $szorzo)." HUF</p>"; ?>
                    </div>
                        <?php echo "<p class='osszeg'>".($utasok_szama * $ar + $utasok_szama * ($ar * $szorzo))." HUF</p>"; ?>
                </div>

                
        </div>
    </div>
    <div class="utasadatok">
        <h3>Utasok adatai: </h3>
        <?php
            for ($i = 0; $i < $utasok_szama; $i++)
            {
                    echo "";
            }
        ?>
           
    </div>
</div>