<?php session_start(); 
include_once('user_lock.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ประวัติการทำรายการ</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>


    <?php include 'navbar.php';?>
    <meta charset="UTF-8">

    <div class="container">
    <div class="row">
            <div class="col-md-12 mx-auto mt-5">
            <ul class="nav nav-tabs">

  <li class="nav-item">
    <a class="nav-link active" href="#">รับ</a>

    <?php
//1. เชื่อมต่อ database: 
include('connect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

//2. query ข้อมูลจากตาราง tb_member: 
$query = "SELECT * FROM history WHERE UserID = '".$_SESSION['id']."' AND type = 'receive'  ORDER BY Date asc" or die("Error:" . mysqli_error()); 
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





?>




  </li>

  <li class="nav-item">
    <a class="nav-link active" href="#">โอน</a>

    <?php
//1. เชื่อมต่อ database: 
include('connect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

//2. query ข้อมูลจากตาราง tb_member: 
$query = "SELECT * FROM history WHERE UserID = '".$_SESSION['id']."' AND  type = 'transfer' ORDER BY Date asc" or die("Error:" . mysqli_error()); 
//3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result . 
$result = mysqli_query($conn, $query); 
//4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล: 

echo "<table border='1' align='center' width='500' class=table>";

//หัวข้อตาราง
echo "<tr align='center'  bgcolor='#B4CDCD' ><td>รหัส</td><td>Transaction_ID</td><td>type</td><td>วันเวลา</td><td>จำนวน</td><td>Account</td><td>บันทึกช่วยจำ</td></tr>";

while($row = mysqli_fetch_array($result)) { 
  echo "<tr>";
  echo "<td>" .$row["UserID"] .  "</td> "; 
  echo "<td>" .$row["TransactionID"] .  "</td> ";  
  echo "<td>" .$row["type"] .  "</td> ";
  echo "<td>" .$row["Date"] .  "</td> ";
  echo "<td>" .$row["amount"] .  "</td> ";
  echo "<td>" .$row["Account"] .  "</td> ";
  echo "<td>" .$row["remind"] .  "</td> ";

  echo "</tr>";
}
echo "</table>";





?>




  </li>

  <li class="nav-item">
    <a class="nav-link active" href="#">เติมเงินผ่านธนาคาร</a>
    
    <?php
//1. เชื่อมต่อ database: 
include('connect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

//2. query ข้อมูลจากตาราง tb_member: 
$query = "SELECT * FROM history WHERE UserID = '".$_SESSION['id']."' AND type = 'deposit' ORDER BY Date asc" or die("Error:" . mysqli_error()); 
//3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result . 
$result = mysqli_query($conn, $query); 
//4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล: 

echo "<table border='1' align='center' width='500' class=table>";

//หัวข้อตาราง
echo "<tr align='center'  bgcolor='#B4CDCD' ><td>รหัส</td><td>Transaction_ID</td><td>type</td><td>วันเวลาที่โอน</td><td>จำนวน</td><td>เลขบัญชี</td><td>สถานะการเติมเงิน</td></tr>";

while($row = mysqli_fetch_array($result)) { 
  echo "<tr>";
  echo "<td>" .$row["UserID"] .  "</td> "; 
  echo "<td>" .$row["TransactionID"] .  "</td> ";  
  echo "<td>" .$row["type"] .  "</td> ";
  echo "<td>" .$row["deposit_date"] .  "</td> ";
  echo "<td>" .$row["amount"] .  "</td> ";
  echo "<td>" .$row["Bank"] .  "</td> ";
  if ($row["deposit_status"]==0){
  echo "<td>" ."กำลังดำเนินการ".  "</td> ";
  }elseif($row["deposit_status"]==1){
    echo "<td>" ."เสร็จสิ้น".  "</td> ";
  }else{
    echo "<td>" ."ผิดพลาดโปรดติดต่อแอดมิน".  "</td> ";
  }
  echo "</tr>";
}
echo "</table>";





?>
  </li>


  </li>

  <li class="nav-item">
    <a class="nav-link active" href="#">บัตรเติมเงิน</a>
    
    <?php
//1. เชื่อมต่อ database: 
include('connect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

//2. query ข้อมูลจากตาราง tb_member: 
$query = "SELECT * FROM history WHERE UserID = '".$_SESSION['id']."' AND type = 'topup' ORDER BY Date asc" or die("Error:" . mysqli_error()); 
//3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result . 
$result = mysqli_query($conn, $query); 
//4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล: 

echo "<table border='1' align='center' width='500' class=table>";

//หัวข้อตาราง
echo "<tr align='center'  bgcolor='#B4CDCD' ><td>รหัส</td><td>Transaction_ID</td><td>type</td><td>วันเวลาที่เติม</td><td>จำนวน</td><td>รหัสบัตร</td></tr>";

while($row = mysqli_fetch_array($result)) { 
  echo "<tr>";
  echo "<td>" .$row["UserID"] .  "</td> "; 
  echo "<td>" .$row["TransactionID"] .  "</td> ";  
  echo "<td>" .$row["type"] .  "</td> ";
  echo "<td>" .$row["Date"] .  "</td> ";
  echo "<td>" .$row["amount"] .  "</td> ";
  echo "<td>" .$row["TopUp"] .  "</td> ";


  echo "</tr>";
}
echo "</table>";





?>
  </li>
 
 
</ul>


</div></div></div>


<?php 
//5. close connection
mysqli_close($conn); ?>


    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
</body>
</html>