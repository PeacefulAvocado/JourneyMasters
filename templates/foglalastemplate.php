<?php
    require_once(__DIR__."/../helpers/dbhandler.php");
    $dbhandler = new DbHandler();
    //Ha hiba van a kódban rossz paraméterek miatt, a 404-es oldalra dob
    function error_found(){
        header("Location: ../index/404.php");
      }
    set_error_handler('error_found');

    $csomag = $_GET['csomag'];
    $hotel_nev = $_GET['helyszin'];
    $ellatas = $_GET['ellatas'];
    $utasok_szama = $_GET['utasok_szama'];
    //Elindítja a SESSION-t ha eddig nem futott
    if(!isset($_SESSION)){
    session_start();
    }
    //Ha nem volt még létrehozva a $_SESSION['kosar_items'], létrehozza
    if(!isset($_SESSION['kosar_items'])){
        $_SESSION['kosar_items'] = array();
    }
    //Ha a kosárból térünk vissza, nem adja újra hozzá az elemet a kosárhoz
    if(isset($_GET['toremove'])){
        $delete = explode('_',$_GET['toremove']);
        $melyik = intval(trim($delete[1]));
        $tomb = $_SESSION['kosar_items'];
        unset($tomb[$melyik]);
        $_SESSION['kosar_items'] = array_values($tomb);
    }
    //Az ellátás függvényéban kiválasztja a szorzót, amely a végösszeghez kell
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
    //Belerakja a kosárba az utazást az alapján, hogy benne van-e már
    if ($csomag == "true")
        {
            $csomagid = $_GET['csomagid'];
            $honnan = $dbhandler->getKeresett('csomagok', 'honnan', 'csomagid', $csomagid)[0];
            if(!isset($_GET['toremove'])){
                $igaze = true;
                $i = 0;
                $csomagcounter = 0;
                $csomagvoltecounter = 0;
                //Megnézi, hogy az adott elem benne van-e a kosárban
                foreach($_SESSION['kosar_items'] as $item){
                    if($item['csomage'] == "true"){
                        $csomagcounter++;
                        if(!($item['csomagid'] == $csomagid && $item['ellatas'] == $ellatas && $item['utasok_szama'] == $utasok_szama)){
                            $csomagvoltecounter++;
                        }
                    }
     
                }
                //Ha nincs benne, belerakja
                if(count($_SESSION['kosar_items']) == 0){
                    if(($csomagcounter == $csomagvoltecounter)){
                        $_SESSION['kosar_items'][] = array('csomage'=> $csomag, 'csomagid' => $csomagid,'ellatas'=>$ellatas,'utasok_szama'=>$utasok_szama);
                    }
                }
                else if(count($_SESSION['kosar_items']) != 0){
                    if(($csomagcounter == $csomagvoltecounter)){
                        $_SESSION['kosar_items'][] = array('csomage'=> $csomag, 'csomagid' => $csomagid,'ellatas'=>$ellatas,'utasok_szama'=>$utasok_szama);
                    }
                }
               
            }
            else if(isset($_GET['toremove'])){
                $_SESSION['kosar_items'][] = array('csomage'=> $csomag, 'csomagid' => $csomagid,'ellatas'=>$ellatas,'utasok_szama'=>$utasok_szama);
            }
           
     
        }
        else {
            $honnan = $_GET['honnan'];
            $mettol = $_GET['mettol'];
            $meddig = $_GET['meddig'];
            if(!isset($_GET['toremove'])){
                $egyenicounter = 0;
                $egyenivoltecounter = 0;
                //Megnézi, hogy az adott elem benne van-e a kosárban
                foreach($_SESSION['kosar_items'] as $item){
                    if($item['csomage'] == "false"){
                        $egyenicounter++;
                        if(!($item['honnan'] == $honnan && $item['hotel_nev'] == $hotel_nev && $item['ellatas'] == $ellatas && $item['utasok_szama'] == $utasok_szama && $item['mettol'] == $mettol && $item['meddig'] == $meddig)){
                            $egyenivoltecounter++;
                        }
                    }
     
                }
                //Ha nincs benne, belerakja
                if(count($_SESSION['kosar_items']) == 0){
                    if(($egyenicounter == $egyenivoltecounter)){
                        $_SESSION['kosar_items'][]= array('csomage'=>$csomag,'honnan'=>$honnan,'hotel_nev'=>$hotel_nev,'ellatas'=>$ellatas,'utasok_szama'=>$utasok_szama,'mettol'=>$mettol,'meddig'=>$meddig);
                    }
                }
                else if(count($_SESSION['kosar_items']) != 0){
                    if(($egyenicounter == $egyenivoltecounter)){
                        $_SESSION['kosar_items'][]= array('csomage'=>$csomag,'honnan'=>$honnan,'hotel_nev'=>$hotel_nev,'ellatas'=>$ellatas,'utasok_szama'=>$utasok_szama,'mettol'=>$mettol,'meddig'=>$meddig);
                    }
                }
            }
            else if(isset($_GET['toremove'])){
                $_SESSION['kosar_items'][]= array('csomage'=>$csomag,'honnan'=>$honnan,'hotel_nev'=>$hotel_nev,'ellatas'=>$ellatas,'utasok_szama'=>$utasok_szama,'mettol'=>$mettol,'meddig'=>$meddig);
            }
        }  
        $varos = $dbhandler->getKeresett('helyszin', 'varos', 'nev', "'$hotel_nev'")[0];
    ?>
    <script src="../js/tavolsagCalc.js"></script>
    <script>
        //A tavolsagCalc segítségével kiszámolja a távot és ez alapján az árat az indulási hely és a célpont között
    const tavolsagCalc = new TavolsagCalc();
    window.onload = function() {
        let dist = tavolsagCalc.calcDistance('<?php echo $honnan; ?>', '<?php echo $varos; ?>');
        dist.then((result) => {
        document.getElementById('utazas_ar').innerHTML = Math.ceil(result);
        Icon();
        })
    };

