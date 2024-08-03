<?php
session_start();
if(!isset($_SESSION['username'])){
    echo "<script>window.open('admin_login.php','_self')</script>";
} 
?>
<?php 
    include('../includes/connect.php');
    if(isset($_POST['insert_product'])){

        
        $product_title = $_POST['product_title'];
        $product_title = htmlspecialchars($product_title, ENT_QUOTES, 'UTF-8');
        $product_desc = $_POST['product_desc'];
        $product_desc = htmlspecialchars($product_desc, ENT_QUOTES, 'UTF-8');
        $product_keyword = $_POST['keyword'];
        $product_categories = $_POST['product_categories'];
        $product_brand = $_POST['product_brand'];
        $product_price = $_POST['product_price'];
        $product_stock = $_POST['product_stock'];
        $product_status = 'true';

        // images
        $product_image1 = $_FILES['product_image1']['name'];
        $product_image2 = $_FILES['product_image2']['name'];
        $product_image3 = $_FILES['product_image3']['name'];

        //images temp
        $temp_image1 = $_FILES['product_image1']['tmp_name'];
        $temp_image2 = $_FILES['product_image2']['tmp_name'];
        $temp_image3 = $_FILES['product_image3']['tmp_name'];

        // check condition
        if($product_title=='' or $product_desc=='' or $product_keyword=='' or $product_categories=='' or $product_brand=='' or $product_price=='' or $product_stock<1){ 
            echo "<script>alert('Please fill all the fields')</script>";
        }
        else {
            $select_query="Select * from `products` where product_title='$product_title'";
            $result_select=mysqli_query($con,$select_query);
            $number=mysqli_num_rows($result_select);
            if($number > 0){
                echo "<script>alert('This product is already added!')</script>";
            }
            else{

                move_uploaded_file($temp_image1,"./product_img/$product_image1");
                move_uploaded_file($temp_image2,"./product_img/$product_image2");
                move_uploaded_file($temp_image3,"./product_img/$product_image3");

                // insert query
                $insert_products="insert into `products` (product_title,product_desc,product_keyword,category_id,brand_title,product_image1,product_image2,product_image3,product_price,product_stock,status,date) values ('$product_title','$product_desc','$product_keyword','$product_categories','$product_brand','$product_image1','$product_image2','$product_image3','$product_price',$product_stock,'$product_status',NOW())";
                $result_query=mysqli_query($con,$insert_products);
                if($result_query){
                    echo "<script>alert('Product successfully added!')</script>";
            }
        }
        }
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products-Admin</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../includes/connection.php">
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>
        <!-- form -->
         <form action="" method="post" enctype="multipart/form-data">
            <!-- name -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product name</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product name" autocomplete="off" required="required">
            </div>
            <!-- desc -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product description</label>
                <input type="text" name="product_desc" id="product_desc" class="form-control" placeholder="Enter product description" autocomplete="off" required="required">
            </div>
            <!-- keyword -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="keyword" class="form-label">Product keyword</label>
                <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Enter product keyword" autocomplete="off" required="required" >
            </div>
            <!-- category -->
             <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_categories" id="" class="form-select">
                    <option value="">Select category</option>
                    <?php 
                        $select_query="Select * from `categories`";
                        $result_query=mysqli_query($con,$select_query);
                        while($row=mysqli_fetch_assoc($result_query)){
                            $category_title=$row['category_title'];
                            $category_id=$row['category_id'];
                            echo "<option value='$category_id'>$category_title</option>";
                        }  
                    ?>
                </select>

             </div>
             <!-- brand -->
             <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_brand" id="" class="form-select">
                <option value="">Select brand</option>
                <?php 
                    $select_query="Select * from `brands`";
                    $result_query=mysqli_query($con,$select_query);
                    while($row=mysqli_fetch_assoc($result_query)){
                        $brand_title=$row['brand_title'];                        
                        echo "<option value='$brand_title'>$brand_title</option>";

                    }  
                ?>
                </select>
             </div>
            <!-- Image 1 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label">Product image 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control" required="required">
            </div>
            <!-- Image 2 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label">Product image 2<sup style="color: gray;">*(Optional)</sup></label>
                <input type="file" name="product_image2" id="product_image2" class="form-control">
            </div>
            <!-- Image 3 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image3" class="form-label">Product image 3<sup style="color: gray;">*(Optional)</sup></label>
                <input type="file" name="product_image3" id="product_image3" class="form-control">
            </div>
            <!-- product stock -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="price" class="form-label">Product stock</label>
                <input type="number" name="product_stock" id="product_stock" class="form-control" placeholder="Enter product stock" autocomplete="off" required="required">
            </div>
            <!-- price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="price" class="form-label">Product price (IDR)</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" autocomplete="off" required="required">
            </div>
            <!-- button -->
            <div class="form-outline mb-4 w-50 m-auto text-end">
                <a href="index.php" type="button" name="cancel" class="btn border border-black m-2">Cancel</a>
                <input type="submit" name="insert_product" class="btn border border-black" value="Add product">
                
            </div>
            <div class="form-outline mb-4 w-50 m-auto text-end">
            
            </div>
         </form>
    </div>
        



 <!-- Fontawesome link -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Bootstrap JS link   -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>