<?php
    require_once(__DIR__."/../helpers/dbhandler.php");
    $dbhandler = new DbHandler();
    $csomag = $_GET['csomag'];
    $hotel_nev = $_GET['helyszin'];
    $ellatas = $_GET['ellatas'];
    $utasok_szama = $_GET['utasok_szama'];

    session_start();
    if(!isset($_SESSION['kosar_items'])){
        $_SESSION['kosar_items'] = array();
    }
    if(isset($_GET['toremove'])){
        $delete = explode('_',$_GET['toremove']);
        $melyik = intval(trim($delete[1]));
        $tomb = $_SESSION['kosar_items'];
        unset($tomb[$melyik]);
        $_SESSION['kosar_items'] = array_values($tomb);
    }
    

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
   if ($csomag == "true")
    {
        $csomagid = $_GET['csomagid'];
        $_SESSION['kosar_items'][] = array('csomage'=> $csomag, 'csomagid' => $csomagid,'ellatas'=>$ellatas,'utasok_szama'=>$utasok_szama);

    }
    else {
        $honnan = $_GET['honnan'];
        $mettol = $_GET['mettol'];
        $meddig = $_GET['meddig'];
        $_SESSION['kosar_items'][]= array('csomage'=>$csomag,'honnan'=>$honnan,'hotel_nev'=>$hotel_nev,'ellatas'=>$ellatas,'utasok_szama'=>$utasok_szama,'mettol'=>$mettol,'meddig'=>$meddig);
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
            <?php if ($csomag == "true") { ?>
                <a href='../index/reszletek.php?csomag=<?= $csomag ?>&helyszin=<?= $hotel_nev ?>&csomagid=<?= $csomagid ?>' target='_blank'>
            <?php } ?>
            <img class='kep' src='../img/helyszinimg/<?= $hotel_nev ?>/1.jpg'>
            <div class="adatok">
                <?php
                $varos = $dbhandler->getKeresett('helyszin', 'varos', 'nev', "'$hotel_nev'")[0];
                $cim = $dbhandler->getKeresett('helyszin', 'cim', 'nev', "'$hotel_nev'")[0];
                $stars = $dbhandler->getKeresett('helyszin', 'csillag', 'nev', "'$hotel_nev'")[0];
                $ar = $dbhandler->getKeresett('helyszin', 'ar', 'nev', "'$hotel_nev'")[0];


                $from = DateTime::createFromFormat('m-d-Y', $mettol);
                $to = DateTime::createFromFormat('m-d-Y', $meddig);

                $days = $to->diff($from)->d;
                $total = $days * $utasok_szama * $ar + $utasok_szama * ($ar * $szorzo);
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


                    $from = DateTime::createFromFormat('m-d-Y', $mettol);
                    $to = DateTime::createFromFormat('m-d-Y', $meddig);

                    $days = $to->diff($from)->d;

                    echo $days;

                    
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
                    <p class='sz2'><?= $utasok_szama ?> x valami HUF</p>
                </div>
                <p class='osszeg'><?= $days * $utasok_szama * $ar + $utasok_szama * ($ar * $szorzo) ?> HUF</p>
                <?php
                $total = $days * $utasok_szama * $ar + $utasok_szama * ($ar * $szorzo);
                ?>
            </div>
        </div>
    </div>
    <div class="utasadatok">
        <h3>Utasok adatai: </h3>

        <form action='../index/veglegesites.php' method='post' id="tovabb_form">
            <?php
            for ($i = 0; $i < $utasok_szama; $i++) {
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
                        <input type='date' name='szulid_<?= $i ?>'>
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
            $utazas = 0;
            $ellatasar =  ($ar * $szorzo);
            ?>
            <input type="hidden" name="helyszin" value="<?= $hotel_nev ?>">
            <input type="hidden" name="utasok_szama" value="<?= $utasok_szama ?>">
            <input type="hidden" name="ellatas" value="<?= $ellatas ?>">
            <input type="hidden" name="utazasmod" value="" id="send_utazasmod">
            <input type="hidden" name="honnan" value="<?= $honnan ?>">
            <input type="hidden" name="hova" value="<?= $varos ?>">
            <input type="hidden" name="mettol" value="<?= $mettol ?>">
            <input type="hidden" name="meddig" value="<?= $meddig ?>">
            <input type="hidden" name="ar" value="<?= $total ?>">
            <input type="hidden" name="szallas" value="<?= $ar ?>">
            <input type="hidden" name="utazas" value="<?= $utazas ?>">
            <input type="hidden" name="ellatas_ar" value="<?= $ellatasar ?>">
            <input type="hidden" name="days" value="<?= $days ?>">
            
            <div class="allando">
                <label>Értesítési telefonszám:</label>
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
            <input type='button' value='Tovább a fizetéshez' class='fizetes' onclick='send_foglalas(<?= $utasok_szama ?>)'>
        </form>

    </div>
</div>
<script src="../js/bekuld.js"></script>
