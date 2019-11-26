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
      <th scope="col">Email</th>
      <th scope="col">Name</th>
      <th scope="col">Surname</th>
      <th scope="col">Balance</th>
      <th scope="col"></th>
      <th scope="col"></th>

    </tr>
  </thead>
  <tbody>

   


 
<?php
if(isset($_GET["txtKeyword"])){
if ($_GET["txtKeyword"] != "")
{
  $sql = "SELECT * FROM user WHERE UserID = '".$_GET['txtKeyword']."' ORDER BY UserID";

}else{
  $sql = "SELECT * FROM user ORDER BY UserID";
}
}else{
  $sql = "SELECT * FROM user ORDER BY UserID";
}


$result = $conn->query($sql);
$i = 1;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        ?>
        <tr>
        <th scope="row"><?php echo $i ?></th>
        <td><?php echo $row["UserID"];?></td>
        <td><?php echo $row["Email"];?></td>
        <td><?php echo $row["name"];?></td>
        <td><?php echo $row["surname"];?></td>
        <td><?php echo $row["Balance"];?></td>
        <td><a href="admin_edituser.php?u_id=<?php echo $row['UserID']; ?>">
        <input type="button" name="submit" class="btn btn-success" value="แก้ไข" ></a></td>
        <td><a href="admin_duser.php?u_id=<?php echo $row['UserID']; ?>" onClick="javascript:return confirm('คุณต้องการลบข้อมูลใช่หรือไม่');">
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