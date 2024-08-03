<?php
include('./includes/connect.php');
include('./function/common_function.php');
@session_start();
?>
<?php
$include_container = defined('INCLUDE_CONTAINER') ? INCLUDE_CONTAINER : true;
?>

<?php if ($include_container): ?>
<div class="container">
    <div class="row justify-content-center">
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User login</title>
    <link rel="stylesheet" href="./style.css">
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


    <!-- search bar -->

 

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8" style="margin-left:-30px !important;">
            <div class="card " style="width: 50rem; margin-left:-10px !important; transition: none !important; border:none; box-shadow:none !important">
                    <div class="card-body text-center font1">
                        <h5 class="card-title">LOGIN</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Please log in using your username if you have an account<hr></h6>
                        <form action="" method="post">
                            <!-- Username -->
                            <div class="form-outline mb-4 w-50 m-auto">
                                <label for="user_name" class="form-label" style="margin-left:-300px !important;">Username<sup style="color:red"> *</sup></label>
                                <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter your username" autocomplete="off" required="required">
                            </div>
                            <!-- Password -->
                            <div class="form-outline mb-4 w-50 m-auto">
                                <label for="user_password" class="form-label" style="margin-left:-300px !important;">Password<sup style="color:red"> *</sup></label>
                                <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Password" autocomplete="off" required="required">
                            </div>
                        
                            
                            
                            <input type="submit" value="Login" class="btn border-black bg-dark ms-3" name="user_login" style='color:white;width:300px;'>
                            <!-- <a href="checkout.php" class="btn border-black bg-dark ms-3" style='color:white;width:300px;'>Login</a> -->
                            <p class="font1 mt-2" style="font-size: 15px;">Doesn't have an account yet? <a href="user_registration.php">Register now</a></p>
    
                            </form>  
                    </div>
                        
                        
                </div>
                     
            </div>
            <?php if ($include_container): ?>
    </div>
</div>
<?php endif; ?>
            
            

    <!-- remove -->
    <?php
     function remove_cart_item(){
        global $con;
        if(isset($_POST['remove_cart']) && isset($_POST['removeitem'])){
            foreach($_POST['removeitem'] as $remove_id){
                echo $remove_id;
                $delete_query="Delete from `cart_details` where product_id=$remove_id";
                $run_delete=mysqli_query($con, $delete_query);
                if($run_delete){
                    echo "<script>window.open('./cart.php','_self')</script>";
                }
            }
        }
     }
     echo $remove_item= remove_cart_item();
     ?>
    
    <!-- main functions -->
        <?php 
        $ip = getIPAddress();  
        // echo 'User Real IP Address - '.$ip;
        
        ?>
          

          
    <!-- call cart -->
    <?php cart(); 
    ?>
  <!-- Footer -->
  <div class="bg-white p-1 text-center font1 fixed-bottom">
    <p>Test for Konnco Studio 29 July. Giri Shaffaat Al</p>
  </div>

  <script src="./script.js"></script>
  <!-- Fontawesome link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Bootstrap JS link   -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

<?php if(isset($_POST['user_login'])){
    $user_username=$_POST['user_name'];
    $user_password=$_POST['user_password'];

    $select_query="Select * from `user_table` where user_name='$user_username'";
    $result=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);
    $user_id=$row_data['user_id'];
    if ($row_count>0){
        $_SESSION['username']=$user_username;
    
        if(password_verify($user_password, $row_data['user_password'])){
            
            echo "<script>alert('Login successful')</script>";
            
            echo "<script>window.open('cart.php','_self')</script>";
            
        }else{
            echo "<script>alert('Invalid credentials')</script>";
        }
    }else{
        echo "<script>alert('Invalid credentials')</script>";
    }

}
?>

</html>