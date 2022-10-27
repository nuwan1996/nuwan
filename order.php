<?php 
include 'conn.php'; 

function getPrice($pro, $conn){
  $data = mysqli_query($conn, "SELECT * FROM product");
  $product = array();
  $prod_price = array();
  while ($row = mysqli_fetch_array($data)) {
      array_push($product, $row["name"]);
      array_push($prod_price, $row["price"]);
  }
  for($i=0; $i < count($product); $i++){
    if ($product[$i] == $pro){
      return ($prod_price[$i]);
    }
  }
}

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
  $customer1 = $cus[0];
}

if (isset($_POST['products'])) {
  $product_name = $_POST['products'];
  $price = getPrice($_POST['products'], $conn);
  $qts = $_POST['qty'];
  $amounts = $price * $qts;
  // if (!$result->num_rows > 0) {
      $sql = "INSERT INTO orderitems (ordercode, product, price, qty, amount)
              VALUES ('$code', '$product_name', '$price', '$qts', $amounts)";
      $result = mysqli_query($conn, $sql);
      if ($result) {
          // echo "<script>alert('Wow! Product Registration Completed.')</script>";
          $_POST = array();
      } else {
          echo "<script>alert('Woops! Something Wrong Went.')</script>";
      }
  // } else {
  //     echo "<script>alert('Woops! Product Already Exists.')</script>";
  // }
}

if (isset($_GET['get_submit'])) {
  $sql = "UPDATE orders SET status=2 WHERE ordercode='$code'";
  $result = mysqli_query($conn, $sql);
  if ($result){
    $_GET = array();
    header('location: createorder.php');
  }else {
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

// $order_no = "PO0001"; 
$data = mysqli_query($conn, "SELECT * FROM orderitems WHERE ordercode=".$code);
$item = array();
$quatity = array();
$price = array();
$amount = array();
while ($row = mysqli_fetch_array($data)) {
    array_push($item, $row["product"]);
    array_push($quatity, $row["qty"]);
    array_push($amount, $row["amount"]);
    array_push($price, $row["price"]);
}

$data = mysqli_query($conn, "SELECT * FROM product");
$product = array();
$prod_price = array();
while ($row = mysqli_fetch_array($data)) {
    array_push($product, $row["name"]);
    array_push($prod_price, $row["price"]);
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
        
                          <div class="row">
                            <div class="col-md-6">
                              <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Product</label>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Quantity</label>
                              </div>
                            </div>
                          </div>
                          <br>
                          <form action="order.php" method="post">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="input-group input-group-outline mb-3">
                                <select class="form-control" id="product01" name="products">
                                <?php foreach ($product as $product) {?>
                                    <!-- {{-- <option value="{{ $product -> $Product }}">{{ $product -> $Product }}</option> --}} -->
                                    <option value="<?php echo $product; ?>"><?php echo $product; ?></option>
                                    <?php } ?>
                                  </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="input-group input-group-outline mb-3">
                                <input type="number" class="form-control" id="qty" name='qty' require>
                              </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6">
                            <button class="btn bg-gradient-info w-100 mb-0 toast-btn" type="submit" data-target="infoToast" name="submit">Add</button>
                            </div>
                          </div></form>
                          </div>
                          <form role="form" method="GET" action="order.php">
          
          
          <div class="container-fluid py-4">
            <div class="row">
              <div class="col-12">
                <div class="card my-4">
                  <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                      <h6 class="text-white text-capitalize ps-3">Products</h6>
                    </div>
                  </div>
                  <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                      <table class="table align-items-center mb-0" id="ordertable">
                        <thead>
                          <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quantity</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount</th>
                            
                          </tr>
                        
                        <tbody>
                        <?php for ($i = 0; $i < count($item); $i++) {?>
                          <tr>
                            <th><?php echo $item[$i]; ?></th>
                            <th><?php echo $price[$i]; ?></th>
                            <th><?php echo $quatity[$i]; ?></th>
                            <th><?php echo $amount[$i]; ?></th>
                          </tr>
                          <?php } ?>
                        </tbody></thead>
                        </table></div></div></div></div></div></div>

                <div class="text-center">
                  <button name="get_submit" type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Order</button>
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