function Dropdown() {
    var ellatas = document.getElementById("ellatas").value;
    var ki = document.getElementById("ki");
    var displayedPriceElement = document.getElementById("displayedPrice");

    // Retrieve the original price from the hidden input field
    var originalPrice = parseInt(document.getElementById("originalPrice").value);
    
    switch (ellatas) {
        case "All inclusive":
            ki.innerHTML = "Reggeli<br>Ebéd<br>Vacsora<br>Szobaszervíz";
            displayedPriceElement.textContent = originalPrice * 2; // Update displayed price
            break;
        case "Félpanzió":
            ki.innerHTML = "Reggeli<br>Vacsora";
            displayedPriceElement.textContent = originalPrice * 1.5; // Update displayed price
            break;
        case "Teljes panzió":
            ki.innerHTML = "Reggeli<br>Ebéd<br>Vacsora";
            displayedPriceElement.textContent = originalPrice * 1.8; // Update displayed price
            break;
        case "Szállás és Reggeli":
            ki.innerHTML = "Reggeli";
            displayedPriceElement.textContent = originalPrice * 1.2; // Update displayed price
            break;
        case "Csak Szállás":
            ki.innerHTML = "Nincs";
            // If there's no meal plan, reset the displayed price to the original price
            displayedPriceElement.textContent = originalPrice;
            break;
    }
}