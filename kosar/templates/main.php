<?php
    require_once(__DIR__."/../helpers/dbhandler.php");
    $dbhandler = new DbHandler();
   
?>
<script src="https://kit.fontawesome.com/7ad21db75c.js" crossorigin="anonymous"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

<div class="main">
<div class="valaszto">
    <p class="utazna">Utazna?</p>
    <form action="../tervezes/tervezes.php" method="get" class="tervezesform">
        <label for="indulas" class="indulaslabel">Indulás</label>
        <input type="text" name="indulas" id="indulas" class="helyinput">
        <label for="celpont" class="celpontlabel">Célpont</label>
        <input type="text" id="searchInput" name="celpont" id="celpont" class="helyinput">
        <input type="submit" value="" class="newbutton button">
        <div id="searchResults"></div>
    </form>
</div>
<div class="ajanlatok">
    <div class="ajanlatokkozep">
        <h1 class="kiemelt">Kiemelt ajánlataink</h1>
        <div class="slideshow-container">
            <?php
                $csomagok =  $dbhandler->getMindenAdat('csomagok', 3);
                $len = 3;
                $helyszinindex = null;
                
                for($i = 0;$i < $len;$i++) {
                    $celpont = $csomagok[$i]['celpont'];
                    $helyszin = $dbhandler->getKeresett('helyszin', 'leiras', 'nev', "'$celpont'");
                
                    $j = 0;
                    $handle = "";
                    while (($helyszin[0][$j] != '!') && ($helyszin[0][$j] != '.') && ($helyszin[0][$j] != '?'))
                    {
                        $handle .= $helyszin[0][$j];
                        $j++;
                    }
                    
                    $stars = $dbhandler->getKeresett('helyszin', 'csillag', 'nev', "'$celpont'")[0];

                    if ($csomagok[$i]['utazasmod'] == 'Repülő') 
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
                    
                    $varos = $dbhandler->getKeresett('helyszin', 'varos', 'nev', "'$celpont'")[0];
                    echo "<label for='submit_$i' class='slide-label'>
                    <div class='mySlides fade'>
                        <div class='numbertext'>" . ($i + 1) . " / $len</div>
                        <img src='../img/helyszinimg/" . $csomagok[$i]['celpont'] . "/1.jpg' class='sliderimg'>
                        <div class='text'>
                            <p class='sliderfocim'>" . $handle . "</p>
                            <p class='sliderhotelnev'>" . $csomagok[$i]['celpont'] . "</p>
                            <p class='stars'>";
                            for ($n = 0; $n < $stars; $n++) { 
                                echo "<i class='fa-solid fa-star'></i>";
                            }
            echo            "</p>
                            <p class='sliderrepter'>".$csomagok[$i]['honnan']." <i class='fa-solid fa-$utazasmod'></i> ".$varos."</p>
                            <p class='sliderdatum'>".$csomagok[$i]['mettol']."  — ".$csomagok[$i]['meddig']."</p>
                            <p class='sliderar'>".$csomagok[$i]['ar']." Ft / fő -től</p>
                        </div>
                    </div>
                </label>
                <form action='reszletek.php' method='get'>
                    <input type='hidden' name='csomag' id='csomag' value='true'>
                    <input type='hidden' name='helyszin' id='helyszin' value='".$csomagok[$i]['celpont']."'>
                    <input type='hidden' name='csomagid' id='csomagid' value='".$csomagok[$i]['csomagid']."'>
                    <input type='submit' value='' id='submit_$i' class='submit-button' style='display:none;'>
                </form>";

                }
            ?>
            <a class="prev" onclick="plusSlides(-1)">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>

        </div>
        <br>

        <div class="dotcontainer" >
            <?php
            for($i = 0;$i < $len;$i++) {
                echo '<span class="dot" onclick="currentSlide('.($i+1).')"></span>';
            }
            ?>
        </div>
        </div>
        
</div>
<div class="promo">
<div class="szovegek">
        <div class="kisszoveg vonal">
            <p class="kisszovegcim">Széles választék, végtelen kalandok</p>
            <p class="kisszoveghosszan">Nyissd fel a végtelen lehetőségek világát utazási 
                ügynökségünk hihetetlen utazásainak számtalan célállomásával! 🗺️ 
                Legyen szó a Bali napsütötte strandjairól, Róma történelmi 
                bájáról vagy Japán exotikus vonzásáról, mi gondoskodunk róla, 
                hogy megtaláld az álomnyaralást. Széles választékunkkal a 
                tökéletes nyaralás csak egy foglalást jelent tőled. Ne elégedj 
                meg az átlagossal, válassz kiemelkedőt velünk!</p>
        </div>
        <div class="kisszoveg vonal">
            <p class="kisszovegcim">Minőség és egyediség megtestesülése</p>
            <p class="kisszoveghosszan">Indulj elfelejthetetlen utazásokra premier utazási ügynökségünkkel! 
                🌍 Tapasztald meg a minőség csúcsát, miközben szakértő csapatunk 
                személyre szabott kalandokat készít számodra. Luxus utazásoktól 
                kezdve izgalmas expedíciókig minden pillanatot úgy tervezünk, hogy 
                az elvárásaidat felülmúlja. Fedezd fel a világot velünk!</p>
        </div>
        <div class="kisszoveg">
            <p class="kisszovegcim">Kiemelkedő élmények megfizethető áron</p>
            <p class="kisszoveghosszan">Engedd meg magadnak az ultimát utazási élményt anélkül, hogy 
                mélyen a zsebedbe kellene nyúlnod! 💼 Utazási irodánk verhetetlen 
                áron kínál minőséget anélkül, hogy kompromisszumot kellene kötnöd. 
                Búcsúzz el a költségvetési korlátoktól, és köszönj üdvözletet az 
                elérhetetlen kalandoknak. Kizárólagos ajánlatainkkal és kedvezményeinkkel 
                álmaid vakációja most még megfizethetőbb, mint valaha. Utazz okosan, utazz velünk!</p>
        </div>
</div>
<div class="stats">
    <div class="statbal">
        <p class="nagyp">Már</p>
        <p class="ugyfelcount"><?php echo $dbhandler->getTableCount('utasok')[0];?></p>
        <p class="nagyp">Ügyfél választott minket!</p>
        <p class="kisp">Legyen ön a következő</p>
    </div>
    <div class="statjobb">
    <p class="nagyp">Összesen</p>
        <p class="ugyfelcount"><?php echo $dbhandler->getTableCount('helyszin')[0];?></p>
        <p class="nagyp">Úticél</p>
        <p class="kisp">És Ön hova utazik?</p>

    </div>
    </div>

    
</div>
