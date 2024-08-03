<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="col-sm-4 ">
                    <div class="card" style="width: 30rem; margin-left:-115px !important; transition: none !important; border:none; box-shadow:none !important">
                        <div class="card-body ">
                            <h5 class="card-title">SHOPPING SUMMARY</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary"><hr></h6>
                                <div class="row">
                                    
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
                                    <div class="col-4">
                                        <img style="width:150px; clip-path: inset(40px 15px 15px 10px); margin-top:-45px; margin-left:0px !important;" src='./Admin/product_img/<?php echo $product_image;?>' >
                                    </div>
                                    <div class="col-sm-8">
                                    <h5 class='card-title' style="font-size:15px;"><?php echo $brand_title; ?></h5>
                                    <p class='card-text font1' style="font-size:15px; margin-bottom:10px !important;"><?php echo $product_title;?></p>
                                        <p class="card-text font1" style="color: gray;font-size: 12px; margin-left:0px !important;">Quantity: 1</p>
                                    </div>
                                    
                                        
                                    
                                    <br><hr style="width:95%; margin-left:10px;">
                                    <?php  }                 
                            }    ?>
                                </div>  
                                
                                <div class="row"> 
                                    <div class="col-sm-8">                                    
                                        <p class="card-text font1" style="font-size: 16px;"><b>TOTAL PRICE</b></p>
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="card-text font1" style="font-size: 16px;"><b>Rp. <?php echo $total_price_formatted;?></b></p>
                                    </div>
                                    
                                </div>
                                <hr>
                                <!-- <button id="pay-button" class="btn border-black mt-1 " style='width:300px; margin-left:70px !important;' >Pay now</button> -->
                                <a href="cart.php" class="btn border-black mt-1 " style='width:300px; margin-left:70px !important;' >Back to cart</a>
                                
                                
                        </div>
                            
                            
                    </div>
                </div>
    
</body>
</html>


