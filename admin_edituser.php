<?php session_start();
include_once('admin_lock.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>แก้ไขสมาชิก</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar.php';?>
    <?php

        include_once('connect.php');

        if(isset($_GET["u_id"])){
            $sql = "SELECT * FROM `user` WHERE `UserID` = '".$_GET["u_id"]."' ";
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
                $sql = "UPDATE `user` SET `UserID`='".$_POST['userid']."',`Email`='".$_POST['email']."',`name`='".$_POST['name']."',`surname`='".$_POST['surname']."',`Balance`='".$_POST['balance']."',`Tel.Number`='".$_POST['telnumber']."',`Birthday`='".$_POST['birthday']."',`admin`='".$_POST['admin']."' WHERE UserID = '".$_GET["u_id"]."' ";
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
                            แก้ไขสมาชิก
                        </div>
                        <div class="card-body">
                        <div class="form-group row">
                            <label for="firstname" class="col-sm-3 col-form-label">Userid</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="userid" name="userid" value="<?php echo $row["UserID"];?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lastname" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $row["Email"];?>" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $row["name"];?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">Surname</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $row["surname"];?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">Tel.</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="telnumber" name="telnumber" value="<?php echo $row["Tel.Number"];?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">Birthday</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="birthday" name="birthday" value="<?php echo $row["Birthday"];?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">Balance</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="balance" name="balance" value="<?php echo $row["Balance"]; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="admin" name="admin" value="<?php echo $row["admin"]; ?>" required>
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