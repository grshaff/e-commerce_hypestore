<?php
include('includes/connect.php');
include('function/common_function.php');
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Cart</title>
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

    <!-- navbar atas -->
     <nav class="container-fluid">
        <div class="container-fluid p-0">
            <nav class="nav"></nav>
            <div class="d-flex flex-row-reverse" >
            <?php 
              
              if(!isset($_SESSION['username'])){
                echo "<a class='navbar-brand p-2 font1' href='user_login.php' >LOGIN</a>
                <a class='navbar-brand p-2 font1'>WELCOME GUEST</a>";
              }
              else{
                echo "<a class='navbar-brand p-2 font1 ' href='logout.php' >LOGOUT</a>
                <a class='navbar-brand p-2 font1'><u>WELCOME <span style='text-transform:uppercase;'>".$_SESSION['username']."</span></u></a>";
              }
                ?>
            </div>
        </div>
     </nav>
    <!-- search bar -->
    <div class="container-fluid bg-white">
      <nav class="navbar navbar-expand-lg bg-white">
        <div class="container-fluid p-0 bg-white " style="justify-content: center;">
          <a class="navbar-brand font mx-auto" href="index.php" style="font-size: 30px; text-align:center !important;">HYPESTORE</a>       
        </div>
      </nav>
    </div>
 
    <div class="container-fluid p-0 mt-4">
        <div class="row">
            <div class="col-sm" style="margin-left:40px !important;">
            <p style="color: gray; text-transform: uppercase; font-size:13px;" class="font1">
            <a href="index.php" class="navbar-brand">< Go back </a> </p>
            </div>
        </div>
    </div>
    <div class="container-fluid p-0 mt-0">
        <div class="row">
            <div class="col-sm" style="margin-left:40px !important;">
                <h2 class="font1">Shopping cart <span>(<?php cart_item();?>)</span></h2>
            </div>
        </div>
    </div>
    
    <?php
    $get_ip_add=getIPAddress();
    $select_query="Select * from `cart_details` where ip_address='$get_ip_add'";
    $result_query=mysqli_query($con,$select_query);
    $result_count=mysqli_num_rows($result_query);
    if($result_count>0){
    
    ?>
    <div class="container-fluid p-0 mt-3">
        <div class="row justify-content-center">
            <div class="col-sm-8" style="margin-left:-30px !important; border-radius: 8px !important; background:white;">
                <div class="table-responsive">
                    <table class="table text-center font1" >
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form method="post">
                            <?php 
                            global $con;
                            
                            $get_ip_add = getIPAddress(); 
                            $get_user="Select * from `user_table` where user_ip='$get_ip_add'" ;
                            $result_user=mysqli_query($con,$get_user);
                            $run_query=mysqli_fetch_array($result_user);
                            $user_id=$run_query['user_id'];
                            $total_price=0;
                            $select_query="Select * from `cart_details` where ip_address='$get_ip_add'";
                            $result_query=mysqli_query($con,$select_query);
                            while($row=mysqli_fetch_array($result_query)){
                            $product_id=$row['product_id'];
                            $select_products="Select * from `products` where product_id='$product_id'";
                            $result_product=mysqli_query($con,$select_products);           
                            while($row_product_price=mysqli_fetch_array($result_product)){
                                $price = str_replace('.', '', $row_product_price['product_price']);
                                $price = floatval($price);
                                $total_price+=$price;
                                $product_price=array($row_product_price['product_price']);
                                $price_table=$row_product_price['product_price'];
                                $product_title=$row_product_price['product_title'];
                                $brand_title=$row_product_price['brand_title'];
                                $product_image=$row_product_price['product_image1'];
                                $total_price_formatted = number_format($total_price, 0, ',', '.');
                                
                                                           
                            ?>

                            <tr>
                                <td style="width: 420px !important;">
                                    
                                        <div class="row justify-content-left d-flex">
                                            <div class="col-sm-1 col-md-3" style="margin-top: 50px !important; margin-left:-20px !important;">
                                                <input type="checkbox" name="removeitem[]" value="<?php echo $product_id;?>">
                                            </div>
                                            <div class="col-sm-3 ">
                                                <img style="width:150px; clip-path: inset(40px 15px 15px 10px); margin-top:-45px; margin-left:-60px !important;" src='./Admin/product_img/<?php echo $product_image;?>' >
                                            </div>
                                            <div class="col-sm-6 font1" style="text-align: left;  ">
                                                <br>
                                                <h5 class='card-title' style="font-size:15px;"><?php echo $brand_title; ?></h5>
                                                <p class='card-text font1' style="font-size:15px; margin-bottom:10px !important;"><?php echo $product_title;?></p>
                                        
                                                
                                                
                                                
                                            </div>
                                        </div>
                                        
                                
                                </td>
                                
                                <td style="width: 150px !important;">Rp. <?php echo $price_table;?></td>
                                <td style="width: 40px !important;">
                                    <div class="container">
                                        <p style="width:100%; text-align:center" id="qty_input">1</p>
                                    </div>
                                
                            
                                </td>
                                
                                <td style="width: 150px !important;">Rp. <?php echo $price_table;?>
                            </td>

                            </tr>
                            
                            <?php  }                 
                        }    ?>
                        
                        </form>
                        </tbody>
                    </table>
                    <input class="font1" type="submit" name="remove_cart" value="Remove" style="font-size:18px; color:white; border:none; background:none;  margin-bottom:12px !important;margin-left:800px !important;   border-radius:4px; background: black;" class="font1">
                </div>
                
            </div>
            
            <div class="col-sm-3 ms-2">
                <div class="card " style="width: 23rem; margin-left:-10px !important; transition: none !important; border:none;">
                    <div class="card-body ">
                        <h5 class="card-title">SHOPPING SUMMARY</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><hr></h6>
                            <div class="row">
                                <div class="col-sm-8">

                                    <p class="card-text font1" style="font-size: 12px;"><b>Name</b></p>
                                </div>
                                <div class="col-sm-4">
                                    <p class="card-text font1" style="font-size: 12px;"><b>Qty</b></p>
                                </div>
                                <?php 
                            global $con;
                            $get_ip_add = getIPAddress(); 
                            $total_price=0;
                            $select_query="Select * from `cart_details` where ip_address='$get_ip_add'";
                            $result_query=mysqli_query($con,$select_query);
                            while($row=mysqli_fetch_array($result_query)){
                            $product_id=$row['product_id'];
                            $select_products="Select * from `products` where product_id='$product_id'";
                            $result_product=mysqli_query($con,$select_products);           
                            while($row_product_price=mysqli_fetch_array($result_product)){
                                $price = str_replace('.', '', $row_product_price['product_price']);
                                $price = floatval($price);
                                $total_price+=$price;
                                $product_price=array($row_product_price['product_price']);
                                $price_table=$row_product_price['product_price'];
                                $product_title=$row_product_price['product_title'];
                                $brand_title=$row_product_price['brand_title'];
                                $product_image=$row_product_price['product_image1'];
                                $total_price_formatted = number_format($total_price, 0, ',', '.'); ?>
                                <div class="col-sm-8">
                                    <p class="card-text font1" style="font-size: 12px;"><?php echo $product_title;?></p>
                                </div>
                                <div class="col-sm-4">
                                    <p class="card-text font1" style="font-size: 12px; margin-left:8px !important;">1</p>
                                </div>
                                <br>
                                <?php  }                 
                        }    ?>
                            </div>  
                            <hr>
                            <div class="row"> 
                                <div class="col-sm-8">                                    
                                    <p class="card-text font1" style="font-size: 12px;"><b>TOTAL PRICE</b></p>
                                </div>
                                <div class="col-sm-4">
                                    <p class="card-text font1" style="font-size: 12px;"><b>Rp. <?php echo $total_price_formatted;?></b></p>
                                </div>
                            </div>
                            <hr>
                            <a href="checkout.php?user_id=<?php echo $user_id; ?>" class="btn ms-3" style='color:white;width:300px; background:#0a58d4;'>Checkout</a>
                            <br>
                            <a href="index.php" class="btn ms-3 mt-1" style='width:300px; border-color: #0a58d4; color:#0a58d4' >Continue shopping</a>
                            
                    </div>
                        
                        
                    </div>
            </div>
        </div>
    </div>

    <?php } 
    else{
        echo "<div class='bg-light'>
        <h3 class='text-center mt-3 mx-auto font1'>No item added</h3>
         </div>";
        echo "<div class='bg-light'>
        <h3 class='text-center mt-3 mx-auto font1' style='color: gray; font-size:15px;'>Pick a product</h3>
        <p class='text-center mx-auto font1'><a  href='index.php'>Go back</a></p>
    
      </div>"   ;
    }?>

   


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
                    echo "<script>window.open('cart.php','_self')</script>";
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
        getproducts1();
        ?>
          
    <!-- call cart -->
    <?php cart(); 
    ?>
  <!-- Footer -->
  <div class="bg-white p-1 text-center font1">
    <p>Test for Konnco Studio 29 July. Giri Shaffaat Al</p>
  </div>

  <script src="./script.js"></script>
  <!-- Fontawesome link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Bootstrap JS link   -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>