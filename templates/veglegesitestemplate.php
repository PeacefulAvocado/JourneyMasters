<?php
    require_once(__DIR__."/../helpers/dbhandler.php");
    $dbhandler = new DbHandler();
   
    $utasok_szama = $_POST['utasok_szama'];
    $csomag = $_POST['csomag'];


    $hotel_nev = $_POST['helyszin'];
    $ellatas = $_POST['ellatas'];
    $utazasmod = $_POST['utazasmod'];
    $honnan = $_POST['honnan'];
    $varos = $_POST['hova'];
    $mettol = $_POST['mettol'];
    $meddig = $_POST['meddig'];
    $ar = $_POST['ar'];

    $erttel = $_POST["erttel"];
    $ertemail = $_POST["ertemail"];
    $biztnev = $_POST["biztnev"];
    $fizmod = $_POST["fizmod"];


    $szallas = $_POST['szallas'];
    $days = $_POST['days'];
    $utazas = $_POST['utazas'];
    $ellatas_ar = $_POST['ellatas_ar'];


    

?>


<div class="veglegesitesmain">
    <div class="veglegesites">
        <h1 class="veglegesitesfocim">Foglalás véglegesítése</h1>
        <hr class="vonal">
        
        <form action="../helpers/fizetes.php" method="post">
    <div class="vegadatok">
        <div class='container'>
            <?php 
       
       $cim = $dbhandler->getKeresett('helyszin', 'cim', 'nev', "'$hotel_nev'")[0];
       $stars = $dbhandler->getKeresett('helyszin', 'csillag', 'nev', "'$hotel_nev'")[0];
       
       $stars_str = "";
       for ($n = 0; $n < $stars; $n++) { 
           $stars_str .= "<i class='fa-solid fa-star'></i>";
        }
        ?>
                        
        <img src='../img/helyszinimg/<?php echo $hotel_nev;?>/1.jpg' class='sliderimg'>
        <div class='text'>
            <p class='sliderhotelnev'><?php echo $hotel_nev;?></p>
            <p class='stars'><?php echo $stars_str;?></p>
            <p class="slidercim"><?php echo $varos.', '.$cim?></p>
        </div>
    </div>

    <div class="osszesadat">
        <p class="balszoveg">Utazás időpontja:</p>
        <p class="jobbszoveg dolt"><?php echo $mettol."—".$meddig;?></p>
        <p class="balszoveg">Ellátás:</p>
        <p class="jobbszoveg"><?php echo $ellatas;?></p>
        <p class="balszoveg">Indulás:</p>
        <p class="jobbszoveg kover"><?php echo $honnan;?></p>
        <p class="balszoveg">Érkezési hely:</p>
        <p class="jobbszoveg kover"><?php echo $varos;?></p>
        <p class="balszoveg">Utazási mód:</p>
        <p class="jobbszoveg"><?php echo $utazasmod;?></p>
        <p class="balszoveg">Utazók száma:</p>
        <p class="jobbszoveg"><?php echo $utasok_szama;?> fő</p>
        
    </div>
    <div class="utasadatok">
        <h3>Utasok adatai: </h3>
     
        <?php 
        for($i = 0; $i<$utasok_szama; $i++) {
            $index = $i+1;
            $nev = $_POST["nev_$i"];
            $tel = $_POST["tel_$i"];
            $email = $_POST["email_$i"];
            $szulid = $_POST["szulid_$i"];
            $nem = $_POST["nem_$i"];
            $orszag = $_POST["orszag_$i"];
            $irszam = $_POST["irszam_$i"];
            $varos = $_POST["varos_$i"];
            $lakcim = $_POST["lakcim_$i"];
            $igtipus = $_POST["igtipus_$i"];
            $igszam = $_POST["igszam_$i"];

            echo "<div class='utas'>
            <p class='utasszam'>$index. utas</p>
            <hr class='utasvonal'>
                <div class='utasdata'>
                    <label>Név:</label>
                    <input type='text' name='nev_$i' readonly value='$nev'>
                    <label>Telefonszám:</label>
                    <input type='tel' name='tel_$i'  readonly value='$tel'>
                    <label>Email-cím:</label>
                    <input type='email' name='email_$i'  readonly value='$email'>
                    <label>Szuletési idő:</label>
                    <input type='date' name='szulid_$i' readonly value='$szulid'>
                    <label>Nem:</label>
                    <input type='text' name='nem_$i' readonly value='$nem'>
                    <label>Ország:</label>
                    <input type='text' name='orszag_$i' readonly value='$orszag'>
                    <label>Irányítószám:</label>
                    <input type='text' name='iranyitoszam_$i' readonly value='$irszam'>
                    <label>Település:</label>
                    <input type='text' name='telepules_$i'  readonly value='$varos'>
                    <label>Lakcím:</label>
                    <input type='text' name='lakcim_$i'  readonly value='$lakcim'>
                    <label >Igazolvány típusa:</label>

                    <input type='text' name='igtipus_$i' readonly value='$igtipus'>
                    <label>Igazolványszám:</label>
                    <input type='text' name='igszam_$i' readonly value='$igszam'>

                </div>
            </div>   
            ";
        }
        ?>
             
                
            </div>
  
    <div class="vegosszeg">
        <p class="vegebal">Szállás</p>
        <p class="vegejobb"><?= $utasok_szama?> x <?= $days?> x <?= $szallas?> HUF</p>
        <p class="vegebal">Utazás</p>
        <p class="vegejobb"><?= $utasok_szama?> x <?= $utazas?> HUF</p>
        <p class="vegebal vonallent">Ellátás</p>
        <p class="vegejobb vonallent"><?= $utasok_szama?> x <?= $ellatas_ar?> HUF</p>
        <p class="vegebal kover">Összesen:</p>
        <p class="vegejobb kover"><?= $ar?> HUF</p>
    </div>
        <input type="hidden" name="helyszin" value="<?php echo $hotel_nev?>">
        <input type="hidden" name="utasok_szama" value="<?php echo $utasok_szama?>">
        <input type="hidden" name="csomag_e" value="<?php echo $csomag?>">
        <input type="hidden" name="ellatas" value="<?php echo $ellatas?>">
        <input type="hidden" name="utazasmod" value="<?php echo $utazasmod;?>" >
        <input type="hidden" name="honnan" value="<?php echo $honnan?>">
        <input type="hidden" name="hova" value="<?php echo $varos?>">
        <input type="hidden" name="mettol" value="<?php echo $mettol?>">
        <input type="hidden" name="meddig" value="<?php echo $meddig?>">
        <input type="hidden" name="ar" value="<?php echo $ar?>">
        <input type="hidden" name="days" value="<?php echo $days?>">
        <input type="hidden" name="szallas" value="<?php echo $szallas?>">
        <input type="hidden" name="utazas" value="<?php echo $utazas?>">
        <input type="hidden" name="ellatas_ar" value="<?php echo $ellatas_ar?>">
        <input type="hidden" name="erttel" value="<?php echo $erttel?>">
        <input type="hidden" name="ertemail" value="<?php echo $ertemail?>">
        <input type="hidden" name="biztnev" value="<?php echo $biztnev?>">
        <input type="hidden" name="fizmod" value="<?php echo $fizmod?>">
        <input type="submit" class="fizetes" value="Fizetes">
</form>

    </div>



</div>

 
</div>
