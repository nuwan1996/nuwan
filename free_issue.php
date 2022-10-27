<?php 
include 'conn.php'; 

if (isset($_POST['submit'])) {
  $label = $_POST['label'];
  $type = $_POST['type'];
  $purchase = $_POST['purchase'];
  $purchase_qty = $_POST['purchase_qty'];
  $free_qty = $_POST['free_qty'];
  $lower = $_POST['lower'];
  $upper = $_POST['upper'];
  
  $sql = "SELECT * FROM freeissue WHERE id=0";
  $result = mysqli_query($conn, $sql);
  if (!$result->num_rows > 0) {
      $sql = "INSERT INTO freeissue (label, type, product, qty, freeqty, lower, upper) VALUES ('$label', '$type', '$purchase', '$purchase_qty', '$free_qty', '$lower', '$upper')";
      $result = mysqli_query($conn, $sql);
      if ($result) {
          echo "<script>alert('Wow! Product Added.')</script>";
      } else {
          echo "<script>alert('Woops! Something Wrong Went.')</script>";
      }
  } else {
      echo "<script>alert('Woops! Product Already Exists.')</script>";
  }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
    $page = "Free Issues";
    include 'header.php';
    ?>
</head>
<body>
<?php 
include 'sidemenu.php'; 

$data = mysqli_query($conn, "SELECT * FROM product");
$product = array();
while ($row = mysqli_fetch_array($data)) {
    array_push($product, $row["name"]);
}
?>
<script>
    function change() {
      document.getElementById("freeproduct").innerHTML = document.getElementById("purchase").value;
    }
    
</script>

<div class="row">
<div class="col-md-3"></div>
<div class="col-md-8">
    <div class="card card-plain">
      <div class="card-header">
        <h4 class="font-weight-bolder">Free Issues</h4>
      </div>
      <div class="card-body">
        <form role="form" action="free_issue.php" method="POST">
          <div class="input-group input-group-outline mb-3">
            <label class="form-label">Free Issue Label</label>
            <input type="text" class="form-control" name="label" required>
          </div>
          <label class="form-label">Type</label>
          <div class="input-group input-group-outline mb-3">
            <select class="form-control" name="type" required>
              <option value="0" selected="selected" disabled="disabled">Select Type</option>
              <option value="flat">Flat</option>
              <option value="multiple">Multiple</option></select>
          </div>
          <label class="form-label">Purchase Product</label>
          <div class="input-group input-group-outline mb-3">
            <select class="form-label" name="purchase" required id="purchase" onchange="change()">
              <option value="0" selected="selected" disabled="disabled">Select Product</option>
              <?php foreach ($product as $product) { ?>
                  <option value="<?php echo $product; ?>"><?php echo $product; ?></option>
                  <?php } ?>
              </select>
          </div>
          <label class="form-label" id="hi">Free Product :</label>
          <label class="form-label" id="freeproduct" ></label>
          <div class="input-group input-group-outline mb-3">
            <label class="form-label">Purchase Quantity</label>
            <input type="number" class="form-control" name="purchase_qty" required>
          </div>
          <div class="input-group input-group-outline mb-3">
            <label class="form-label">Free Quantity</label>
            <input type="number" class="form-control" name="free_qty" required>
          </div>
          <div class="input-group input-group-outline mb-3">
            <label class="form-label">Lower Limit</label>
            <input type="number" class="form-control" name="lower" required>
          </div>
          <div class="input-group input-group-outline mb-3">
            <label class="form-label">Upper Limit</label>
            <input type="number" class="form-control" name="upper" required>
          </div>
          <div class="text-center">
            <button type="submit" value="submit" name="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>


<?php include 'js.php'; ?>
</body>
</html>