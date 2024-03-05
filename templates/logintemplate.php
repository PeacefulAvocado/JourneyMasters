<?php
require_once(__DIR__.'/../helpers/dbhandler.php');
$dbhandler = new DbHandler();
if(!isset($_SESSION)){
session_start();
}
function encrypt($data, $key)
{
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
    return base64_encode($encrypted . '::' . $iv);
}

// Function to decrypt data
function decrypt($data, $key)
{
    list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
}

$key = "dhsagjhkgsafg3t278fshfb2hg4r2467gr2bh23vr23gjh4b23hv2g3v42jhb2jh";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['regemail']) && isset($_POST['regjelszo']) && isset($_POST['nev']) && isset($_POST['telefonszam']) && isset($_POST['szulid']) && isset($_POST['lakcim']) && isset($_POST['igszam']) && isset($_POST['irszam']) && isset($_POST['varos']) && isset($_POST['orszag']) && isset($_POST['reg'])) {
        $regemail = $_POST['regemail'];
        $regjelszo = $_POST['regjelszo'];
        $nev = $_POST['nev'];
        $telefonszam = $_POST['telefonszam'];
        $szulid = $_POST['szulid'];
        $neme = $_POST['nem'];
        $lakcim = $_POST['lakcim'];
        $igtip = $_POST['igtip'];
        $igszam = $_POST['igszam'];
        $irszam = $_POST['irszam'];
        $varos = $_POST['varos'];
        $orszag = $_POST['orszag'];

        $utasazon = $dbhandler->getKeresett('utasok', 'utasazon', 'igszam', "'$igszam'");

        $emailkeres = $dbhandler->select("select email from userdata");
        $db = $dbhandler->select("select count(*) as '0' from userdata")[0];
        $van = false;
        $i = 0;
        while (!$van && $i < $db[0]) {
            if ($emailkeres[$i]['email'] == $regemail) {
                $van = true;
            }
            $i++;
        }

        if (($regemail != null && $regjelszo != null && $nev != null && $telefonszam != null && $szulid != null && $lakcim != null && $igszam != null && $irszam != null && $varos != null && $orszag != null)) {
            if (!$van) {
                if ($utasazon == null) {
                    try {
                        $szulido = explode('-', $szulid);
                        $szulev = $szulido[0];
                        $szulho = $szulido[1];
                        $szulnap = $szulido[2];
                        $today = new DateTime();
                        $birthdate = new DateTime("$szulnap-$szulho-$szulev");
                        $age = $today->diff($birthdate)->y;
                        $dbhandler->noreturnselect("insert ignore into utasok (nev, szulev, szulho, szulnap, kor, igtipus, igszam, tel, email, orszag, irszam, varos, utca, nem) values ('$nev', ".$szulid[0].", ".$szulid[1].", ".$szulid[2].", $age,'$igtip','$igszam','$telefonszam','$regemail','$orszag','$irszam','$varos','$lakcim', '$neme')");

                        // Function to encrypt data

                        // Example usage
                        $data = $regjelszo;

                        $encrypted = encrypt($data, $key);

                        //$decrypted = decrypt($encrypted, $key);
                        $utasazon = $dbhandler->getKeresett('utasok', 'utasazon', 'igszam', "'$igszam'")[0];
                        $dbhandler->noreturnselect("insert ignore into userdata values ($utasazon, '$regemail', '$encrypted')");
                        $_SESSION['utasid'] = $utasazon;
                        echo "<script>
                        alert('Sikeres regisztráció!');
                        window.location.href = '../index/profil.php';
                        </script>";
                    } catch (Exception $e) {
                        echo "<script>
                        alert('Hibás bemenet!')
                        document.getElementById('login').style.display = 'none';
                        document.getElementById('signup').style.display = 'block';
                        </script>";
                    }
                } else {
                    echo "<script>
                    alert('A megadott igazolványszámhoz már tartozik profil!');
                    document.getElementById('login').style.display = 'none';
                    document.getElementById('signup').style.display = 'block';
                    </script>";
                }
            } else {
                echo "<script>
                alert('A megadott email cím már foglalt!');
                document.getElementById('login').style.display = 'none';
                document.getElementById('signup').style.display = 'block';
                </script>";
            }
        } else {
            echo "<script>
                alert('Adjon meg minden adatot!')
                document.getElementById('login').style.display = 'none';
                document.getElementById('signup').style.display = 'block';
                </script>";
        }
    }
}
if (isset($_POST['bej']) && isset($_POST['jelszo']) && isset($_POST['email']))
{
    $email = $_POST['email'];
    $jelszo = $_POST['jelszo'];
    $emailkeres = $dbhandler->select("select email from userdata");
    $van = false;
    $db = $dbhandler->select("select count(*) as '0' from userdata")[0];
    $i = 0;
    while (!$van && $i < $db[0]) {
        if ($emailkeres[$i]['email'] == $email) {
            $van = true;
        }
        else {
        $i++;
        }
    }
    if ($van)
    {
        $keresettemail = $emailkeres[$i]['email'];
        $jelszodb = $dbhandler->getKeresettNoAktiv('userdata', 'jelszo', 'email', "'$keresettemail'")[0];
        $jelszodb = decrypt($jelszodb, $key);
        if ($jelszo == $jelszodb)
        {
            $utasazon = $dbhandler->getKeresettNoAktiv('userdata', 'utasid', 'email', "'$email'")[0];
            $_SESSION['utasid'] = $utasazon;
            echo "<script>
                alert('Sikeres bejelentkezés!');
                window.location.href = '../index/profil.php';
                </script>";
        }
        else
        {
            echo "<script>
        alert('Hibás jelszó!')
        </script>";
        }
    }
    else {
        echo "<script>
        alert('Ehhez az email címhez nem tartozik profil!')
        </script>";
    }
}
?>
<script src='https://kit.fontawesome.com/7ad21db75c.js' crossorigin='anonymous'></script>
<link rel='preconnect' href='https://fonts.googleapis.com'>
<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
<link href='https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap' rel='stylesheet'>

