<?php session_start(); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>


    <?php include 'navbar.php';?>
    <meta charset="UTF-8">

    <div class="container">
    <div class="row">
            <div class="col-md-12 mx-auto mt-5">
<?php
//1. เชื่อมต่อ database: 
include('connect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

//2. query ข้อมูลจากตาราง tb_member: 
$query = "SELECT * FROM history WHERE UserID = '".$_SESSION['id']."' ORDER BY Date asc" or die("Error:" . mysqli_error()); 
//3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result . 
$result = mysqli_query($conn, $query); 
//4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล: 

echo "<table border='1' align='center' width='500' class=table>";

//หัวข้อตาราง
echo "<tr align='center'  bgcolor='#B4CDCD' ><td>รหัส</td><td>Transaction_ID</td><td>type</td><td>วันเวลา</td><td>จำนวน</td><td>Account</td></tr>";

while($row = mysqli_fetch_array($result)) { 
  echo "<tr>";
  echo "<td>" .$row["UserID"] .  "</td> "; 
  echo "<td>" .$row["TransactionID"] .  "</td> ";  
  echo "<td>" .$row["type"] .  "</td> ";
  echo "<td>" .$row["Date"] .  "</td> ";
  echo "<td>" .$row["amount"] .  "</td> ";
  echo "<td>" .$row["Account"] .  "</td> ";

  echo "</tr>";
}
echo "</table>";



//5. close connection
mysqli_close($conn);
?>
</div></div></div>





    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
</body>
</html>