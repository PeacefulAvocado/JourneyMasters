function emptyContainers() {
    var divToEmpty = document.getElementById('helyszinek');
    while (divToEmpty.firstChild) {
        divToEmpty.removeChild(divToEmpty.firstChild);
    }
    var divToEmpty = document.getElementById('csomagcontainer');
    while (divToEmpty.firstChild) {
        divToEmpty.removeChild(divToEmpty.firstChild);
    }
    
}