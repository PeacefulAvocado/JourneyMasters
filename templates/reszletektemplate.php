<?php
    require_once(__DIR__."/../helpers/dbhandler.php");
    $dbhandler = new DbHandler();
   
?>
<script src="https://kit.fontawesome.com/7ad21db75c.js" crossorigin="anonymous"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

<div class="reszletekmain">
<div class="reszletek">
    <?php
        $csomag = $_GET['csomag'];
        $hotel_nev = $_GET['helyszin'];
        $csomagid = $_GET['csomagid'];

        $stars = $dbhandler->getKeresett('helyszin', 'csillag', 'nev', "'$hotel_nev'")[0];
        $stars_str = "";
        for ($n = 0; $n < $stars; $n++) { 
            $stars_str .= "<i class='fa-solid fa-star'></i>";
        }

        $mettol = $dbhandler->getKeresett('csomagok', 'mettol', 'csomagid', $csomagid)[0];
        $meddig = $dbhandler->getKeresett('csomagok', 'meddig', 'csomagid', $csomagid)[0];
        echo "<div class='reszletektop'>
            <img src='../img/helyszinimg/$hotel_nev/1.jpg' alt='Városkép' class='reszleteknagykep'>
            <div class='reszletektoptext'>
            <p class='reszletekhotelnev'>$hotel_nev</p>
            <p class='stars'>$stars_str</p>
            <p class='reszletekdatum'>$mettol - $meddig</p>
            </div>";
    ?>

    
    </div>

    <div class="slideshow-container">
 <?php
    $directory = "../img/helyszinimg/" . $dbhandler->getKeresett('csomagok', 'celpont', 'csomagid', $csomagid)[0];
    $len = count(scandir($directory)) - 2;

    for($i = 1; $i <= $len; $i++) {
        echo "<div class='mySlides fade'>
        <div class='numbertext'>$i / $len</div>
    <img src='$directory/$i.jpg' class='sliderimg'>
    </div>";
    }
 ?>
    
  
    

    
    <a class="prev" onclick="plusSlides(-1)">❮</a>
    <a class="next" onclick="plusSlides(1)">❯</a>

    </div>
    <hr id="reszletekvonal">
    <div class="lenti">

    <?php
        $szolgaltatasok = $dbhandler->select("SELECT szolgaltatasok.* FROM szolgaltatasok INNER JOIN helyszin ON helyszin.nev = szolgaltatasok.nev WHERE szolgaltatasok.nev = '$hotel_nev'");
        array_shift($szolgaltatasok[0]);
        //ikonok img/icons/ugyanaz a nevük mint az adatbázisban
        $szolgaltatasok_str = "";
        $szoveg = array('sajat_furdo' => "Saját fürdő", 'terasz' => "Terasz", 'franciaagy' => "Franciaágy", 'gyerekbarat' => "Gyerekbarát", 'ac' => "Légkondícionált", 'konyha' => "Konyha", 'parkolas' => "Parkolás", 'tv' => "TV", 'gym' => "Gym", 'medence' => "Medence", 'bar' => "Bár", 'internet' => "Internet", 'szef' => "Széf", 'akadalymentes' => "Akadálymentes");
        foreach ($szolgaltatasok[0] as $key => $szolg)
        {
            if ($szolgaltatasok[0]["$key"] == 1)
            {
                $szolgaltatasok_str .= "<p class='szolgaltatassor'><img src='../img/icons/$key.png' alt='Ikon' class='ikon'>".$szoveg["$key"]."</p>";
            }
        }
        echo "  <div class='szolgaltatasok'>
                <p class='szolgaltatasokcim'>Elérhető szolgáltatások:</p>
                <hr class='szolgaltatasokvonal'>
                $szolgaltatasok_str
                </div>";
    ?>
    

    <div class="foglalas">
        <form action="foglalas.php" method="get">
            <div class="ellatas">
                <label for="ellatas">Ellátás: </label>
            <select id="ellatas" name="ellatas" onchange="Dropdown()">
                <option value="Csak Szállás">Csak Szállás</option>
                <option value="All inclusive">All inclusive</option>
                <option value="Félpanzió">Félpanzió</option>
                <option value="Teljes panzió">Teljes panzió</option>
                <option value="Szállás és Reggeli">Szállás és Reggeli</option>

            </select>
        </div>
        <div class="etkezesek">
            <div>
            <span>Étkezések:</span>
            </div>
            <div>
                <span id="ki">Nincs</span>
            </div>
        </div>
        <div class="utazok_szama">
                <p class ="kicsi">Utazók száma: </p><br>
                <b><input class="nagy" name="utasok_szama" type="number" value="1" min="1"></b>
                
        </div>
        <div class="ar">
        <?php $ar = $dbhandler->getKeresett('csomagok', 'ar', 'csomagid', $csomagid)[0];?>
    <!-- Hidden input field to store the original price -->
    <?php echo "<input type='hidden' id='originalPrice' value='$ar'>"?>
    <!-- Displayed price -->
    <p><span id="displayedPrice"><?php echo $ar?></span> Ft/fő</p>
        </div>
        <?php
        //?csomag=true&helyszin=Bondi+Beach+House&csomagid=3
        echo "  <input type='hidden' name='csomag' id='csomag' value='true'>
                <input type='hidden' name='helyszin' id='helyszin' value='$hotel_nev'>
                <input type='hidden' name='csomagid' id='csomagid' value='".$csomagid."'>
                <input class='submit tobb' type='submit' value='Foglalás'>";
        ?>
        
        </form>
    </div>
    </div>
</div>
</div>
