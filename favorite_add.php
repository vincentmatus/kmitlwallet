<?php session_start(); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>เพิ่มรายการโปรด</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>

<?php

include_once('connect.php');

if(isset($_POST['submit'])){

  
    $sql = "SELECT * FROM `user` WHERE `UserID` = '".$_POST['UserID']."'";
    $result = $conn->query($sql);




    if($result->num_rows > 0){
        $sql = "SELECT * FROM `favorites` WHERE `AccountNumber` = '".$_POST['UserID']."' AND `UserID` = '".$_SESSION['id']."' ";
        $result = $conn->query($sql);
        if($result->num_rows == 0){
            $sql = "INSERT INTO `favorites` (`UserID`, `FavoritesName`, `AccountNumber`) VALUES ('".$_SESSION['id']."', '".$_POST['name']."', '".$_POST['UserID']."');";
            $result = $conn->query($sql);
            if($result){
                echo '<script> alert("Completed!") </script>';
            }else{
                echo '<script> alert("Error!") </script>';
                echo("Error description: " . mysqli_error($conn));
            }


        }else{
            echo '<script> alert("คุณมีรายการโปรดนี้อยู่แล้ว!") </script>';

        }



    }else{
        echo '<script> alert("บัญชีไม่มีอยู่ในระบบ!") </script>';
    }
    }

?>


    <?php include 'navbar.php';?>


    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto mt-5">
                <div class="card">
                <form action="" method="POST">
                    <div class="card-header text-center">
                        เพิ่มรายการโปรด
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="username" class="col-sm-3 col-form-label">รหัส</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="UserID" name="UserID" value="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">ชื่อ</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                    </div>
                        <div class="card-footer text-center">
                            <input type="submit" name="submit" class="btn btn-success" value="ยืนยัน">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
</body>
</html>