function Dropdown(){
    var ellatas = document.getElementById("ellatas").value;
    var ki = document.getElementById("ki");
    switch(ellatas){
        case "All inclusive":
            ki.innerHTML="Reggeli<br>Ebéd<br>Vacsora"
            break;
        case "Félpanzió":
            ki.innerHTML="Reggeli<br>Vacsora"
            break;
        case "Teljes panzió":
            ki.innerHTML="Reggeli<br>Ebéd<br>Vacsora"
            break;
        case "Szállás és Reggeli":
            ki.innerHTML="Reggeli"
            break;
        case "Csak Szállás":
            ki.innerHTML="Nincs"
            break;        
    }
}