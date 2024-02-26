$(document).ready(function() {
    var offset = 3; // Initial offset for loading more records
    var limit = 3;  // Number of records to load per request
    
    //var currentScriptUrl = document.currentScript.src;

    $('#loadMoreBtn').click(function() {
        $.ajax({
            url: '../helpers/load-more.php', //currentScriptUrl/../helpers/load-more.php
            type: 'post',
            data: {offset: offset, limit: limit},
            success: function(response) {
                $('#utazasok').append(response); // Append loaded records to container
                offset += limit; // Increment offset for next request
            } 
            
        });
    });
   });
