<?php session_start(); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <?php

        include_once('connect.php');


            

        
        
    ?>




    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto mt-5">
                <div class="card">
                <form action="" method="POST">
                    <div class="card-header text-center">
                        Login to your Account!!!
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="username" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="username" name="username" placeholder="email@kmitl.ac.th" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
                            </div>
                        </div>
                        <?php
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $conn->real_escape_string($_POST['password']);

            
            
            $pattern = '/^[0-9a-zA-Z-@._]{4,32}$/i';
            $patternpass = '/^[0-9a-zA-Z\W]{8,}$/i';
            if(preg_match($pattern, $username)){
                if(preg_match($patternpass, $password)){
                    $sql = "SELECT * FROM `user` WHERE `Email` = '".$username."' AND (`Password` = MD5('".$password."') OR `Password` = '".$password."')";
                    $result = $conn->query($sql);

                    if($result->num_rows > 0){
                        $row = $result->fetch_assoc();
                        $_SESSION['id'] = $row['UserID'];
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['Balance'] = $row['Balance'];
                        $_SESSION['admin'] = $row['admin'];
                        header('location:index.php');
                    }else{
                        echo 'Username or password is invalid';

                    }
                }else{
                    echo '<font color="red">Password ต้องมี 8 ตัวขึ้นไป และต้องเป็นตัวอักษรภาษาอังกฤษ, ตัวเลข, อักขระพิเศษ</font>';
                }
            }else{
                echo '<font color="red">E-mail ต้องมีระหว่าง 4 - 32 ตัว และต้องเป็นตัวอักษรภาษาอังกฤษ, ตัวเลข, อักขระพิเศษได้เฉพาะ - @ . _</font>';
            }

            
            
        }
            ?>
                    </div>
                        <div class="card-footer text-center">
                            <input type="submit" name="submit" class="btn btn-success" value="Login">
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