</script> 
<script src="https://kit.fontawesome.com/7ad21db75c.js" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

<div class="foglalas">
    <h1>Foglalásom részletei</h1>
    <div class="grid">

        <div class="kepes">
            <?php if ($csomag == "true") { ?>
                <a href='../index/reszletek.php?csomag=<?= $csomag ?>&helyszin=<?= $hotel_nev ?>&csomagid=<?= $csomagid ?>' target='_blank'>
            <?php } ?>
            <img class='kep' src='../img/helyszinimg/<?= $hotel_nev ?>/1.jpg'>
            <div class="adatok">
                <?php
                //Kiírja a foglalás részleteit
                $varos = $dbhandler->getKeresett('helyszin', 'varos', 'nev', "'$hotel_nev'")[0];
                $cim = $dbhandler->getKeresett('helyszin', 'cim', 'nev', "'$hotel_nev'")[0];
                $stars = $dbhandler->getKeresett('helyszin', 'csillag', 'nev', "'$hotel_nev'")[0];
                $ar = $dbhandler->getKeresett('helyszin', 'ar', 'nev', "'$hotel_nev'")[0];

                if($csomag=="false"){
                    //Kiszámolja a végösszeget a napok és utasok száma és az ellátás segítségével 
                    $from = DateTime::createFromFormat('m-d-Y', $mettol);
                    $to = DateTime::createFromFormat('m-d-Y', $meddig);
                    $days = $to->diff($from)->d;
                    $total = $days * $utasok_szama * $ar + $utasok_szama * ($ar * $szorzo);
                }
                //A csillagok száma alapján készít egy stringet annyi csillagból
                $stars_str = "";
                for ($n = 0; $n < $stars; $n++) {
                    $stars_str .= "<i class='fa-solid fa-star'></i>";
                }
                ?>
                <p class='hotelnev'><?= $hotel_nev ?> <span class='stars'><?= $stars_str ?></span></p>
                <p class='cim'><?= $varos ?>, <?= $cim ?></p>
                <?php if ($csomag == "true") {
                    $ar = $dbhandler->getKeresett('csomagok', 'ar', 'csomagid', $csomagid)[0];
                    $mettol = $dbhandler->getKeresett('csomagok', 'mettol', 'csomagid', $csomagid)[0];
                    $meddig = $dbhandler->getKeresett('csomagok', 'meddig', 'csomagid', $csomagid)[0];
                    $honnan = $dbhandler->getKeresett('csomagok', 'honnan', 'csomagid', $csomagid)[0];
                    

                    $from = DateTime::createFromFormat('Y-m-d', $mettol);
                    $to = DateTime::createFromFormat('Y-m-d', $meddig);

                    $days = $to->diff($from)->d;

                    
                } ?>
            </div>
            </a>
        </div>
        <div class="reszletek">
            <div class="ellatas">
                <p class="e1">Ellátás: </p>
                <p class='e2'><?= $ellatas ?></p>
            </div>
            <div class='etkezesek'>
                <p class="et1">Étkezések:</p>
                <p class="et2"><?= $etkezesek ?></p>
            </div>
            <div class="utazok_szama">
                <p class="kicsi">Utazók száma: </p><br>
                <b><p class='nagy'><?= $utasok_szama ?> fő</p></b>
            </div>
            <div class="utazas">
                <select name='utazas' id='utazas' onchange='Icon()'>
                    <option value='Repülő'>Repülő</option>
                    <option value='Vonat'>Vonat</option>
                    <option value='Busz'>Busz</option>
                    <option value='Egyéni'>Egyéni</option>
                </select>
                <p class='ut'><b><?= $honnan ?> <span id='icon'><i class='fa-solid fa-plane'></i></span> <?= $varos ?></b></p>
            </div>
            <p class='idopont'><?= $mettol ?> — <?= $meddig ?></p>
            <div class="ar">
                <div class="reszek">
                    <p class="sz1">Szállás</p>
                    <p class='sz2'><?= $days ?> x <?= $utasok_szama ?> x <?= $ar ?> HUF</p>
                    <p class="sz1">Ellátás</p>
                    <p class='sz2'><?= $utasok_szama ?> x <?= $ar * $szorzo ?> HUF</p>
                    <p class="sz1">Utazás</p>
                    <p class='sz2'><?= $utasok_szama ?> x <span id="utazas_ar"></span> HUF</p>
                </div>
                <p class='osszeg' ><span id="osszeg"><?= $days * $utasok_szama * $ar + $utasok_szama * ($ar * $szorzo) ?></span> HUF</p>
            </div>
        </div>
    </div>
    <div class="utasadatok">
        <h3>Utasok adatai: </h3>

        <form action='../index/veglegesites.php' method='post' id="tovabb_form">
        <?php
        //Beírja az utas születési adatait, ha be van jelentkezve
            if (isset($_SESSION['utasid']))
            {
                $utas = $dbhandler->select("select * from utasok where utasazon = ".$_SESSION['utasid'])[0];
                if (!isset($utas['szulho'][1]))
                {
                    $utas['szulho'] = "0".$utas['szulho'];
                }
                if (!isset($utas['szulnap'][1]))
                {
                    $utas['szulnap'] = "0".$utas['szulnap'];
                }
                $date = $utas['szulev']."-".$utas['szulho']."-".$utas['szulnap'];
        ?>
        <div class='utas'>
                    <p class='utasszam'>1. utas</p>
                    <hr class='vonal'>
                    <div class='utasdata'>
                        <!--A bejelentkezett utas összes adatát beírja-->
                        <label>Név:</label>
                        <input type='text' name='nev_0' value='<?= $utas['nev'] ?>' readonly>
                        <label>Telefonszám:</label>
                        <input type='tel' name='tel_0' value='<?= $utas['tel'] ?>' readonly>
                        <label>Email-cím:</label>
                        <input type='email' name='email_0' value='<?= $utas['email'] ?>' readonly>
                        <label>Születési idő:</label>
                        <input type='date' name='szulid_0' value='<?= $date ?>' readonly min='1800-01-01'>
                        <label>Neme:</label>
                        <select name='nem_0' readonly>
                            <option value='<?= $utas['nem'] ?>'><?= $utas['nem'] ?></option>
                        </select>
                        <label>Ország:</label>
                        <input type='text' name='orszag_0' value='<?= $utas['orszag'] ?>' readonly>
                        <label>Irányítószám:</label>
                        <input type='text' name='irszam_0' value='<?= $utas['irszam'] ?>' readonly>
                        <label>Település:</label>
                        <input type='text' name='varos_0' value='<?= $utas['varos'] ?>' readonly>
                        <label>Lakcím:</label>
                        <input type='text' name='lakcim_0' value='<?= $utas['utca'] ?>' readonly>
                        <label>Igazolványtípus:</label>
                        <select name='igtipus_0' id='igtipus' readonly>
                            <option value='<?= $utas['igtipus'] ?>'><?= $utas['igtipus'] ?></option>
                        </select>
                        <label>Igazolványszám:</label>
                        <input type='text' name='igszam_0' value='<?= $utas['igszam'] ?>' readonly>
                    </div>
                </div>
            <?php
            }
            //Ha nincs bejelentkezve, a felhasználónak kell kitöltenie
            else {
            ?>
            <div class='utas'>
                    <p class='utasszam'>1. utas</p>
                    <hr class='vonal'>
                    <div class='utasdata'>
                        <label>Név:</label>
                        <input type='text' name='nev_0'>
                        <label>Telefonszám:</label>
                        <input type='tel' name='tel_0'>
                        <label>Email-cím:</label>
                        <input type='email' name='email_0'>
                        <label>Születési idő:</label>
                        <input type='date' name='szulid_0' min='1800-01-01'>
                        <label>Neme:</label>
                        <select name='nem_0' >
                            <option value='Férfi'>Férfi</option>
                            <option value='Nő'>Nő</option>
                            <option value='Egyéb'>Egyéb</option>
                        </select>
                        <label>Ország:</label>
                        <input type='text' name='orszag_0'>
                        <label>Irányítószám:</label>
                        <input type='text' name='irszam_0'>
                        <label>Település:</label>
                        <input type='text' name='varos_0'>
                        <label>Lakcím:</label>
                        <input type='text' name='lakcim_0'>
                        <label>Igazolványtípus:</label>
                        <select name='igtipus_0' id='igtipus' >
                            <option value='Személyi igazolvány'>Személyi igazolvány</option>
                            <option value='Útlevél'>Útlevél</option>
                        </select>
                        <label>Igazolványszám:</label>
                        <input type='text' name='igszam_0'>
                    </div>
                </div>
            <?php
            }
            for ($i = 1; $i < $utasok_szama; $i++) {
                $index = $i + 1;
            ?>
                <div class='utas'>
                    <p class='utasszam'><?= $index ?>. utas</p>
                    <hr class='vonal'>
                    <div class='utasdata'>
                        <label>Név:</label>
                        <input type='text' name='nev_<?= $i ?>'>
                        <label>Telefonszám:</label>
                        <input type='tel' name='tel_<?= $i ?>'>
                        <label>Email-cím:</label>
                        <input type='email' name='email_<?= $i ?>'>
                        <label>Születési idő:</label>
                        <input type='date' name='szulid_<?= $i ?>' min='1800-01-01'>
                        <label>Neme:</label>
                        <select name='nem_<?= $i ?>'>
                            <option value='Férfi'>Férfi</option>
                            <option value='Nő'>Nő</option>
                            <option value='Egyéb'>Egyéb</option>
                        </select>
                        <label>Ország:</label>
                        <input type='text' name='orszag_<?= $i ?>'>
                        <label>Irányítószám:</label>
                        <input type='text' name='irszam_<?= $i ?>'>
                        <label>Település:</label>
                        <input type='text' name='varos_<?= $i ?>'>
                        <label>Lakcím:</label>
                        <input type='text' name='lakcim_<?= $i ?>'>
                        <label>Igazolványtípus:</label>
                        <select name='igtipus_<?= $i ?>' id='igtipus'>
                            <option value='Személyi igazolvány'>Személyi igazolvány</option>
                            <option value='Útlevél'>Útlevél</option>
                        </select>
                        <label>Igazolványszám:</label>
                        <input type='text' name='igszam_<?= $i ?>'>
                    </div>
                </div>
            <?php
            }

            $ellatasar =  ($ar * $szorzo);
            if ($csomag == "true")
            {
                echo "<input type='hidden' name='csomagid' value='$csomagid'>";
            }
            ?>
            <input type="hidden" name="helyszin" value="<?= $hotel_nev ?>">
            <input type="hidden" name="utasok_szama" value="<?= $utasok_szama ?>">
            <input type="hidden" name="ellatas" value="<?= $ellatas ?>">
            <input type="hidden" name="utazasmod" value="" id="send_utazasmod">
            <input type="hidden" name="honnan" value="<?= $honnan ?>">
            <input type="hidden" name="hova" value="<?= $varos ?>">
            <input type="hidden" name="mettol" value="<?= $mettol ?>">
            <input type="hidden" name="meddig" value="<?= $meddig ?>">
            <input type="hidden" name="ar" value="" id="total">
            <input type="hidden" name="szallas" value="<?= $ar ?>">
            <input type="hidden" name="utazas" value="" id="ar">
            <input type="hidden" name="ellatas_ar" value="<?= $ellatasar ?>">
            <input type="hidden" name="csomag" value="<?= $csomag ?>">
            <input type="hidden" name="days" value="<?= $days ?>">
            <!--Az értesítési adatokat csak 1-szer kell megadni-->
            <div class="allando">
                <p class="utasszam">Állandó adatok</p>
                <hr class="vonal">
                <div class="allandodata">
                <label>Értesítési tel. szám:</label>
                <input type="tel" name="erttel" id="erttel">
                <label>Értesítési email-cím:</label>
                <input type="email" name="ertemail" id="ertemail">
                <label>Biztosító neve:</label>
                <input type="text" name="biztnev" id="biztnev" value="JourneyMasters">
                <label>Fizetési mód:</label>
                <select name="fizmod" id="fizmod">
                    <option value="payPal">PayPal</option>
                    <option value="Banki átutalás">Banki átutalás</option>
                    <option value="Hitelkártya">Hitelkártya</option>
                </select>
                </div>
            </div>
            <!--Megnézi, hogy minden adat ki van-e töltve, ha igen, elküldi a formot-->
            <input type='button' value='Tovább a fizetéshez' class='fizetes' onclick='send_foglalas(<?= $utasok_szama ?>)'>
        </form>

    </div>
</div>
<script src="../js/bekuld.js"></script>


