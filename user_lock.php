<?php 

if (!isset($_SESSION['id'])) { 
    echo '<script> alert("ต้อง Login ก่อน!") </script>';
    header('Refresh:0; url=login.php');
    exit();
}

?>