<div class="loginmain">
    <div class="login" id="login">
        <p class="logincim">Bejelentkezés</p>
        <hr class="vonal">
        <div class="logincontainer">
            <form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="loginform">
                <label for="email">Email cím:</label>
                <br>
                <input type="email" name="email" class="textinput" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
                <br>
                <label for="jelszo">Jelszó:</label>
                <br>
                <input type="password" name="jelszo" class="textinput" id="jelszo" >
                <br>
                <button type="button" onclick="Change('login','signup')" class="regisztracioatlep"><- Regisztráció</button>
                <input type="submit" value="Bejelentkezés" name="bej" class="loginbtn">
            </form>
        </div>
    </div>


    <div class="signup" id="signup">
        <p class="logincim">Regisztráció</p>
        <hr class="vonal">
        <div class="signupcontainer">
            <form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="signupform">
                <div class="userdata">
                    <label for="regemail">Email cím:</label>
                    <br>
                    <input type="email" name="regemail" class="textinput" id="regemail"
                        value="<?php echo isset($_POST['regemail']) ? $_POST['regemail'] : '' ?>">
                    <br>
                    <label for="regjelszo">Jelszó:</label>
                    <br>
                    <input type="password" name="regjelszo" class="textinput" id="regjelszo">
                    <br>
                </div>

                <div class="adatok">
                    <label for="nev">Név:</label>
                    <input type="text" name="nev" class="textinput" id="nev"
                        value="<?php echo isset($_POST['nev']) ? $_POST['nev'] : '' ?>">
                    <label for="telefonszam">Telefonszám:</label>
                    <input type="tel" name="telefonszam" class="textinput" id="telefonszam"
                        value="<?php echo isset($_POST['telefonszam']) ? $_POST['telefonszam'] : '' ?>">
                    <label for="szulid">Születési idő:</label>
                    <input type="date" name="szulid" class="textinput" id="szulid" value="2000-01-01"
                        value="<?php echo isset($_POST['szulido']) ? $_POST['szulido'] : '' ?>">
                    <label for="nem">Neme:</label>
                    <select name="nem" id="nem" class="textinput"
                        value="<?php echo isset($_POST['nem']) ? $_POST['nem'] : '' ?>">
                        <option value="Férfi">Férfi</option>
                        <option value="Nő">Nő</option>
                        <option value="Egyéb">Egyéb</option>
                    </select>
                    <label for="irszam">Ország:</label>
                    <input type="text" name="orszag" class="textinput" id="orszag"
                        value="<?php echo isset($_POST['orszag']) ? $_POST['orszag'] : '' ?>">
                    <label for="irszam">Irányítószám:</label>
                    <input type="text" name="irszam" class="textinput" id="irszam"
                        value="<?php echo isset($_POST['irszam']) ? $_POST['irszam'] : '' ?>">
                    <label for="varos">Település:</label>
                    <input type="text" name="varos" class="textinput" id="varos"
                        value="<?php echo isset($_POST['varos']) ? $_POST['varos'] : '' ?>">
                    <label for="lakcim">Lakcím:</label>
                    <input type="text" name="lakcim" class="textinput" id="lakcim"
                        value="<?php echo isset($_POST['lakcim']) ? $_POST['lakcim'] : '' ?>">
                    <label for="igtip">Igazolvány típusa:</label>
                    <select name="igtip" id="igtip"
                        value="<?php echo isset($_POST['igtip']) ? $_POST['igtip'] : '' ?>">
                        <option value="Személyi igazolvány">Személyi igazolvány</option>
                        <option value="Útlevél">Útlevél</option>
                    </select>
                    <label for="lakcim">Igazolvány száma:</label>
                    <input type="text" name="igszam" class="textinput" id="igszam"
                        value="<?php echo isset($_POST['igszam']) ? $_POST['igszam'] : '' ?>">
                </div>
                <button type="button" onclick="Change('signup','login')" class="bejelentkezesatlep"><-
                    Bejelentkezés</button>
                <input type="submit" value="Regisztáció" name="reg" class="signupbtn">
            </form>

        </div>
    </div>
</div>
<script src="../js/loginpage.js"></script>
