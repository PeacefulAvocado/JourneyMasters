//A főoldalon a célpont beírásánál lenyíló ablakban megjelennek a lehetséges célpontok
$(document).ready(function(){
    $('#searchInput').keyup(function(){
        var query = $(this).val();
        if(query != ''){
            $.ajax({
                url: '../helpers/search.php',
                method: 'POST',
                data: {query:query},
                success: function(data){
                    $('#searchResults').html(data);
                }
            });
        } else {
            $('#searchResults').html('');
        }
    });
});

// Function to set selected place in input field
function selectPlace(placeName) {
    $('#searchInput').val(placeName);
    $('#searchResults').html('');
}