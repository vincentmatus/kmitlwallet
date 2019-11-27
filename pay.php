<?php session_start(); 
include_once('user_lock.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>โอนเงิน</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>

<?php

include_once('connect.php');

if(isset($_POST['submit'])){

    $sqltrans = "SELECT * FROM `user` WHERE `UserID` = '".$_SESSION['id']."'";
    $resulttrans = $conn->query($sqltrans);

    $sqlre = "SELECT * FROM `user` WHERE `UserID` = '".$_POST['UserID']."'";
    $resultre = $conn->query($sqlre);

    if($resulttrans->num_rows > 0){
        $rowtrans = $resulttrans->fetch_assoc();
        $_SESSION['Balancetrans'] = $rowtrans['Balance'];
    }

    if($resultre->num_rows > 0){
        $rowre = $resultre->fetch_assoc();
        $_SESSION['Balancere'] = $rowre['Balance'];
    }


    if($resultre->num_rows > 0){
        $pattern = '/^[0-9.]{1,10}$/i';
        $patternbank = '/^[0-9]{4,20}$/i';
    
        
        if($_SESSION['Balancetrans']>=$_POST['value']){
            if($_POST['value']>0){
                if(preg_match($pattern, $_POST['value'])){
                    if(preg_match($patternbank, $_POST['UserID'])){
                    $_SESSION['Balancetrans'] = floatval($_SESSION['Balancetrans'])-floatval($_POST['value']);
                    $_SESSION['Balancere'] = floatval($_POST['value']) + floatval($_SESSION['Balancere']);

                    $sql = "UPDATE `user` SET `Balance`= '".$_SESSION['Balancetrans']."' WHERE `UserID` = '".$_SESSION['id']."'";
                    $result = $conn->query($sql);

                    $sql = "UPDATE `user` SET `Balance`= '".$_SESSION['Balancere']."' WHERE `UserID` = '".$_POST['UserID']."'";
                    $result = $conn->query($sql);

                    if($result){
                
                    
                        $sql = "INSERT INTO `history`(`UserID`, `type`, amount, `Account`,remind)
                        VALUES ('".$_SESSION['id']."', 'transfer', '".$_POST['value']."',  '".$_POST['UserID']."','".$_POST['remind']."');";
                        $result = $conn->query($sql);

                        $sql = "INSERT INTO `history`(`UserID`, `type`, amount, `Account`)
                        VALUES ('".$_POST['UserID']."', 'receive', '".$_POST['value']."',  '".$_SESSION['id']."');";
                        $result = $conn->query($sql);

                        echo '<script> alert("Completed!") </script>';
    
                    }else{
                        echo 'Noo';
                        echo("Error description: " . mysqli_error($conn));
                    }
                }else{
                    $error = '<font color="red">รหัสบัญชีต้องมี 4-20 ตัว และเป็นตัวเลขเท่านั้น</font>';
                }
                }else{
                    $error = '<font color="red">จำนวนเงินต้องเป็นตัวเลข และ . เท่านั้น</font>';
                }
            }else{
                $error = '<font color="red">จำนวนเงินที่โอนต้องมีค่า > 0</font>';
            }
        
            

        }else{
            echo '<script> alert("ยอดเงินคงเหลือไม่พอ!") </script>';
        }
        







    }else{
        echo '<script> alert("บัญชีผู้รับไม่มีอยู่ในระบบ!") </script>';
        
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
                        โอนเงิน
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="username" class="col-sm-3 col-form-label">รหัสร้านค้า</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="UserID" name="UserID" value="<?php if(isset($_GET["p_id"])){ echo $_GET["p_id"];} ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">จำนวนเงิน</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="value" name="value" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-3 col-form-label">บันทึกช่วยจำ</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="remind" name="remind" rows="3" placeholder="ไม่เกิน 255 ตัวอักษร"></textarea>
                            </div>
                        </div>
                        <?php if(isset($error)){
                                echo '<br>';
                                echo $error;
                            }?>
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