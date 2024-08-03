<?php
include('../includes/connect.php');
include('../function/common_function.php');
session_start();
if(!isset($_SESSION['username'])){
    echo "<script>window.open('admin_login.php','_self')</script>";
} ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../style.css">
    <style>.pfp{
    width:100px;
    object-fit: contain;}  
        html{
            height: 100%;
            box-sizing: border-box;
        }
    body{
        position: relative;
        margin:0;
        min-height: 100%;
        padding-bottom: 6.74rem;
        box-sizing: inherit;
    }
        .footer{
            margin-top: auto;
            position: absolute;
            bottom: 0;
        }

    </style>
    <link rel="stylesheet" href="../style.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link href="//cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css" rel="stylesheet">
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-body-tertiary font1">
    
    <!-- top nav -->
    <div class="container-fluid p-0">
            <div class="d-flex flex-row-reverse bg-body-tertiary">
            <a class="navbar-brand p-2" href="#">Welcome Admin</a>
            </div>

    </div>

    <!-- dashboard -->
    <div class="bg-white p-3">
        <h3 class="text-center font">DASHBOARD</h3>
    </div>

    <!-- row -->
     <div class="row mx-auto">
        <div class="col-md-12 bg-secondary p-1 d-flex align-items-center ">
            <div class="pt-3 mx-auto">
                <a href="#"><img src="./img/pfp.webp" class="pfp"></img></a>
                <p class="text-light text-center">Admin</p>
            </div>
        </div>

        <div class="col-md-12 bg-secondary p-1 d-flex align-items-center ">

            <div class="button text-center mx-auto p-2 pt-0">
                <button><a href="./insert_product.php" class="my-1 nav-link text-dark">Insert Products</a></button>
                <button><a href="index.php?view_products" class="my-1 nav-link text-dark">View Products</a></button>
                <button><a href="index.php?list_orders" class="my-1 nav-link text-dark">All Orders</a></button>
                <button><a href="logout.php" class="my-1 nav-link text-dark">Logout</a></button>
            </div>
        </div>
     </div>

     <div class="container-fluid p-0">
        <div class="container">
        <?php 
        if(isset($_GET['view_products'])){
            include('view_products.php');
        }
        if(isset($_GET['edit_products'])){
            include('edit_products.php');
        }
        
        if(isset($_GET['delete_product'])){
            include('delete_product.php');
        }
        if(isset($_GET['list_orders'])){
            include('list_orders.php');
        }
        if(isset($_GET['active'])){
            if(isset($_GET['status'])){
            include('status.php');
        }
    }
    if(isset($_GET['non_active'])){
        if(isset($_GET['status'])){
        include('status.php');
    }
}
        ?>
        </div>




        <!-- Footer -->
        <div class="bg-white p-2 text-center footer font1 container-fluid p-0">
            <p>Test for Konnco Studio 29 July. Giri Shaffaat Al</p>
        </div>
     </div>






   
  

    <!-- Fontawesome link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Bootstrap JS link   -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</body>
</html>