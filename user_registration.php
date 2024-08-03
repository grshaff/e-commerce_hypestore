<?php 
    // include('./includes/connect.php');
    include('./function/common_function.php');
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="../includes/connection.php">
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

</head>
<body class="bg-light font1">
        <!-- search bar -->
        <div class="container-fluid bg-white">
      <nav class="navbar navbar-expand-lg bg-white">
        <div class="container-fluid p-0 bg-white font1 " style="justify-content: center;">
          <a class="navbar-brand font mx-auto" href="index.php" style="font-size: 30px; text-align:center !important;">HYPESTORE</a>       
        </div>
      </nav>
    </div>
    <div class="container mt-3">
        <h1 class="text-center font1">Register</h1>
        <!-- form -->
         <form action="" method="post" enctype="multipart/form-data">
            <!-- name -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Username</label>
                <input type="text" name="user_username" id="user_username" class="form-control" placeholder="Enter Username" autocomplete="off" required="required">
            </div>
            <!-- email -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Email Address</label>
                <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Enter Email Address" autocomplete="off" required="required">
            </div>
            <!-- password -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Password" autocomplete="off" required="required" >
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="password_confirmation" class="form-label">Confirm password</label>
                <input type="password" name="user_password_confirmation" id="user_password_confirmation" class="form-control" placeholder="Confirm password" autocomplete="off" required="required" >
            </div>
            <!-- button -->
            <div class="form-outline mb-0 w-50 m-auto text-end">
                <a href="./index.php" type="button" name="cancel" class="btn border border-black m-2">Cancel</a>
                <input type="submit" name="user_register" class="btn border border-black" value="Register">
                
            </div>
            <div class="form-outline mb-2 w-50 m-auto text-end">
            <p class="font1 mt-0" style="font-size: 15px;">Already have an account? <a href="user_login.php">Login now</a></p>
            
            </div>
         </form>
    </div>
      
    <?php 
        if(isset($_POST['user_register'])){

        
            $username = $_POST['user_username'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];
            $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
            $user_password_conf = $_POST['user_password_confirmation'];
            $user_ip=getIPAddress();

            $select_query="Select * from `user_table` where user_name='$username' or user_email='$user_email'";
            $result=mysqli_query($con,$select_query);
            $rows_count=mysqli_num_rows($result);
            if($rows_count>0){
                echo "<script>alert('Username or email already exist')</script>";
            }
            elseif($user_password!=$user_password_conf){
                echo "<script>alert('Password does not match')</script>";
            }
            else{ 
            // insert query
            $insert_user="insert into `user_table` (user_name,user_email,user_password,user_ip) values ('$username','$user_email','$hash_password','$user_ip')";
            $sqli_execute=mysqli_query($con,$insert_user);
            if($sqli_execute){
                echo "<script>alert('Account successfully registered!')</script>";
                header("Location: ./user_login.php");
            }
            else{
                die(mysqli_error($con));
            }
            }
            
            $select_cart_items="Select * from `cart_details` where ip_address='$user_ip'";
            $result_cart=mysqli_query($con,$select_cart_items);
            $rows_count=mysqli_num_rows($result_cart);
            if($rows_count>0){
                $_SESSION['username']=$username;
                echo "<script>alert('You have items in your cart')</script>";
                echo "<script>window.open('./checkout.php','_self')</script>";
            }
            else{
                echo "<script>window.open('./index.php','_self')</script>";
            }

            }
        
        ?>



 <!-- Fontawesome link -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Bootstrap JS link   -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>