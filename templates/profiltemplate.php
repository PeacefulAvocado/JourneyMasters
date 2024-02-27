<div class="profilmain">
<div class="profil">
<p class="emailcim">dzsonasz@gmail.com</p>
<hr class="vonal">
<div class="jelszovaltoztato">
    <form action="post" class="jelszo">
        <label for="ujjelszo">Új jelszó</label>
        <input type="password" name="ujjelszo" id="ujjelszo">
        <br>
        <label for="ismetles">Új jelszó ismétlése</label>
        <input type="password" name="ismetles" id="ismetles">
        <input type="submit" value="Jelszó módosítása">
    </form>
</div>

<div class="szallashelyek">
  <p class="kiscim">Szálláshelyek</p>
  <hr class="vonal">
  <div class="szallashelycontainer">
    <form action="../index/foglalas.php" method="get" class="tervezesegyeni">
      <img src="../img/sydneyproba.jpg" alt="Sydney">
      <p class="hotelnev">Morocco Central</p>
      <p class="stars"><i class='fa-solid fa-star'></i></p>
      <br>
      <p class="hotelcim">Sydney, Australia 30 Grosvenor St.</p>
      <p class="ar">93.100 Ft / fő -től</p>
      <input type="hidden" name="csomag" value="false">
      <input type="hidden" name="datum" id="datum" value="">
      <input type="hidden" name="hotelcim" value="">
      <input type="submit" value="" class="newbutton button">
    </form>
  </div>
</div>


<div class="csomagok">
  <p class="kiscim">Csomagok</p>
  <hr class="vonal">
  <div class="csomagcontainer">
    <form action="../index/foglalas.php" method="get" class="csomagform" id='a1'>
      <img src="../img/sydneyproba.jpg" alt="Sydney">
      <p class="varosnev">Sydney</p>
      <br>
      <p class='repter'>BUD<i class='fa-solid fa-plane' style="color:#000000"></i>SDY</p>
      <br>
      <p class='datum'>2024.01.01  — 2224.01.01</p>
      <p class="ar">93.100 Ft / fő -től</p>
      <input type="hidden" name="csomag" value="true">
      <input type="hidden" name="helyszin" id="helyszin" value="">
      <input type="hidden" name="csomagid" value="">
      <input type="submit" value="" class="newbutton button">
    </form>
  </div>
</div>





</div>
</div>




<script>
$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'right'
  }, function(start, end, label) {
    
  });
});
</script>