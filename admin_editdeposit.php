<?php session_start();
include_once('admin_lock.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>แก้ไขการฝากเงิน</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar.php';?>
    <?php

        include_once('connect.php');

        if(isset($_GET["u_id"])){
            $sql = "SELECT * FROM `history` WHERE `UserID` = '".$_GET["u_id"]."' AND `TransactionID` = '".$_GET["t_id"]."' ";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                 
            }
            else{
                exit();
            }

        }else{
            exit();
        }

           if(isset($_POST['submit'])){
                $sql = "UPDATE `history` SET `deposit_status`='".$_POST['deposit_status']."' WHERE UserID = '".$_GET["u_id"]."' AND `TransactionID` = '".$_GET["t_id"]."'";
                $result = $conn->query($sql);

                if($result){
                    echo '<script> alert("Edit Completed!") </script>';
                    header('refresh:0');
                }else{
                    echo '<script> alert("Edit Error!") </script>';
                    echo("Error description: " . mysqli_error($conn));
                }    
         }
         
         

    ?>



      <div class="container">
         <div class="row">
            <div class="col-md-8 mx-auto mt-5 ">
                <div class="card">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="card-header text-center">
                            แก้ไขการฝากเงิน
                        </div>
                        <div class="card-body">
                        <div class="form-group row">
                            <label for="firstname" class="col-sm-3 col-form-label">Userid</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="userid" name="userid" value="<?php echo $row["UserID"];?>" readonly required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lastname" class="col-sm-3 col-form-label">TransactionID</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="transactionid" name="transactionid" value="<?php echo $row["TransactionID"];?>" readonly required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">Type</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="type" name="type" value="<?php echo $row["type"];?>" readonly required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">amount</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="amount" name="amount" value="<?php echo $row["amount"];?>" readonly required>
                                </div>
                            </div>
                        
                         
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">เลขบัญชีที่ฝาก</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="bank" name="bank" value="<?php echo $row["Bank"]; ?>" readonly required>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                   
                                    <input type="text" class="form-control" id="deposit_status" name="deposit_status" value="<?php echo $row["deposit_status"]; ?>" required>
                                </div>
                            </div>
                            
                        

                      

                        </div>
                        <div class="card-footer text-center">
                            <input type="submit" name="submit" class="btn btn-success" value="เพิ่ม">
                            
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