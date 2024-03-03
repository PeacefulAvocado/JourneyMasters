<?php
    require_once(__DIR__.'/../helpers/dbhandler.php');
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

    $erttel = $_POST["erttel"];
    $ertemail = $_POST["ertemail"];
    $biztnev = $_POST["biztnev"];
    $fizmod = $_POST["fizmod"];


    $csomagid = $dbhandler->select("SELECT COUNT(*) AS count FROM utasok")[0]['count']+1;
    for($i = 0; $i<$utasok_szama; $i++) {
        $index = $i+1;

        $nev = $_POST["nev_$i"];
        $tel = $_POST["tel_$i"];

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

        $dbhandler->setUtazas($utasazon,$honnan,$hotel_nev,$mettol,$meddig,$utazasmod,$ellatas,$ar);

        $utazasazon = $dbhandler->select("select utazasazon from utazas where utasazon = $utasazon AND mettol = '$mettol'")[0]['utazasazon'];

     

        //echo $utasazon;
        //echo $utazasazon;

       // echo $dbhandler->select("SELECT COUNT(*) AS count FROM utasok")[0]['count'];

        $dbhandler->setCsoport($utasazon, $utazasazon, $csomagid);

        
    }
    $orszag = $_POST['orszag_0']; 
    $lakhely = $_POST["iranyitoszam_0"].' '.$_POST["telepules_0"].','.$_POST["lakcim_0"];
    $nev = $_POST['nev_0'];
    header("Location: invoice.php?nev=$nev&utasszam=$utasok_szama&ar=$ar&orszag=$orszag&lakcim=$lakhely");
    
?>