<?php
    require_once(__DIR__.'/../helpers/dbhandler.php');
    $dbhandler = new DbHandler();
// load_more.php

// Assuming $dbhandler is your database handler

$offset = $_POST['coffset']; // Offset for fetching records
if (isset($_POST['nev'])) {

    $nev = $_POST['nev'];
} else {
    $nev = "";
}


$query = "SELECT * from helyszin inner join csomagok on helyszin.nev = csomagok.celpont where csomagok.aktiv = 1 and varos like '%$nev%' limit $offset, 3";


$csomagok = $dbhandler->select($query);
$len = count($csomagok);
    for($i = 0; $i < count($csomagok);$i++) {
      
      $varos = $csomagok[$i]['varos'];
      $celpont = $csomagok[$i]['celpont'];
      $honnan = $csomagok[$i]['honnan'];
      $mettol = $csomagok[$i]['mettol'];
      $meddig = $csomagok[$i]['meddig'];
      $ar = $csomagok[$i]['ar'];
      $utazasmod = $csomagok[$i]['utazasmod'];
      $csomagid = $csomagok[$i]['csomagid'];
      
      if ($utazasmod == 'Repülő') 
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


      echo "<form action='../index/foglalas.php' method='get' class='csomagform' id='a1'>
      <img src='../img/helyszinimg/$celpont/1.jpg' alt='$varos'>
      <p class='varosnev'>$varos</p>
      <br>
      <p class='repter'>$honnan<i class='fa-solid fa-$utazasmod' style='color:#000000'></i>$varos</p>
      <br>
      <p class='datum'>$mettol  — $meddig</p>
      <p class='ar'>$ar Ft / fő -től</p>
      <input type='hidden' name='csomag' value='true'>
      <input type='hidden' name='helyszin' id='helyszin' value='$celpont'>
      <input type='hidden' name='csomagid' value='$csomagid'>
      <input type='submit' value='' class='newbutton button'>
    </form>";
    }

    $helyszin = $dbhandler->getCsomagok($offset+$len);

/*
    $len = count($helyszin);

    if ($len == 0) {
        echo "<style>
            #loadMoreHelyszinBtn {
            display: none;
            }   
        </style>"; 
     }*/
?>
