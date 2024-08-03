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
    <title>E-commerce Website</title>
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
<body class="bg-body-tertiary">

    <!-- navbar atas -->
     <nav class="container-fluid">
        <div class="container-fluid p-0">
            <nav class="nav"></nav>
            <div class="d-flex flex-row-reverse" >
              <?php 
              
              if(!isset($_SESSION['username'])){
                echo "<a class='navbar-brand p-2 font1' href='./user_login.php' >LOGIN</a>
                <a class='navbar-brand p-2 font1'>WELCOME GUEST</a>";
              }
              else{
                echo "<a class='navbar-brand p-2 font1 ' href='./logout.php' >LOGOUT</a>
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
            <button class="btn btn-outline-secondary" name="search_data_product" value="Search" type="submit" id="button-addon2"><img src="./img/search.png" alt=logo width="20" height="20"></button>
          </form> 

            <a class="navbar-link" href="cart.php"><i class="fa-solid fa-cart-shopping" style="color: black;"><sup><?php cart_item()?></sup></i></a>

          
          
        </div>
      </nav>
    </div>
 
    
    <!-- main functions -->
        <?php 
        mainshow();
        get_unique_categories();
        get_unique_brands();
        $ip = getIPAddress();  
        // echo 'User Real IP Address - '.$ip;
        ?>
          
    <!-- call cart -->
    <?php cart(); 
    ?>
  <!-- Footer -->
  <div class="bg-white p-1 text-center font1">
    <p>Test for Konnco Studio 29 July. Giri Shaffaat Al</p>
  </div>

  <!-- Fontawesome link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Bootstrap JS link   -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>



</body>
</html>