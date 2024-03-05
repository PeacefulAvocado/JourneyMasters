<?php
    require_once(__DIR__.'/../helpers/dbhandler.php');
    $dbhandler = new DbHandler();

    
    $utasok_szama = $_POST['utasok_szama'];
    $csomag_e = $_POST['csomag_e'];
    $csomagid = $_POST['csomagid']; 
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




    $csoportID = $dbhandler->select("SELECT COUNT(*) AS count FROM csoport")[0]['count']+1;
    $utazasazon = $dbhandler->select("select COUNT(*) as utazasazon from utazas ")[0]['utazasazon']+1;
    //Beleírja az utasok és az utazás adatait az adatbázisba
    for($i = 0; $i<$utasok_szama; $i++) {
        $index = $i+1;

        $nev = $_POST["nev_$i"];
        $tel = $_POST["tel_$i"];
        $email = $_POST["email_$i"];
        $szulid = $_POST["szulid_$i"];

        $szulido = explode('-', $szulid);
        $szulev = $szulido[0];
        $szulho = $szulido[1];
        $szulnap = $szulido[2];

        $today = new DateTime();
        $birthdate = new DateTime("$szulnap-$szulho-$szulev");
        $age = $today->diff($birthdate)->y;

        $nem = $_POST["nem_$i"];
        $orszag = $_POST["orszag_$i"];
        $iranyitoszam = $_POST["iranyitoszam_$i"];
        $telepules = $_POST["telepules_$i"];
        $lakcim = $_POST["lakcim_$i"];

        $igtipus = $_POST["igtipus_$i"];
        $igszam = $_POST["igszam_$i"];


      //  $utasazon = $dbhandler->getKeresett("utasok","utasazon","nev","'$nev'");
        //print_r($utasazon);

        if($dbhandler->getKeresett("utasok","utasazon","nev","'$nev'")[0] != "") {
            //update if exists
            $utasazon = $dbhandler->getKeresett("utasok","utasazon","nev","'$nev'")[0];

            $dbhandler->updateUtas($utasazon,$igtipus,$igszam,$tel,$orszag,$iranyitoszam,$telepules,$lakcim,$erttel,$ertemail,$biztnev,$fizmod);
        } else {

            $dbhandler->setUtas($nev, $szulev, $szulho, $szulnap, $age,$nem,$igtipus,$igszam,$tel,$email,$orszag,$iranyitoszam,$telepules,$lakcim,$erttel,$ertemail,$biztnev,$fizmod);
        }
        $utasazon = $dbhandler->getKeresett("utasok","utasazon","nev","'$nev'")[0];

        $dbhandler->setUtazas($utazasazon,$utasazon,$honnan,$hotel_nev,$mettol,$meddig,$utazasmod,$ellatas,$ar);

        $utazasazon = $dbhandler->select("select utazasazon from utazas where utasazon = $utasazon AND mettol = '$mettol'")[0]['utazasazon'];

     

        //echo $utasazon;
        //echo $utazasazon;

       // echo $dbhandler->select("SELECT COUNT(*) AS count FROM utasok")[0]['count'];

        $dbhandler->setCsoport($utasazon, $utazasazon, $csoportID);

        
    }
    $orszag = $_POST['orszag_0']; 
    $lakhely = $_POST["iranyitoszam_0"].' '.$_POST["telepules_0"].','.$_POST["lakcim_0"];
    $nev = $_POST['nev_0'];
    //Megnyitja a számlát új ablakban illetve visszadob a főoldalra
    echo "<script type='text/javascript'>window.location = 'invoice.php?nev=$nev&utasszam=$utasok_szama&csomag_e=$csomag_e&honnan=$honnan&hotel_nev=$hotel_nev&ellatas=$ellatas&mettol=$mettol&meddig=$meddig&ar=$ar&orszag=$orszag&lakcim=$lakhely&szallas=$szallas&days=$days&utazas=$utazas&ellatas_ar=$ellatas_ar';</script>";

?>