<?php session_start(); 
include_once('admin_lock.php');
include_once('connect.php');
?>

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



    <?php include 'navbar.php';?><br>
<div class="container">
<div class="row">
<form action="" method="GET" enctype="multipart/form-data">
    <div class="input-group mb-3">
      <input name="txtKeyword" type="text" id="txtKeyword" class="form-control" placeholder="ค้นหาด้วย UserID"  aria-describedby="button-addon2">
      <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">ค้นหา</button>
      </div>
    </div>
</div>
</div>
</form>





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
      <th scope="col">สถานะ</th>
      <th scope="col"></th>
      <th scope="col"></th>

    </tr>
  </thead>
  <tbody>

   


 
<?php
if(isset($_GET["txtKeyword"])){
if ($_GET["txtKeyword"] != "")
{
  $sql = "SELECT * FROM history WHERE UserID = '".$_GET['txtKeyword']."' AND type = 'deposit' ORDER BY TransactionID";

}else{
  $sql = "SELECT * FROM history WHERE type = 'deposit' ORDER BY TransactionID";
}
}else{
  $sql = "SELECT * FROM history WHERE type = 'deposit' ORDER BY TransactionID";
}


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
        <td><?php echo $row["deposit_date"];?></td>
        <td><?php echo $row["Bank"];?></td>
        <td><?php echo $row["deposit_status"];?></td>
        <td><a href="admin_editdeposit.php?u_id=<?php echo $row['UserID']; ?>&t_id=<?php echo $row['TransactionID']; ?> ">
        <input type="button" name="submit" class="btn btn-success" value="แก้ไข" ></a></td>
        <td><a href="admin_ddeposit.php?u_id=<?php echo $row['UserID']; ?>&t_id=<?php echo $row['TransactionID']; ?> ?>" onClick="javascript:return confirm('คุณต้องการลบข้อมูลใช่หรือไม่');">
        <input type="button" name="submit" class="btn btn-danger" value="ลบ" ></a></td>
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


<?php 
//5. close connection
mysqli_close($conn); ?>


    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
</body>
</html>