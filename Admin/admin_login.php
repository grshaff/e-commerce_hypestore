<?php
include('../includes/connect.php');
include('../function/common_function.php');
session_start();

?>
<?php
$include_container = defined('INCLUDE_CONTAINER') ? INCLUDE_CONTAINER : true;
?>

<!DOCTYPE html>
<html lang="en">
<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>
<body class="bg-body-tertiary ">

<?php if ($include_container): ?>
<div class="container">
    <div class="row justify-content-center">
<?php endif; ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8" style="margin-left:-30px !important; margin-top:180px !important;">
                <div class="card " style="width: 50rem; margin-left:-10px !important; transition: none !important; border:none; box-shadow:none !important">
                    <div class="card-body text-center font1">
                        <h5 class="card-title font">HYPESTORE</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><hr></h6>
                        <form action="" method="post">
                            <!-- Username -->
                            <div class="form-outline mb-4 w-50 m-auto">
                                <label for="username" class="form-label" style="margin-left:-300px !important;">Account<sup style="color:red"> *</sup></label>
                                <input type="text" name="username" id="username" class="form-control" autocomplete="off" required="required">
                            </div>
                            <!-- Password -->
                            <div class="form-outline mb-4 w-50 m-auto">
                                <label for="password" class="form-label" style="margin-left:-300px !important;">Password<sup style="color:red"> *</sup></label>
                                <input type="password" name="password" id="password" class="form-control" autocomplete="off" required="required">
                            </div>
                            <input type="submit" value="Login" class="btn border-black bg-dark ms-3" name="admin_login" style='color:white;width:300px;'>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php if ($include_container): ?>
    </div>
</div>
<?php endif; ?>

  <!-- Footer -->
  <div class="bg-white p-1 text-center font1 fixed-bottom">
    <p>Test for Konnco Studio 29 July. Giri Shaffaat Al</p>
  </div>

  <script src="./script.js"></script>
  <!-- Fontawesome link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Bootstrap JS link   -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
<?php
if(isset($_POST['admin_login'])){
    $admin_username = $_POST['username'];
    $admin_password = $_POST['password'];

    $select_query = "SELECT * FROM `admin` WHERE username='$admin_username'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);
    $admin_id = $row_data['admin_id'];
    
    
    if ($row_count > 0) {
        $_SESSION['username'] = $admin_username;
        if(($admin_username==$row_data['username'] && $admin_password==$row_data['password'])){
            echo "<script>alert('Login successful')</script>";
            echo "<script>window.open('./index.php','_self')</script>";
        } else {
            echo "<script>alert('Invalid credentials')</script>";
        }
    } else {
        echo "<script>alert('Invalid credentials')</script>";
    }
}
?>

</body>
</html>