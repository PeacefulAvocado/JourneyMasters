<?php
    require_once(__DIR__.'/../helpers/dbhandler.php');
    $dbhandler = new DbHandler();
// load_more.php

// Assuming $dbhandler is your database handler

$offset = $_POST['offset']; // Offset for fetching records
if (isset($_POST['query'])) {

    $query = $_POST['query'];
} else {
    $query = "select * from helyszin where aktiv = 1 LIMIT $offset, 3";
}

$helyszin = $dbhandler->select($query);
 $j = 1;

 $len = count($helyszin);
 

 for($i = 0; $i < $len;$i++) {
    $hotel_nev = $helyszin[$i]['nev'];
    $varos = $helyszin[$i]['varos'];
    $cim = $helyszin[$i]['cim'];
    $csillag = $helyszin[$i]['csillag'];
    $ar = $helyszin[$i]['ar'];
    $stars = "";
    for($j = 0; $j < $csillag;$j++) {
      $stars.="<i class='fa-solid fa-star'></i>";
    }

    echo "<form action='../index/reszletek.php' method='get' class='tervezesegyeni' id='hely'>
    <img src='../img/sydneyproba.jpg' alt='$varos'>
    <p class='hotelnev'>$hotel_nev</p>
    <p class='stars'>$stars</p>
    <br>
    <p class='hotelcim'>$varos, $cim</p>
    <p class='ar'>$ar Ft / fő -től</p>
    <input type='hidden' name='csomag' value='false'>
    <input type='hidden' name='hotelcim' value='$cim'>
    <input type='button' value='' class='newbutton button' onclick='bekuld()'>
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
