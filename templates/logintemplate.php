<?php
    require_once(__DIR__.'/../helpers/dbhandler.php');
    $dbhandler = new DbHandler();
    session_start();
    $_SESSION["utasid"] = $dbhandler->select("select max(utasazon) from utasok;");

    if(isset($_POST['regemail']) && isset($_POST['regjelszo']) && isset($_POST['nev']) && isset($_POST['telefonszam']) && isset($_POST['szulid']) && isset($_POST['lakcim']) && isset($_POST['igszam']) && isset($_POST['irszam']) && isset($_POST['varos']) && isset($_POST['orszag']))
    {
        $regemail = $_POST['regemail'];
        $regjelszo = $_POST['regjelszo'];
        $nev = $_POST['nev'];
        $telefonszam = $_POST['telefonszam'];
        $szulid = $_POST['szulid'];
        $lakcim = $_POST['lakcim'];
        $igtip = $_POST['igtip'];
        $igszam = $_POST['igszam'];
        $irszam = $_POST['irszam'];
        $varos = $_POST['varos'];
        $orszag = $_POST['orszag'];

        $szulido = explode('-', $szulid);

        $szulev = $szulido[0];
        $szulho = $szulido[1];
        $szulnap = $szulido[2];
        $today = new DateTime();
        $birthdate = new DateTime("$szulnap-$szulho-$szulev");
        $age = $today->diff($birthdate)->y;

        // Function to encrypt data
        function encrypt($data, $key) {
            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
            $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
            return base64_encode($encrypted . '::' . $iv);
        }

        // Function to decrypt data
        function decrypt($data, $key) {
            list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
            return openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
        }

        // Example usage
        $data = $regjelszo;
        $key = "dhsagjhkgsafg3t278fshfb2hg4r2467gr2bh23vr23gjh4b23hv2g3v42jhb2jh";

        $encrypted = encrypt($data, $key);

        //$decrypted = decrypt($encrypted, $key);

        $dbhandler->noreturnselect("insert ignore into utasok (nev, szulev, szulho, szulnap, kor, igtipus, igszam, tel, email, orszag, irszam, varos, utca) values ('$nev', ".$szulid[0].", ".$szulid[1].", ".$szulid[2].", $age,'$igtip','$igszam','$telefonszam','$regemail','$orszag',$irszam,'$varos','$lakcim')");

        $utasazon = $dbhandler->getKeresett('utasok', 'utasazon', 'igszam', "'$igszam'")[0];
        $dbhandler->noreturnselect("insert ignore into userdata values ($utasazon, '$regemail', '$encrypted')");

    }
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
            <input type="   " name="regemail" class="textinput" id="regemail">
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
            <label for="irszam">Ország:</label>
                <input type="text" name="orszag"  class="textinput" id="orszag">
            <label for="irszam">Irányítószám:</label>
                <input type="text" name="irszam"  class="textinput" id="irszam">
            <label for="varos">Település:</label>
                <input type="text" name="varos"  class="textinput" id="varos">
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