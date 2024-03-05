<?php
// Retrieve the value from the AJAX request
$utazas_ar = $_POST['utazas_ar'];

// Now you can use $utazas_ar as a PHP variable
// For example, you can store it in a session variable
session_start();
$_SESSION['utazas_ar'] = ceil($utazas_ar);

// Send a response to the AJAX request
http_response_code(200);
?>
