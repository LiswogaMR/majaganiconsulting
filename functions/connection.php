<?php

    $db = 'majaganiconsulting';
    $host = 'localhost';
    $username = 'root';
    $pass = '';
    // $pass = 'virtual@PayDay5.2';
    $conn = mysqli_connect($host, $username, $pass, $db);
    if($conn){
    	//echo 'connected';
    }
    else {
    	//echo "failed";
    }
    
?>
