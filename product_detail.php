<?php
include('includes/connect.php');
include('function/common_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Website</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

    <!-- jQuery 1.8 or later, 33 KB -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

</head>
<body class="bg-body-tertiary">
    
    <!-- navbar atas -->
     <nav class="container-fluid">
        <div class="container-fluid p-0">
            <nav class="nav"></nav>
            <div class="d-flex flex-row-reverse">
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
    <div class="container-fluid p-0 bg-white">
      <nav class="navbar navbar-expand-lg bg-white">
        <div class="container-fluid bg-white" style="justify-content: center;">
          <a class="navbar-brand font" href="index.php" style="font-size: 30px;">HYPESTORE</a>
          <form class="input-group m-3 w-50 font1" role="search" action="search.php" method="get">
            <input type="text" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2" name="search_data">
            <button class="btn btn-outline-secondary" name="search_data_product" value="Search" type="submit" id="button-addon2"><img src="./img/search.png" alt="logo" width="20" height="20"></button>
          </form> 
          <a class="navbar-link" href="cart.php"><i class="fa-solid fa-cart-shopping" style="color: black;"><sup><?php cart_item()?></sup></i></a>
        </div>
      </nav>
    </div>
    <!-- call cart -->
    <?php cart(); 
    ?>
    <div class="container-fluid" style="height: 20px !important;">
        <div class="row mt-3">
            <div class="col-sm">
                <p style="color: gray; text-transform: uppercase; font-size:13px;" class="font1">
                    <a href="index.php" class="navbar-brand">Home / </a> 
                    <?php
                        if(isset($_GET['product_id'])){
                        $product_id=$_GET['product_id'];
                        $select_query="SELECT * FROM `products` WHERE product_id=$product_id";
                        $result_query=mysqli_query($con,$select_query);
                        while($row=mysqli_fetch_assoc($result_query)){
                            $product_title=$row['product_title'];
                            echo " <span style='color: black; font-weight:bold;'>$product_title</span>";
                        }}
                    ?>
                </p>
            </div>
            <div class="col-sm"></div>
        </div>
    </div>

    <div class="container-fluid m-3">
        <div class="row justify-content-center mt-0">
            <!-- carousel -->
            <div class='col-sm-6' style='margin-left:30px !important; width:330px !important; height:300px !important;'> 
                <div class='carousel slide carousel-dark' id='carousel' data-bs-wrap='false' style='width:100%;'>
                    <div class='carousel-inner'>
                        <?php
                        if(isset($_GET['product_id'])){
                            $product_id=$_GET['product_id'];
                            $select_query="SELECT * FROM `products` WHERE product_id=$product_id";
                            $result_query=mysqli_query($con,$select_query);
                            while($row=mysqli_fetch_assoc($result_query)){
                                $product_image1=$row['product_image1'];
                                $product_image2=$row['product_image2'];
                                $product_image3=$row['product_image3'];
                                
                                echo "<div class='carousel-item active'>
                                        <img src='./Admin/product_img/$product_image1' class='d-block w-100' style='border-radius:4px;'>
                                      </div>";
                                
                                if($product_image2 != '') {
                                    echo "<div class='carousel-item'>
                                            <img src='./Admin/product_img/$product_image2' class='d-block w-100' style='border-radius:4px;'>
                                          </div>";
                                }
                                
                                if($product_image3 != '') {
                                    echo "<div class='carousel-item'>
                                            <img src='./Admin/product_img/$product_image3' class='d-block w-100' style='border-radius:4px;'>
                                          </div>";
                                }
                            }
                        }
                        ?>
                    </div>
                    <button class='carousel-control-prev' type='button' data-bs-target='#carousel' data-bs-slide='prev'>
                        <span class='carousel-control-prev-icon'></span>
                    </button>
                    <button class='carousel-control-next' type='button' data-bs-target='#carousel' data-bs-slide='next'>
                        <span class='carousel-control-next-icon'></span>
                    </button>
                    <div class='carousel-indicators' style="bottom: -15px !important;">
                        <button type='button' class='active' data-bs-target='#carousel' data-bs-slide-to='0'></button>
                        <?php
                        $slide_index = 1;
                        if(isset($product_image2) && $product_image2 != '') {
                            echo "<button type='button' data-bs-target='#carousel' data-bs-slide-to='$slide_index'></button>";
                            $slide_index++;
                        }
                        if(isset($product_image3) && $product_image3 != '') {
                            echo "<button type='button' data-bs-target='#carousel' data-bs-slide-to='$slide_index'></button>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            
            <!-- details -->
            <div class="col-sm-5">
                <div class="font1" style="width: 25rem;">
                    <div class="">
                        <?php
                if(isset($_GET['product_id'])){
                    $product_id=$_GET['product_id'];
                    $select_query="SELECT * FROM `products` WHERE product_id=$product_id";
                    $result_query=mysqli_query($con,$select_query);
                    while($row=mysqli_fetch_assoc($result_query)){
                        $product_id=$row['product_id'];
                        $product_title=$row['product_title'];
                        $product_desc=$row['product_desc'];
                        $product_image1=$row['product_image1'];
                        $product_price=$row['product_price'];
                        $category_id=$row['category_id'];
                        $brand_title=$row['brand_title'];
                        $product_stock=$row['product_stock'];
                        echo "
                        <h5 class='card-title'>$product_title</h5>
                        <a href='index.php?brand=$brand_title' class='navbar-brand'><h6 class='card-subtitle mb-2 text-body-secondary'>$brand_title</h6></a>
                        <hr style='width:97%;text-align:left;'>
                        <p class='card-text font1'>$product_desc</p>
                        <p class='card-text font1'>Stock: $product_stock</p>
                        <a href='index.php?add_to_cart=$product_id' class='btn border-black'>Add to cart</a>
                        <a href='index.php?buy-now=$product_id' class='btn border-black bg-dark' style='color:white;'>Buy now</a>";}}

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>                 
    <!-- main functions -->
    <?php 
        getproducts1();
        $ip = getIPAddress(); 
        get_unique_categories();
        get_unique_brands();
        
        
        
    ?>
          
    <!-- Footer -->
    <div class="bg-white p-1 text-center font1">
        <p>Test for Konnco Studio 29 July. Giri Shaffaat Al</p>
    </div>

    <!-- Fontawesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
