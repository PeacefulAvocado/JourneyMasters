<?php
    require_once(__DIR__."/../helpers/dbhandler.php");
    $dbhandler = new DbHandler();
   
?>
<script src="https://kit.fontawesome.com/7ad21db75c.js" crossorigin="anonymous"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

<div class="utazasokmain">
<div class="utazasok">
 <h1 class="utazasokfocim">Utazások</h1>
 <hr id="utazasokvonal">
<div class="utazaskontener">
    <img src="../img/sydneyproba2.jpg" alt="Sydney" >
    <div class="utazasokdetails" id="a1">
    <div class="utazasokajanlattext">
        <p class="utazasokajanlatfocim">Sydney</p>
        <p class="utazasokajalnathotelnev">Ács Bence hotel<p class="stars"><i class="fa-solid fa-star"></i></p>


                <p class="utazasokajalnatszoveg">Ahol az elegancia és a kifinomultság találkozik a lenyűgöző kilátással a Sydney kikötőre! Fedezze fel velünk az exkluzív kényelem és a páratlan vendégszeretet harmonikus összhangját.</p>
                
                
                <p class="utazasokajalnatrepter">BUD <i class="fa-solid fa-plane" style="color:black"></i> CMN</p>
                <p class="utazasokajalnatdatum">02.020.02 - 020.020.02</p>
                <p class="utazasokajalnatar">158.000 Ft / fő -től</p>
                <form action="<?php //utazás foglalás php oldal linkje?>" method="get">
                    <input type="hidden" name="valami" id="valami" value="valami">
                    <input type="submit" value="Megnézem" class="utazasokmegnezem">
                </form>
            </div>
    </div>
</div>
<div class="utazaskontener">
    <img src="../img/sydneyproba2.jpg" alt="Sydney" >
    <div class="utazasokdetails" id="a1">
    <div class="utazasokajanlattext">
        <p class="utazasokajanlatfocim">Sydney</p>
        <p class="utazasokajalnathotelnev">Ács Bence hotel<p class="stars"><i class="fa-solid fa-star"></i></p>


                <p class="utazasokajalnatszoveg">Ahol az elegancia és a kifinomultság találkozik a lenyűgöző kilátással a Sydney kikötőre! Fedezze fel velünk az exkluzív kényelem és a páratlan vendégszeretet harmonikus összhangját.</p>
                
                
                <p class="utazasokajalnatrepter">BUD <i class="fa-solid fa-plane" style="color:black"></i> CMN</p>
                <p class="utazasokajalnatdatum">02.020.02 - 020.020.02</p>
                <p class="utazasokajalnatar">158.000 Ft / fő -től</p>
                <form action="<?php //utazás foglalás php oldal linkje?>" method="get">
                    <input type="hidden" name="valami" id="valami" value="valami">
                    <input type="submit" value="Megnézem" class="utazasokmegnezem">
                </form>
            </div>
    </div>
</div>
<button class="tobb">Több<br>betöltése</button>
</div>
</div>
