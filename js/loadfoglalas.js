function Loadpageegyeni(ellatas,csomag,hotel_nev,honnan,mettol,meddig, index){
    utasok_szama = document.getElementById(`fok_${index}`).value;
    window.location.href= `foglalas.php?ellatas=${ellatas}&utasok_szama=${utasok_szama}&csomag=${csomag}&helyszin=${hotel_nev}&honnan=${honnan}&mettol=${mettol}&meddig=${meddig}`;
}
function Loadpagecsomag(ellatas,csomag,hotel_nev,csomagid,index){
    utasok_szama = document.getElementById(`fok_${index}`).value;
    window.location.href= `foglalas.php?ellatas=${ellatas}&utasok_szama=${utasok_szama}&csomag=${csomag}&helyszin=${hotel_nev}&csomagid=${csomagid}`;
}