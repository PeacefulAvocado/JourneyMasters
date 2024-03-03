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
             <div class="utas">
                <p class="utasszam">1. utas</p>
                <hr class="utasvonal">
                <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                    <div class="utasdata">
                        <label>Név:</label>
                        <input type="text" name="nev" readonly value="Jóski Pista">
                        <label>Telefonszám:</label>
                        <input type="tel" name="tel"  readonly value="06301234567">
                        <label>Szuletési idő:</label>
                        <input type="date" name="szulid" readonly value="2009-10-09">
                        <label>Irányítószám:</label>
                        <input type="text" name="iranyioszam" readonly value="2600">
                        <label>Település:</label>
                        <input type="text" name="telepules"  readonly value="Vác">
                        <label>Lakcím:</label>
                        <input type="text" name="lakcim"  readonly value="Majom utca 68">
                        <label >Igazolvány típusa:</label>
                        <input type="text" name="igtipus" value="Személyi igazolvány">
                        <label>Igazolványszám:</label>
                        <input type="text" name="igszam" value="561783FE">
                    </div>
                </form>
             </div>   
           
    </div>

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
