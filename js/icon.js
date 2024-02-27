function Icon() {
    var icon = document.getElementById("utazas").value;
    var span = document.getElementById("icon");
    switch (icon)
    {
        case "Repülő":
            span.innerHTML = "<i class='fa-solid fa-plane'></i>";
            break;
        case "Vonat":
            span.innerHTML = "<i class='fa-solid fa-train'></i>";
            break;
        case "Busz":
            span.innerHTML = "<i class='fa-solid fa-bus'></i>";
            break;
        case "Egyéni":
            span.innerHTML = "<i class='fa-solid fa-map-location-dot'></i>";
            break;
    }
}