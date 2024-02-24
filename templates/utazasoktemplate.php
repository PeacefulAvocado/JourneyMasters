<?php
    require_once(__DIR__.'/../helpers/dbhandler.php');
    $dbhandler = new DbHandler();
   
?>
<script src='https://kit.fontawesome.com/7ad21db75c.js' crossorigin='anonymous'></script>

<link rel='preconnect' href='https://fonts.googleapis.com'>
<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
<link href='https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap' rel='stylesheet'>

<div class='utazasokmain'>
<div class='utazasok' id="utazasok">
 <h1 class='utazasokfocim'>Utazások</h1>
 <hr id='utazasokvonal'>

 <?php
    //$len = $dbhandler->getTableCount('csomagok')[0];
    $csomagok = $dbhandler->getCsomagok(0);
    $j = 1;
    for ($i=0; $i < 3; $i++)
    {   
        $hotel_nev = $csomagok[$i]['celpont'];
        $kep = "../img/helyszinimg/$hotel_nev/1.jpg";

        if ($j % 3 == 0)
        {
            $szin = 'a3';
            $j = 1;
        }
        else if ($j % 2 == 0) 
        {
            $szin = 'a2';
            $j++;
        }
        else{
            $szin = 'a1';
            $j++;
        }

        $varos = $dbhandler->getKeresett('helyszin', 'varos', 'nev', $hotel_nev)[0];
        
        $stars = $dbhandler->getKeresett('helyszin', 'csillag', 'nev', $hotel_nev)[0];
        $stars_str = "";
        for ($n = 0; $n < $stars; $n++) { 
            $stars_str .= "<i class='fa-solid fa-star'></i>";
        }

        $leiras = $dbhandler->getKeresett('helyszin', 'leiras', 'nev', $hotel_nev)[0];
        
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

        $honnan = $csomagok[$i]['honnan'];
        echo "<div class='utazaskontener'>
        <img src='$kep' alt='$varos' >
        <div class='utazasokdetails' id='$szin'>
        <div class='utazasokajanlattext'>
            <p class='utazasokajanlatfocim'>$varos</p>
            <p class='utazasokajalnathotelnev'>$hotel_nev
            <p class='stars'>$stars_str</p>
    
    
                    <p class='utazasokajalnatszoveg'>$leiras</p>
                    
                    
                    <p class='utazasokajalnatrepter'>$honnan <i class='fa-solid fa-$utazasmod' style='color:black'></i> $varos</p>
                    <p class='utazasokajalnatdatum'>".$csomagok[$i]['mettol']."  — ".$csomagok[$i]['meddig']."</p>
                    <p class='utazasokajalnatar'>".$csomagok[$i]['ar']." Ft/fő -től</p>
                    <form action='reszletek.php' method='get'>
                        <input type='hidden' name='csomag' id='csomag' value='true'>
                        <input type='hidden' name='helyszin' id='helyszin' value='$hotel_nev'>
                        <input type='hidden' name='csomagid' id='csomagid' value='".$csomagok[$i]['csomagid']."'>
                        <input type='submit' value='Megnézem' class='utazasokmegnezem'>
                    </form>
                </div>
        </div>
    </div>
    ";
    }

    
 
 ?>




</div>
<button class='tobb' id="loadMoreBtn">Több<br>betöltése</button>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../js/load-more.js"></script>



