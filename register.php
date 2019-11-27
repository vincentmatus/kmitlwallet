<?php session_start();
include_once('admin_lock.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>เพิ่มสมาชิก</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar.php';?>
    <?php

        include_once('connect.php');

        if(isset($_POST['submit'])){

            $temp = explode('.',$_FILES['fileUpload']['name']);
            $newName = round(microtime(true)).'.'. end($temp);
            if(move_uploaded_file($_FILES['fileUpload']['tmp_name'], './uploads/profiles/'.$newName)){

                $sql = "INSERT INTO `user`(`UserID`, `Email`, `Password`, `name`, `surname`, `Tel.Number`,`Birthday`, `PictureAccount`)
                VALUES ('".$_POST['userid']."', '".$_POST['email']."', MD5('".$_POST['password']."'), '".$_POST['name']."', '".$_POST['surname']."', '".$_POST['telnumber']."', '".$_POST['birthday']."', '".$newName."');";
                $result = $conn->query($sql);

                if($result){
                    echo '<script> alert("Register Completed!") </script>';
                    
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
                            เพิ่มสมาชิก
                        </div>
                        <div class="card-body">
                        <div class="form-group row">
                            <label for="firstname" class="col-sm-3 col-form-label">Userid</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="userid" name="userid" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lastname" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">Surname</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="surname" name="surname" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">Tel.</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="telnumber" name="telnumber" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">Birthday</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="birthday" name="birthday" required>
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