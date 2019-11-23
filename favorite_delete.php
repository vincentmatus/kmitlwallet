<?php
//1. เชื่อมต่อ database: 
include('connect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
//สร้างตัวแปรสำหรับรับค่า member_id จากไฟล์แสดงข้อมูล
$a_id = $_REQUEST["a_id"];
$u_id = $_REQUEST["u_id"];
 
//ลบข้อมูลออกจาก database ตาม a_id ที่ส่งมา
 
$sql = "DELETE FROM favorites WHERE AccountNumber='$a_id' AND UserID='$u_id' ";
$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
 
//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
	
	if($result){
	echo "<script type='text/javascript'>";
	echo "alert('delete Succesfuly');";
	echo "window.location = 'favorite.php'; ";
	echo "</script>";
	}
	else{
	echo "<script type='text/javascript'>";
    echo "alert('Error back to delete again');";
    echo "window.location = 'favorite.php'; ";
	echo "</script>";
}
?>