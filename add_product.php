<?php include 'conn.php'; ?>

<?php  
if (isset($_POST['submit'])) {
    $s = "SELECT * FROM product";
    $r = mysqli_query($conn, $s);
    $code = 'P' . $r->num_rows+1;
    $product_name = $_POST['product'];
    $price = $_POST['price'];
    $date = $_POST['date'];
    $sql = "SELECT * FROM product WHERE name='$product_name'";
    $result = mysqli_query($conn, $sql);
    if (!$result->num_rows > 0) {
        $sql = "INSERT INTO product (code, name, price, expire)
                VALUES ('$code', '$product_name', '$price', '$date')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>alert('Wow! Product Registration Completed.')</script>";
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
    $page = "Add Product";
    include 'header.php';
    ?>
</head>
<body>
<?php
include 'sidemenu.php';

$s = "SELECT * FROM product";
$r = mysqli_query($conn, $s);
$code = 'P' . $r->num_rows+1;

?>








<div class="row">
<div class="col-md-3"></div>
<div class="col-md-8">
    <div class="card card-plain">
      <div class="card-header">
        <h4 class="font-weight-bolder">Product Registration</h4>
        <p class="mb-0">Enter the details of the product to register</p>
      </div>
      <div class="card-body">
        <form action="add_product.php" method="POST" class="form-control">
          <div class="input-group input-group-outline mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" class="form-control" name="product" required>
          </div>
          <label>Product Code</label>
          <div class="input-group input-group-outline mb-3">
            <input type="text" class="form-control" name="product_code" value="<?php echo $code; ?>" disabled>
          </div>
          <div class="input-group input-group-outline mb-3">
            <label class="form-label">Price</label>
            <input type="number" class="form-control" name="price" required>
          </div>
          <div><label for="Expiry">Expiry Date</label></div>
          <div class="input-group input-group-outline mb-3">
            <label class="form-label"></label>
            <input type="date" class="form-control" name="date" required>
          </div>
          
          <div class="text-center">
            <button type="submit" value="submit" name="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">ADD</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<?php
include 'js.php';
?>
</body>
</html>