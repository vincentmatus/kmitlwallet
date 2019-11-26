<?php session_start(); 
include_once('user_lock.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>รายการโปรด</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>

    <?php include 'navbar.php';?>
    

 
<?php
//1. เชื่อมต่อ database: 
include('connect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

//2. query ข้อมูลจากตาราง tb_member: 
$query = "SELECT * FROM `favorites` WHERE `UserID` = '".$_SESSION['id']."' ORDER BY FavoritesName asc " or die("Error:" . mysqli_error()); 
//3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result . 
$result = mysqli_query($conn, $query); 
//4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล: 
?>
 <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto mt-5">
                <div class="card">
                <form action="" method="POST">
                    <div class="card-header text-center">
                        รายการโปรด
                    </div>
                    <div class="card-body">
                    <a href="favorite_add.php">
                            <input type="button" name="submit" class="btn btn-success" value="เพิ่มรายการโปรด"></a><br><br>

<?php




while($row = mysqli_fetch_array($result)) { ?>

<div class="form-group row">
                            <label for="username" class="col-sm-3 col-form-label">ชื่อผู้รับ</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="UserID" name="UserID" value="<?php echo $row["FavoritesName"]; ?>" required>
                            </div>
                            <div class="col-sm-3">
                            <a href="pay.php?p_id=<?php echo $row['AccountNumber']; ?>">
                            <input type="button" name="submit" class="btn btn-success" value="โอนเงิน"></a>
                            <a href="favorite_delete.php?a_id=<?php echo $row['AccountNumber']; ?>&u_id=<?php echo $_SESSION['id']; ?>" onClick="javascript:return confirm('คุณต้องการลบข้อมูลใช่หรือไม่');">
                            <input type="button" name="submit" class="btn btn-danger" value="ลบ" ></a>
                            </div>

                        </div>







<?php

}




//5. close connection
mysqli_close($conn);
?>
</div>
                        <div class="card-footer text-center">
                        
                        </div>
                        
</div></div></div>





    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
</body>
</html>