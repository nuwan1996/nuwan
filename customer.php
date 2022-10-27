<?php 
include 'conn.php'; 
$sql = "SELECT * FROM customer";
$res = mysqli_query($conn, $sql);
$code = 'C' . $res->num_rows+1;

if (isset($_POST['submit'])) {
    $customer_name = $_POST['name'];
    $address = $_POST['address'];
    $mobile = $_POST['tel'];
    $sql = "INSERT INTO customer (name, code, add, contact) VALUES ('$customer_name', '$code', '$address', '$mobile')";
    $res = mysqli_query($conn, $sql);
}






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php $page = "Dashboard"; include 'header.php'; ?>
</head>
<body>
<?php include 'sidemenu.php'; ?>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-8">
        <div class="card card-plain">
            <div class="card-header">
                <h4 class="font-weight-bolder">Customer Registration</h4>
                <p class="mb-0">Enter the details of the customer to register</p></div>
                <div class="card-body">
                    <form action="customer.php" method="POST">

                        <label class="form-label">Customer Name</label>
                        <div class="input-group input-group-outline mb-3">
                            <input type="text" class="form-control" required name='name'>
                        </div>

                        <label class="form-label">Customer Code</label>
                        <div class="input-group input-group-outline mb-3">
                            <input type="text" class="form-control" required name='code' value='<?php echo $code;?>' disabled>
                        </div>

                        <label class="form-label">Customer Address</label>
                        <div class="input-group input-group-outline mb-3">
                            <input type="text" class="form-control" required name='address'>
                        </div>

                        <label class="form-label">Customer Contact</label>
                        <div class="input-group input-group-outline mb-3">
                            <input type="text" class="form-control" required name='tel' pattern="([0-9]).{9}">
                        </div>

                        <button type="submit" value="submit" name="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Register</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include 'js.php'; ?>
</body>
</html>