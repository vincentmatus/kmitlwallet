<?php session_start(); 
include_once('user_lock.php');
include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ประวัติการทำรายการ</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>




    <?php include 'navbar.php';?>
    <br>
    
    
 

    <div class="container">
      
      <div class="row ">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" >
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">รับ</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#menu1" role="tab" aria-controls="profile" aria-selected="false">โอน</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#menu2" role="tab" aria-controls="contact" aria-selected="false">เติมเงินผ่านธนาคาร</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#menu3" role="tab" aria-controls="contact" aria-selected="false">บัตรเติมเงิน</a>
  </li>
</ul>

     
  </div> 



  <div class="row ">
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active show active">
      
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">UserID</th>
      <th scope="col">TransactionID</th>
      <th scope="col">type</th>
      <th scope="col">จำนวน</th>
      <th scope="col">วันเวลาที่โอน</th>
      <th scope="col">เลขบัญชีที่โอน</th>

    </tr>
  </thead>
  <tbody>

<?php
  $sql = "SELECT * FROM history WHERE UserID = '".$_SESSION['id']."' AND type = 'receive'  ORDER BY Date asc";

$result = $conn->query($sql);
$i = 1;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        ?>
        <tr>
        <th scope="row"><?php echo $i ?></th>
        <td><?php echo $row["UserID"];?></td>
        <td><?php echo $row["TransactionID"];?></td>
        <td><?php echo $row["type"];?></td>
        <td><?php echo $row["amount"];?></td>
        <td><?php echo $row["Date"];?></td>
        <td><?php echo $row["Account"];?></td>
      </tr>
<?php
  $i++;  
  }
} else {
    echo "0 results";
}
?>
</tbody>
</table>

    </div>
    <div id="menu1" class="tab-pane fade">
      
    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">UserID</th>
      <th scope="col">TransactionID</th>
      <th scope="col">type</th>
      <th scope="col">วันเวลาที่โอน</th>
      <th scope="col">จำนวน</th>
      <th scope="col">เลขบัญชีที่โอน</th>
      <th scope="col">บันทึกช่วยจำ</th>
    </tr>
  </thead>
  <tbody>

<?php
  $sql = "SELECT * FROM history WHERE UserID = '".$_SESSION['id']."' AND type = 'transfer'  ORDER BY Date asc";

$result = $conn->query($sql);
$i = 1;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        ?>
        <tr>
        <th scope="row"><?php echo $i ?></th>
        <td><?php echo $row["UserID"];?></td>
        <td><?php echo $row["TransactionID"];?></td>
        <td><?php echo $row["type"];?></td>
        <td><?php echo $row["Date"];?></td>
        <td><?php echo $row["amount"];?></td>
        <td><?php echo $row["Account"];?></td>
        <td><?php echo $row["remind"];?></td>
      </tr>
<?php
  $i++;  
  }
} else {
    echo "0 results";
}
?>
</tbody>
</table>

    </div>
    <div id="menu2" class="tab-pane fade">
    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">UserID</th>
      <th scope="col">TransactionID</th>
      <th scope="col">type</th>
      <th scope="col">วันเวลาที่โอน</th>
      <th scope="col">จำนวน</th>
      <th scope="col">เลขบัญชีที่โอน</th>
      <th scope="col">สถานะการเติมเงิน</th>
    </tr>
  </thead>
  <tbody>

<?php
  $sql = "SELECT * FROM history WHERE UserID = '".$_SESSION['id']."' AND type = 'deposit'  ORDER BY Date asc";

$result = $conn->query($sql);
$i = 1;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        ?>
        <tr>
        <th scope="row"><?php echo $i ?></th>
        <td><?php echo $row["UserID"];?></td>
        <td><?php echo $row["TransactionID"];?></td>
        <td><?php echo $row["type"];?></td>
        <td><?php echo $row["deposit_date"];?></td>
        <td><?php echo $row["amount"];?></td>
        <td><?php echo $row["Bank"];?></td>
        <?php if($row["deposit_status"]==0){ ?>
          <td> "กำลังดำเนินการ"  </td>
        <?php }elseif($row["deposit_status"]==1){ ?>
          <td> "เสร็จสิ้น" </td> 
        <?php }else{ ?>
          "<td>"ผิดพลาดโปรดติดต่อแอดมิน"</td> "
        <?php } ?>    
      </tr>
<?php
  $i++;  
  }
} else {
    echo "0 results";
}
?>
</tbody>
</table>
      </div>
    <div id="menu3" class="tab-pane fade">
    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">UserID</th>
      <th scope="col">TransactionID</th>
      <th scope="col">type</th>
      <th scope="col">วันเวลาที่เติม</th>
      <th scope="col">จำนวน</th>
      <th scope="col">รหัสบัตร</th>
      
    </tr>
  </thead>
  <tbody>

<?php
  $sql = "SELECT * FROM history WHERE UserID = '".$_SESSION['id']."' AND type = 'topup'  ORDER BY Date asc";

$result = $conn->query($sql);
$i = 1;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        ?>
        <tr>
        <th scope="row"><?php echo $i ?></th>
        <td><?php echo $row["UserID"];?></td>
        <td><?php echo $row["TransactionID"];?></td>
        <td><?php echo $row["type"];?></td>
        <td><?php echo $row["Date"];?></td>
        <td><?php echo $row["amount"];?></td>
        <td><?php echo $row["TopUp"];?></td>
         
      </tr>
<?php
  $i++;  
  }
} else {
    echo "0 results";
}
?>
</tbody>
</table>
    </div>
  </div>


      </div>

    </div>
<?php 
//5. close connection
mysqli_close($conn); ?>


    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
</body>
</html>