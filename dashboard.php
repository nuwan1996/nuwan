<?php 
include 'conn.php'; 
$s = "SELECT * FROM orders WHERE status=1";
$r = mysqli_query($conn, $s);
if ($r->num_rows > 0){
  $rem_order = array();
  $cus = array();
  while ($row = mysqli_fetch_array($r)) {
    array_push($rem_order, $row["ordercode"]);
    array_push($cus, $row["customer"]);
  } 
  $code = $rem_order[0];
  $customer = $cus[0];
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
    $page = "Dashboard";
    include 'header.php';
    ?>
</head>
<body>
<?php
include 'sidemenu.php';

$sql = "SELECT * FROM product";
$result = mysqli_query($conn, $sql);
//var_dump($result);

echo $code;
echo $customer;
?>



<?php
include 'js.php';
?>
</body>
</html>