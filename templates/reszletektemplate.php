<?php
    require_once(__DIR__."/../helpers/dbhandler.php");
    $dbhandler = new DbHandler();
   
?>
<script src="https://kit.fontawesome.com/7ad21db75c.js" crossorigin="anonymous"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

<div class="reszletekmain">
<div class="reszletek">
    <div class="reszletektop">
    <img src="../img/sydneyproba.jpg" alt="Városkép" class="reszleteknagykep">
    <div class="reszletektoptext">
        <p class="reszletekhotelnev">Sydney Harbour Hotel</p>
        <p class="stars"><i class='fa-solid fa-star'></i><i class='fa-solid fa-star'></i></p>
        <p class='reszletekdatum'>2024.05.08 - 2024.05.10</p>
        
    </div>
    </div>

    <div class="slideshow-container">

    <div class="mySlides fade">
        <div class="numbertext">1 / 3</div>
    <img src="../img/operahazproba.jpg" class="sliderimg">
  
    </div>

    <div class="mySlides fade">
    <div class="numbertext">2 / 3</div>
    <img src="../img/sydneyproba.jpg" class="sliderimg">

    </div>

    <div class="mySlides fade">
    <div class="numbertext">3 / 3</div>
    <img src="../img/sydneyproba2.jpg" class="sliderimg">

    </div>

    <a class="prev" onclick="plusSlides(-1)">❮</a>
    <a class="next" onclick="plusSlides(1)">❯</a>

    </div>
    <hr id="reszletekvonal">
    <div class="szolgaltatasok">
        <p class="szolgaltatasokcim">Elérhető szolgáltatások</p>
        <hr class="szolgaltatasokvonal">

        <!--ikonok 
        img/icons/ugyanaz a nevük mint az adatbázisban-->
    </div>
    
</div>
</div>
