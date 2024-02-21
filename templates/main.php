<?php
    require_once(__DIR__."/../helpers/dbhandler.php");
    $dbhandler = new DbHandler();
   
?>
<script src="https://kit.fontawesome.com/7ad21db75c.js" crossorigin="anonymous"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

<div class="main">
<div class="valaszto">
    <p class="utazna">Utazna?</p>
    <form action="../tervezes/tervezes.php" method="get" class="tervezesform">
        <label for="indulas" class="indulaslabel">Indulás</label>
        <input type="text" name="indulas" id="indulas" class="helyinput">
        <label for="celpont" class="celpontlabel">Célpont</label>
        <input type="text" name="celpont" id="celpont" class="helyinput">
        <input type="submit" value="" class="newbutton button">

    </form>
</div>
<div class="ajanlatok">
    <div class="ajanlatokkozep">
        <h1 class="kiemelt">Kiemelt ajánlataink</h1>
        <div class="slideshow-container">

        <div class="mySlides fade">
            <div class="numbertext">1 / 3</div>
            <img src="../img/operahazproba.jpg" class="sliderimg">
            <div class="text">
                <p class="sliderfocim">Fedezd fel a világ legikonikusabb operaházát!</p>
                <p class="sliderhotelnev">Sydney Harbour Hotel<p class="stars"><i class="fa-solid fa-star"></i></p></p>
                
                <p class="sliderrepter">BUD <i class="fa-solid fa-plane"></i> SDY</p>
                <p class="sliderdatum">02.020.02 - 020.020.02</p>
                <p class="sliderar">93.100 Ft / fő -től</p>
            </div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">2 / 3</div>
            <img src="../img/maroccoproba.png" class="sliderimg">
            <div class="text">
                <p class="sliderfocim">Élvezze az arab világ csendes luxusát!</p>
                <p class="sliderhotelnev">Marocco Central<p class="stars"><i class="fa-solid fa-star"></i></p></p>
                
                <p class="sliderrepter">BUD <i class="fa-solid fa-plane"></i> CMN</p>
                <p class="sliderdatum">02.020.02 - 020.020.02</p>
                <p class="sliderar">158.000 Ft / fő -től</p>
            </div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">3 / 3</div>
            <img src="../img/nyil.svg" class="sliderimg">
            <div class="text">Caption Three</div>
        </div>

            <a class="prev" onclick="plusSlides(-1)">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>

        </div>
        <br>

        <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span> 
            <span class="dot" onclick="currentSlide(2)"></span> 
            <span class="dot" onclick="currentSlide(3)"></span> 
        </div>
        </div>
        
</div>
<div class="promo">
<div class="szovegek">
        <div class="kisszoveg vonal">
            <p class="kisszovegcim">Széles választék, végtelen kalandok</p>
            <p class="kisszoveghosszan">Nyissd fel a végtelen lehetőségek világát utazási 
                ügynökségünk hihetetlen utazásainak számtalan célállomásával! 🗺️ 
                Legyen szó a Bali napsütötte strandjairól, Róma történelmi 
                bájáról vagy Japán exotikus vonzásáról, mi gondoskodunk róla, 
                hogy megtaláld az álomnyaralást. Széles választékunkkal a 
                tökéletes nyaralás csak egy foglalást jelent tőled. Ne elégedj 
                meg az átlagossal, válassz kiemelkedőt velünk!</p>
        </div>
        <div class="kisszoveg vonal">
            <p class="kisszovegcim">Minőség és egyediség megtestesülése</p>
            <p class="kisszoveghosszan">Indulj elfelejthetetlen utazásokra premier utazási ügynökségünkkel! 
                🌍 Tapasztald meg a minőség csúcsát, miközben szakértő csapatunk 
                személyre szabott kalandokat készít számodra. Luxus utazásoktól 
                kezdve izgalmas expedíciókig minden pillanatot úgy tervezünk, hogy 
                az elvárásaidat felülmúlja. Fedezd fel a világot velünk!</p>
        </div>
        <div class="kisszoveg">
            <p class="kisszovegcim">Kiemelkedő élmények megfizethető áron</p>
            <p class="kisszoveghosszan">Engedd meg magadnak az ultimát utazási élményt anélkül, hogy 
                mélyen a zsebedbe kellene nyúlnod! 💼 Utazási irodánk verhetetlen 
                áron kínál minőséget anélkül, hogy kompromisszumot kellene kötnöd. 
                Búcsúzz el a költségvetési korlátoktól, és köszönj üdvözletet az 
                elérhetetlen kalandoknak. Kizárólagos ajánlatainkkal és kedvezményeinkkel 
                álmaid vakációja most még megfizethetőbb, mint valaha. Utazz okosan, utazz velünk!</p>
        </div>
</div>
<div class="stats">
    <div class="statbal">
        <p class="nagyp">Már</p>
        <p class="ugyfelcount"><?php echo $dbhandler->getUtazoCount()[0];?></p>
        <p class="nagyp">Ügyfél választott minket!</p>
        <p class="kisp">Legyen ön a következő</p>
    </div>
    <div class="statjobb">
    <p class="nagyp">Összesen</p>
        <p class="ugyfelcount">880</p>
        <p class="nagyp">Úticél</p>
        <p class="kisp">És Ön hova utazik?</p>

    </div>
    </div>
</div>
