<?php 

include 'conn.php'; 
if (isset($_POST['submit'])) {
    $s = "SELECT * FROM customer";
    $r = mysqli_query($conn, $s);
    $code = 'C' . $r->num_rows+1;
    $name = $_POST['name'];
    $add = $_POST['add'];
    $contact = $_POST['contact'];
    // try {
    $sql = "SELECT * FROM customer WHERE name='$name'";
    $result = mysqli_query($conn, $sql);
    // if (!$result->num_rows > 0) {
        $sql = "INSERT INTO customer (name, code, add, contact) VALUES ('$name', '$code', '$add', '$contact')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>alert('Wow! Customer Registration Completed.')</script>";
        } else {
            echo "<script>alert('Woops! Something Wrong Went.')</script>";
        }
    // } else {
    //     echo "<script>alert('Woops! Customer Already Exists.')</script>";
    // }
// } catch (mysqli_sql_exception $e) { 
//     var_dump($e);
//     exit; 
//  } 
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
    $page = "Add Customer";
    include 'header.php';
    ?>
</head>
<body>
<?php include 'sidemenu.php'; ?>


<?php 
$s = "SELECT * FROM customer";
$r = mysqli_query($conn, $s);
$code = 'C' . $r->num_rows+1;
?>


<div class="row">
<div class="col-md-3"></div>
<div class="col-md-8">
    <div class="card card-plain">
      <div class="card-header">
        <h4 class="font-weight-bolder">Customer Registration</h4>
        <p class="mb-0">Enter the details of the customer to register</p>
      </div>
      <div class="card-body">
        <form action="add_customer.php" method="POST" class="form-control">
          <div class="input-group input-group-outline mb-3">
            <label class="form-label">Customer Name</label>
            <input type="text" class="form-control" required name='name'>
          </div>
          <label class="form-label">Customer Code</label>
          <div class="input-group input-group-outline mb-3">
            
            <input type="text" class="form-control" required value="<?php echo $code; ?>" disabled>
          </div>
          <div class="input-group input-group-outline mb-3">
            <label class="form-label">Customer Address</label>
            <input type="text" class="form-control" required name='add'>
          </div>
          <div class="input-group input-group-outline mb-3">
            <label class="form-label">Customer Contact</label>
            <input type="text" class="form-control" required pattern="([0-9]).{9}" name='contact'>
          </div>
          <div class="text-center">
            <button type="submit" value="submit" name="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Register</button>
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