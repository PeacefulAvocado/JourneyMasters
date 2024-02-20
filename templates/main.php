
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


</div>
