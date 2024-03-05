<?php
if(!isset($_SESSION)){
    session_start();
    }
$pdfnev = $_SESSION['pdfnev'];
?>
<script src='https://kit.fontawesome.com/7ad21db75c.js' crossorigin='anonymous'></script>
<link rel='preconnect' href='https://fonts.googleapis.com'>
<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
<link href='https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap' rel='stylesheet'>

<div class="successmain">
<div class="success">
<p class="successcim">Sikeres fizetés</p>
<hr class="vonal">
<button onclick="location.href='../index/index.php'" class="balgomb">Visszalépés a főoldalra</button>
<button onclick="window.open('../userpdf/<?php echo $pdfnev?>.pdf')" class="jobbgomb">Számla letöltése</button>

</div>
</div>