<?php 

if (isset($_SESSION['id'])) { 
    //login แล้ว
    include_once('connect.php');
    $sql = "SELECT * FROM `user` WHERE `UserID` = '".$_SESSION['id']."'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $_SESSION['admin'] = $row['admin'];
        if ($_SESSION['admin']==0){
            //ถ้าไม่ใช่ admin
            echo '<script> alert("คุณไม่ใช่ admin!") </script>';
            header('Refresh:0; url=index.php');
            exit();
        }
        

    }
}
//ยังไม่ได้ login
else{
    echo '<script> alert("ต้อง Login ก่อน!") </script>';
    header('Refresh:0; url=login.php');
    exit();
}



?>