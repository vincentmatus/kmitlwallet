<?php session_start(); 
include_once('user_lock.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>บัตรเติมเงิน</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>

<?php

include_once('connect.php');

if(isset($_POST['submit'])){

    $sql = "SELECT * FROM `PrepaidCard` WHERE CardID = '".$_POST['cardid']."' and status = 0 ";
    $resultcard = $conn->query($sql);
    $rowcard = $resultcard->fetch_assoc();

   
    if($resultcard->num_rows > 0){
        //เปลี่ยน status บัตรเป็นใช้แล้ว
        $sql = "UPDATE `PrepaidCard` SET `status`=1 WHERE CardID = '".$_POST['cardid']."' ";
        $result = $conn->query($sql);
        //query เงินผู้เติม
        $sql = "SELECT Balance FROM `user` WHERE UserID = '".$_SESSION['id']."' ";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        //เพิ่มเงิน
        $sql = "UPDATE `user` SET `Balance`='".$row['Balance']."'+'".$rowcard['amount']."' WHERE UserID = '".$_SESSION['id']."' ";
        $result = $conn->query($sql);
        if($result){
            $sql = "INSERT INTO `history`(`UserID`, `type`, amount,TopUp)
            VALUES ('".$_SESSION['id']."','topup', '".$rowcard['amount']."','".$_POST['cardid']."');";
            $result = $conn->query($sql);
            echo '<script> alert("Completed!") </script>';
        }else{
            echo 'Noo';
            echo("Error description: " . mysqli_error($conn));
        }
        
        
    }else{
        echo '<script> alert("รหัสบัตรไม่ถูกต้องหรือถูกใช้งานแล้ว!") </script>';
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
                        บัตรเติมเงิน
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="username" class="col-sm-3 col-form-label">รหัสบัตรเติมเงิน</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="cardid" name="cardid" required>
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