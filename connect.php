<?php 
    $conn = new mysqli('localhost','root','','kmitl-wallet-database');

    if( $conn->connect_errno){
        die("Connection failed" . $conn->connect_error);
    }

?>