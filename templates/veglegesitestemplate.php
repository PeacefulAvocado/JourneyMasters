<?php
    require_once(__DIR__."/../helpers/dbhandler.php");
    $dbhandler = new DbHandler();
   
    $utasok_szama = $_POST['utasok_szama'];


    $hotel_nev = $_POST['helyszin'];
    $ellatas = $_POST['ellatas'];
    $utazasmod = $_POST['utazasmod'];
    $honnan = $_POST['honnan'];
    $varos = $_POST['hova'];
    $mettol = $_POST['mettol'];
    $meddig = $_POST['meddig'];
    $ar = $_POST['ar'];


    

?>


<div class="veglegesitesmain">
<div class="veglegesites">
    <h1 class="veglegesitesfocim">Foglalás véglegesítése</h1>
    <hr class="vonal">
    
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
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <?php 
        for($i = 0; $i<$utasok_szama; $i++) {
            $index = $i+1;
            $nev = $_POST["nev_$i"];
            $tel = $_POST["tel_$i"];
            $szulid = $_POST["szulid_$i"];
            $lakcim = $_POST["lakcim_$i"];
            $igtipus = $_POST["igtipus_$i"];
            $igszam = $_POST["igszam_$i"];

            echo "<div class='utas'>
            <p class='utasszam'>$index. utas</p>
            <hr class='utasvonal'>
                <div class='utasdata'>
                    <label>Név:</label>
                    <input type='text' name='nev' readonly value='$nev'>
                    <label>Telefonszám:</label>
                    <input type='tel' name='tel'  readonly value='$tel'>
                    <label>Szuletési idő:</label>
                    <input type='date' name='szulid' readonly value='$szulid'>
                    <label>Irányítószám:</label>
                    <input type='text' name='iranyioszam' readonly value='$lakcim'>
                    <label>Település:</label>
                    <input type='text' name='telepules'  readonly value='$lakcim'>
                    <label>Lakcím:</label>
                    <input type='text' name='lakcim'  readonly value='$lakcim'>
                    <label >Igazolvány típusa:</label>
                    <input type='text' name='igtipus' value='$igtipus'>
                    <label>Igazolványszám:</label>
                    <input type='text' name='igszam' value='$igszam'>
                </div>
            </div>   
            ";
        }
        ?>
             
                
            </div>
        </form>

    <div class="vegosszeg">
        <p class="vegebal">Szállás és utazás</p>
        <p class="vegejobb">2 x 93.100 HUF</p>
        <p class="vegebal vonallent">Ellátás</p>
        <p class="vegejobb vonallent">2 x 29.900 HUF</p>
        <p class="vegebal kover">Összesen:</p>
        <p class="vegejobb kover"><?php echo $ar;?> HUF</p>
    </div>

    <button class="fizetes">Fizetés</button>

    </div>



</div>

 
</div>
