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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
        
            <a class="navbar-brand" href="index.php">KMITL</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
  
                    <?php if (isset($_SESSION['id'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="pay.php">โอนเงิน</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="showhistory.php">History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="favorite.php">รายการโปรด</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="deposit.php">เติมเงิน</a>
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
                        ยินดีต้อนรับ คุณ <?php echo $_SESSION['name']; ?> ยอดเงินคงเหลือ <?php echo $_SESSION['Balance']; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                        </div>
                    </li>
                    <?php } else { ?>
                    <li class="nav-item">
                        
                        <a class="btn btn-primary" href="login.php">Login</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>  
    </nav>