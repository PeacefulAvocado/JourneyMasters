<?php
    require_once(__DIR__.'/../helpers/dbhandler.php');
    $dbhandler = new DbHandler();
    session_start();
    $_SESSION["utasid"] = 1;

   
?>
<script src='https://kit.fontawesome.com/7ad21db75c.js' crossorigin='anonymous'></script>
<link rel='preconnect' href='https://fonts.googleapis.com'>
<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
<link href='https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap' rel='stylesheet'>

<div class="loginmain">
<div class="login"  id="login">
<p class="logincim">Bejelentkezés</p>
<hr class="vonal">
    <div class="logincontainer">
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="loginform">
            <label for="email">Email cím:</label>
            <br>
            <input type="email" name="email" class="textinput" id="email">
            <br>
            <label for="jelszo">Jelszó:</label>
            <br>
            <input type="password" name="jelszo"  class="textinput" id="jelszo">
            <br>
            <button type="button" onclick="Change('login','signup')" class="regisztracioatlep"><- Regisztráció</button>
            <input type="submit" value="Bejelentkezés" class="loginbtn">
        </form>
    </div>
</div>

<div class="signup"  id="signup">
<p class="logincim">Regisztráció</p>
<hr class="vonal">
<div class="signupcontainer">
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="signupform">
        <div class="userdata">
            <label for="regemail">Email cím:</label>
            <br>
            <input type="email" name="regemail" class="textinput" id="regemail">
            <br>
            <label for="regjelszo">Jelszó:</label>
            <br>
            <input type="password" name="regjelszo"  class="textinput" id="regjelszo">
            <br>
        </div>

        <div class="adatok">
            <label for="nev">Név:</label>
                <input type="text" name="nev"  class="textinput" id="nev">
            <label for="telefonszam">Telefonszám:</label>
                <input type="tel" name="telefonszam"  class="textinput" id="telefonszam">
            <label for="szulid">Születési idő:</label>
                <input type="date" name="szulid"  class="textinput" id="szulid">
            <label for="lakcim">Lakcím:</label>
                <input type="text" name="lakcim"  class="textinput" id="lakcim">
            <label for="igtip">Igazolvány típusa:</label>
                <select name="igtip" id="igtip">
                    <option value="Személyi igazolvány">Személyi igazolvány</option>
                    <option value="Útlevél">Útlevél</option>
                </select>
            <label for="lakcim">Igazolvány száma:</label>
                <input type="text" name="igszam"  class="textinput" id="igszam">
        </div>
            <button type="button" onclick="Change('signup','login')" class="bejelentkezesatlep"><- Bejelentkezés</button>
            <input type="submit" value="Regisztáció" class="signupbtn">
        </form>
    </div>
</div>
</div>
<script src="../js/loginpage.js"></script>