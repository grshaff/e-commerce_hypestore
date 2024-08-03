<?php
include('./includes/connect.php');  

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


    <!-- logo -->
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
            <a href="index.php" class="navbar-brand">< Continue shopping </a> </p>
            </div>
        </div>
    </div>

<div class="container-fluid p-0 mt-3 ms-5">
    <div class="row justify-content-center">
        <?php 
        
        if(!isset($_SESSION['username'])){
            // include('');
            
            define('INCLUDE_CONTAINER', false);
            include("./user_login.php");
            include("./summary1.php");
            
        }
        else{
          try {
            
            throw new Exception();
            } catch (Exception $e) {
              include('error_handler.php');
            } finally {
              include("./payment.php");
            }
        }
        ?>
    
    
    </div>
    <?php 
        $ip = getIPAddress();  
        // echo 'User Real IP Address - '.$ip;
        getproducts1();
        ?>
</div>
    
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