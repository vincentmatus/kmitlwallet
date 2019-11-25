
<?php session_start();
include_once('admin_lock.php');
?>

<?php
	function coupon($l){
		$coupon = "CE".substr(str_shuffle(str_repeat('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',$l-2)),0,$l-2);
 
		return $coupon;
	}
 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>เติมเงิน</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar.php';?>
    <?php

        include_once('connect.php');
        
        if(isset($_POST['submit'])){
            $amount = $_POST['amount'];
            $len = $_POST['len'];
            $value = $_POST['value'];
            $error = 0;

            for ($x = 0; $x < $amount ; $x++) {
                $coupon = coupon($len);
                $sql = "SELECT * FROM `prepaidcard` WHERE CareID = '".$coupon."'";
                $result = $conn->query($sql);
                if($result){
                    $x = $x-1;
                }else{
                    $sql = "INSERT INTO `prepaidcard`(`CardID`, `amount`) VALUES ('".$coupon."','".$value."')";
                    $result = $conn->query($sql);
                }      
            }
                echo '<script> alert("Completed!") </script>';
            
            
         }   
    ?>



      <div class="container">
         <div class="row">
            <div class="col-md-8 mx-auto mt-5 ">
                <div class="card">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="card-header text-center">
                            เติมเงินผ่านธนาคาร
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">ความยาวรหัส</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="len" name="len" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">จำนวนเงิน</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="value" name="value" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">จำนวนคูปอง</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="amount" name="amount" required>
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
    <br>
    
     <script src="node_modules/jquery/dist/jquery.min.js"></script>
     <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
     <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
     

</body>
</html>