$(document).ready(function() {
    var offset = 3; // Initial offset for loading more records
    var limit = 3;  // Number of records to load per request
    
    //var currentScriptUrl = document.currentScript.src;
    $('#celpont').keyup(function(){
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


    $('#loadMoreHelyszinBtn').click(function() {
        $.ajax({
            url: '../helpers/load-more-tervez-helyszin.php', //currentScriptUrl/../helpers/load-more.php
            type: 'post',
            data: {offset: offset, limit: limit},
            success: function(response) {
                $('#helyszinek').append(response); // Append loaded records to container
                offset += limit; // Increment offset for next request
            } 
            
        });
    });
   });
