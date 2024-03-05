// Define a global variable to store the base amount
var baseAmount = null;
var baseAmountO = null;

function Icon() {
    var icon = document.getElementById("utazas").value;
    var span = document.getElementById("icon");
    var szorz = 1;

    // Check if the base amount has been set
    if (baseAmount === null) {
        // If it hasn't been set, set it to the current value of utazas_ar
        baseAmount = document.getElementById("utazas_ar").innerHTML;
    }

    if (baseAmountO === null) {
        // If it hasn't been set, set it to the current value of utazas_ar
        baseAmountO = document.getElementById("osszeg").innerHTML;
    }

    switch (icon) {
        case "Repülő":
            span.innerHTML = "<i class='fa-solid fa-plane'></i>";
            szorz = 12;
            break;
        case "Vonat":
            span.innerHTML = "<i class='fa-solid fa-train'></i>";
            szorz = 8;
            break;
        case "Busz":
            span.innerHTML = "<i class='fa-solid fa-bus'></i>";
            szorz = 5;
            break;
        case "Egyéni":
            span.innerHTML = "<i class='fa-solid fa-map-location-dot'></i>";
            szorz = 0;
            break;
    }
    var utazas = document.getElementById("utazas_ar");
    var osszeg = document.getElementById('osszeg');

    // Calculate the new total amount based on the base amount and szorz
    utazas.innerText = baseAmount * szorz;
    osszeg.innerText = parseInt(baseAmountO) + parseInt(baseAmount * szorz);
}
