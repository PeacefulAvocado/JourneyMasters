function emptyContainers() {
    //Kiüríti a 2 div-et, hogy az új adatok ne rájuk kerüljenek
    var divToEmpty = document.getElementById('helyszinek');
    while (divToEmpty.firstChild) {
        divToEmpty.removeChild(divToEmpty.firstChild);
    }
    var divToEmpty = document.getElementById('csomagcontainer');
    while (divToEmpty.firstChild) {
        divToEmpty.removeChild(divToEmpty.firstChild);
    }
    
}