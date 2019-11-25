<?php session_start(); 
include_once('user_lock.php');
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

            $temp = explode('.',$_FILES['fileUpload']['name']);
            $newName = round(microtime(true)).'.'. end($temp);
            if(move_uploaded_file($_FILES['fileUpload']['tmp_name'], 'uploads/deposit-slip/'.$newName)){

                $sql = "INSERT INTO `history`(`UserID`, `type`, amount,deposit_date,Bank, Picture)
                VALUES ('".$_SESSION['id']."', 'deposit', '".$_POST['value']."','".$_POST['deposit_date']."','".$_POST['bank']."','".$newName."');";
                 $result = $conn->query($sql);

                if($result){
                    echo '<script> alert("Completed!") </script>';
                    header('Refresh:0; url=deposit.php');
                }else{
                    echo 'Noo';
                    echo("Error description: " . mysqli_error($conn));
                }
            } 
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
                                <label for="password" class="col-sm-3 col-form-label">จำนวนเงิน</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="value" name="value" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">เลขบัญชี</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="bank" name="bank" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">วัน เวลาที่โอน</label>
                                <div class="col-sm-9">
                                    <input type="datetime-local" class="form-control" id="deposit_date" name="deposit_date" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fileUpload" class="col-sm-3 col-form-label">Upload</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" id="fileUpload" name="fileUpload" onchange="readURL(this)">
                                </div>
                            </div>

                            <figure class="figure">
                                <img id="imgUpload" class="figure-img img-fluid rounded" alt="">
                                <figcaption class="figure-caption">ตัวอย่างรูป.</figcaption>
                            </figure>

                        </div>
                        <div class="card-footer text-center">
                            <input type="submit" name="submit" class="btn btn-success" value="Register">
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
     <script>
        function readURL(input){
            var reader = new FileReader();

            reader.onload = function(e){
                console.log(e.target.result)
                $('#imgUpload').attr('src', e.target.result).width(300)

            }

            reader.readAsDataURL(input.files[0]);
        }
     </script>

</body>
</html>