<?php 
include 'conn.php'; 

if (isset($_POST['submit'])) {
  $s = "SELECT * FROM orders";
  $r = mysqli_query($conn, $s);
  $code = $r->num_rows+1;
  $customer_name = $_POST['cutomer'];
  $status = 1;
      $sql = "INSERT INTO orders (ordercode, customer, status)
              VALUES ('$code', '$product_name', '$status')";
      $result = mysqli_query($conn, $sql);
      if ($result) {
          // echo "<script>alert('Wow! Product Registration Completed.')</script>";
          header('location: order.php');
      } else {
          echo "<script>alert('Woops! Something Wrong Went.')</script>";
      }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
    $page = "Place Order";
    include 'header.php';
    ?>
</head>
<body>
<?php include 'sidemenu.php'; 
$s = "SELECT * FROM orders WHERE status=1";
$r = mysqli_query($conn, $s);
if ($r->num_rows > 0){
  $rem_order = array();
  while ($row = mysqli_fetch_array($r)) {
    array_push($rem_order, $row["code"]);
  } 
  $code = $rem_order[0];
  header('location: order.php');
}else{
  $countt = "SELECT * FROM orders";
  $res = mysqli_query($conn, $countt);
  $code = $res->num_rows+1;
}

$data2 = mysqli_query($conn, "SELECT * FROM customer");
$customer = array();
while ($row = mysqli_fetch_array($data2)) {
    array_push($customer, $row["name"]);
}
?>

<div class="row">
<div class="col-md-3"></div>
<div class="col-md-8">
    <div class="card card-plain">
      <div class="card-header">
        <h4 class="font-weight-bolder">Place Order</h4>
      </div>
      <div class="card-body">
        <form role="form" action="createorder.php" method="POST">
          <label class="form-label">Customer Name</label>
          <div class="input-group input-group-outline mb-3">
            <select class="form-control" name="cutomer" required>
            <option value="" selected="selected" disabled="disabled">Select a customer</option>
            <?php foreach ($customer as $customer) { ?>
            <option value="<?php echo $customer; ?>"><?php echo $customer; ?></option><?php } ?></select>
          </div>
          <label class="form-label">Order Number</label>
          <div class="input-group input-group-outline mb-3">
            <input type="text" class="form-control" disabled value="<?php echo $code; ?>">
          </div>
                <div class="text-center">
                  <button name="submit" value="submit" type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Create Order</button>
                </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<script type="text/javascript">
  function addFunction() {
    var table = document.getElementById("ordertable");
    var row = table.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    cell1.innerHTML = document.getElementById('product01').value;
    cell2.innerHTML = "<?php echo $price; ?>";
    cell3.innerHTML = document.getElementById('qty').value;
    cell4.innerHTML = parseInt(cell2) * parseInt(cell3);
  }
  </script>

<?php include 'js.php'; ?>
</body>
</html>