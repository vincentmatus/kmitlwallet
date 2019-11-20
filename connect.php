<?php 
    $conn = new mysqli('localhost','root','1234567890','kmitl-wallet-database');

    if( $conn->connect_errno){
        die("Connection failed" . $conn->connect_error);
    }

?>
