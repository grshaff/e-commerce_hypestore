<?php

        
        if (isset($_GET['active'])){
            $product_id =$_GET['active'];
            $status=$_GET['status'];
            $product_status = "Update `products` set status='$status' WHERE product_id = $product_id";
            $result_status = mysqli_query($con, $product_status);
                if($result_status){
                echo "<script>window.open('index.php?view_products','_self');</script>";
                }}
        elseif(isset($_GET['non_active'])){
            $product_id = $_GET['non_active'];
            $status=$_GET['status'];
            $product_status = "Update `products` set status='$status' WHERE product_id = $product_id";
            $result_status = mysqli_query($con, $product_status);
            if($result_status){
                echo "<script>window.open('index.php?view_products','_self');</script>";
            }
        }
    
    ?>