<?php
    require_once(__DIR__.'/../helpers/dbhandler.php');
    $dbhandler = new DbHandler();

// Assuming $dbhandler is your database handler

$offset = $_POST['offset']; // Offset for fetching records

$csomagok = $dbhandler->getCsomagok($offset);
 $j = 1;

 $len = count($csomagok);
 

 
for ($i=0; $i < $len; $i++)
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

        $varos = $dbhandler->getKeresett('helyszin', 'varos', 'nev', "'$hotel_nev'")[0];
        
        $stars = $dbhandler->getKeresett('helyszin', 'csillag', 'nev', "'$hotel_nev'")[0];
        $stars_str = "";
        for ($n = 0; $n < $stars; $n++) { 
            $stars_str .= "<i class='fa-solid fa-star'></i>";
        }

        $leiras = $dbhandler->getKeresett('helyszin', 'leiras', 'nev', "'$hotel_nev'")[0];
        
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

    $csomagok = $dbhandler->getCsomagok($offset+$len);


    $len = count($csomagok);

    if ($len == 0) {
        echo "<style>
            #loadMoreBtn {
            display: none;
            }
    
            #end_of_page {
            display: table !important;
            color: black;
            margin-left: auto;
            margin-right: auto;
            }
    
        </style>"; 
     }
?>
