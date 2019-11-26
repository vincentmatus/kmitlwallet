<?php if (isset($_SESSION['id'])) { 
                        include_once('connect.php');
                        $sql = "SELECT * FROM `user` WHERE `UserID` = '".$_SESSION['id']."'";
                        $result = $conn->query($sql);

                        if($result->num_rows > 0){
                            $row = $result->fetch_assoc();
                            $_SESSION['Balance'] = $row['Balance'];
                        }
}?>
    <meta charset="UTF-8">
    <nav class="navbar navbar-expand-lg navbar-light  " style="background-color: #CD3700;">
        <div class="container">
            <a class="navbar-brand" href="index.php">
            <img src="./uploads/index/logo_kmitlwallet.png" width="30" height="30" class="d-inline-block align-top" alt="">
            <font color="white"> KMITL </font></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
  
                    <?php if (isset($_SESSION['id'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="pay.php"><font color="white"> โอนเงิน </font></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="showhistory.php"><font color="white"> History</font></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="favorite.php"><font color="white"> รายการโปรด</font></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="deposit.php"><font color="white"> เติมเงิน</font></a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="get_coupon.php">สร้างบัตรเติมเงิน</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="card.php">บัตรเติมเงิน</a>
                       
                    </li>
                    <li class="nav-item">
                        
                        <a class="nav-link" href="register.php">เพิ่มสมาชิก</a>
                    </li> -->
                    
                    <?php } ?>
                </ul>
                
                <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['id'])) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <font color="white"> ยินดีต้อนรับ คุณ <?php echo $_SESSION['name']; ?> ยอดเงินคงเหลือ <?php echo $_SESSION['Balance']; ?> บาท</font>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php if ($_SESSION['admin']==1){ ?>
                        
                        <a class="dropdown-item" href="admin_showusers.php">ตรวจสอบผู้ใช้</a>
                        <a class="dropdown-item" href="admin_showdeposit.php">ตรวจสอบการเติมเงิน</a>
                        <a class="dropdown-item" href="get_coupon.php">สร้างบัตรเติมเงิน</a>

                        <?php } ?>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                        </div>
                    </li>
                    <?php } else { ?>
                    <li class="nav-item">
                        
                        <a class="btn btn-outline-light" href="login.php">Login</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>  
    </nav>