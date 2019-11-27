<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json;charset=utf-8');

if(!isset($_GET['tid']) or !isset($_GET['rid']) or !isset($_GET['amount'])){
exit();
}else{
$TID=$_GET['tid'];
$RID=$_GET['rid'];
$amount=$_GET['amount'];
}
include('connect.php');

$sql = "SELECT `UserID`, `Email`, `name`, `surname`, `Balance`, `Tel.Number` FROM `user` WHERE `UserID` = '".$TID."'";
$result = $conn->query($sql);

if($result->num_rows > 0){
    $row = $result->fetch_array();
    //echo json_encode($row);
    if($row['Balance']>=$amount){

      $output = 1;
    }else{
      $output = 0;
    }
    
    echo "Output : ";
    echo $output;
    
}else{
    echo "Null";

}

//นำเอาตัวแปร มาแปลงเป็น json แล้วส่งออก

?>