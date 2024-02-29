$(document).ready(function() {
    var hoffset = 0;// Initial offset for loading more records
    var coffset = 0;// Initial offset for loading more records
    var limit = 3;  // Number of records to load per request
    //var currentScriptUrl = document.currentScript.src;

    $('#celpont').keyup(function(){

        var nev = document.getElementById('celpont').value;
        hoffset = 0;
        coffset = 0;

            $.ajax({
                url: '../helpers/load-more-tervez-helyszin.php',
                method: 'POST',
                data: {hoffset: hoffset, coffset: coffset,nev: nev},
                success: function(data){
                    $('#helyszinek').html(data);
                }
            });
            $.ajax({
                url: '../helpers/load-more-csomag-helyszin.php',
                method: 'POST',
                data: {hoffset: hoffset, coffset: coffset,nev: nev},
                success: function(data){
                    $('#csomagcontainer').html(data);
                }
            });
        
    });


    $('#loadMoreHelyszinBtn').click(function() {

        var nev = document.getElementById('celpont').value;
        hoffset+=3;

        $.ajax({
            url: '../helpers/load-more-tervez-helyszin.php', //currentScriptUrl/../helpers/load-more.php
            type: 'post',
            data: {hoffset: hoffset, coffset: coffset, limit: limit,nev: nev},
            success: function(response) {
                $('#helyszinek').append(response); // Append loaded records to container
                 // Increment offset for next request

            } 
            
        });
    });

    $('#loadMoreCsomagBtn').click(function() {

        var nev = document.getElementById('celpont').value;
        coffset += 3;

        $.ajax({
            url: '../helpers/load-more-csomag-helyszin.php', //currentScriptUrl/../helpers/load-more.php
            type: 'post',
            data: {hoffset: hoffset, coffset: coffset, limit: limit,nev: nev},
            success: function(response) {
                $('#csomagcontainer').append(response); // Append loaded records to container
                 // Increment offset for next request
            } 
            
        });
    });
   });
