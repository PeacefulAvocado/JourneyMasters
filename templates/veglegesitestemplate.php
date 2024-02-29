<?php
    require_once(__DIR__."/../helpers/dbhandler.php");
    $dbhandler = new DbHandler();
   
?>


<div class="veglegesitesmain">
<div class="veglegesites">
    <h1 class="veglegesitesfocim">Foglalás véglegesítése</h1>
    <hr class="vonal">
    
    <div class="vegadatok">
    <div class='container'>
                        
        <img src='../img/sydneyproba.jpg' class='sliderimg'>
        <div class='text'>
            <p class='sliderhotelnev'>Sydney Harbour Hotel</p>
            <p class='stars'><i class='fa-solid fa-star'></i></p>
            <p class="slidercim">Sydney, Australia 30 Grosvenor St.</p>
        </div>
    </div>

    <div class="osszesadat">
        <p class="balszoveg">Utazás időpontja:</p>
        <p class="jobbszoveg dolt">2024.05.06 — 2024.05.10</p>
        <p class="balszoveg">Ellátás:</p>
        <p class="jobbszoveg">All-inclusive</p>
        <p class="balszoveg">Indulás:</p>
        <p class="jobbszoveg kover">BUD</p>
        <p class="balszoveg">Érkezési hely:</p>
        <p class="jobbszoveg kover">SDY</p>
        <p class="balszoveg">Utazási mód:</p>
        <p class="jobbszoveg">Repülő</p>
        <p class="balszoveg">Utazók száma:</p>
        <p class="jobbszoveg">2 fő</p>
        
    </div>
    <div class="utasadatok">
        <h3>Utasok adatai: </h3>
             <div class="utas">
                <p class="utasszam">1. utas</p>
                <hr class="utasvonal">
                <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                    <div class="utasdata">
                        <label>Név:</label>
                        <input type="text" name="nev">
                        <label>Telefonszám:</label>
                        <input type="tel" name="tel">
                        <label>Szuletési idő:</label>
                        <input type="date" name="szulid">
                        <label>Lakcím:</label>
                        <input type="text" name="lakcim">
                        <label >Igazolványtípus:</label>
                        <select name="igtipus" id="igtipus">
                        <option value="Személyi igazolvány">Személyi igazolvány</option>
                        <option value="Útlevél">Útlevél</option>
                        </select>
                        <label>Igazolványszám:</label>
                        <input type="text" name="igszam">
                    </div>
                    <input type="submit" value="Tovább a <?php echo "\n";?>fizetéshez" class="fizetes">
                </form>
             </div>   
           
    </div>

    </div>



</div>

 
</div>
