<?php
session_start();
if(!isset($_SESSION['username'])){
    echo "<script>window.open('admin_login.php','_self')</script>";
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - view products</title>
</head>
<body>
<div class="container-fluid p-0 mt-0">
        <div class="row">
            <div class="col-sm mt-4" style="text-align:center;">
                <h2 class="font1">Products</h2>
            </div>
        </div>
    </div>

    
    <div class="container-fluid p-0 mt-3">
        <div class="row justify-content-center">
            <div class="col-sm" style="margin-left:-30px !important; border-radius: 8px !important; background:white;">
                <div class="table-responsive text-align-center">
                    <table class="table font1" id="example" >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th >Product</th>
                                <th>Brand</th>
                                <th width="15%">Price</th>
                                <th >Quantity</th>
                                <th width="12%">Total Sold</th>
                                <th width="12%">Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $get_products="Select * from `products`";
                            $result=mysqli_query($con,$get_products);
                            while($row_result=mysqli_fetch_assoc($result)){
                                $product_id=$row_result['product_id'];
                                $product_title=$row_result['product_title'];
                                $brand_title=$row_result['brand_title'];
                                $product_image1=$row_result['product_image1'];
                                $product_price=$row_result['product_price'];
                                $product_stock=$row_result['product_stock'];
                                $status=$row_result['status'];
                                $get_count="Select * from `orders_pending` where product_id=$product_id";
                                $result_count=mysqli_query($con,$get_count);
                                $rows_count=mysqli_num_rows($result_count);
                                $status_new='';
                                if($status=='true'){
                                    $status_new="<a href='index.php?active=".$product_id."&status=false'>active</a>";
                                    
                                }
                                elseif($status=='false') { 
                                    $status_new="<a href='index.php?non_active=".$product_id."&status=true'>non-active</a>";
                                }
                                

                                echo "  <tr> 
                                        <td>$product_id</td>
                                        <td>$product_title</td>
                                        <td>$brand_title</td>
                                        <td >Rp. $product_price</td>
                                        <td>$product_stock</td>
                                        <td>$rows_count</td>
                                        <td>$status_new</td>
                                        <td><a href='index.php?edit_products=".$product_id."' class='text-dark'><i class='fa-solid fa-pen-to-square'></i></a></td>

                                        <td><a data-title='Delete?' href='index.php?delete_product=".$product_id."' class='text-dark twitter'><i class='fa-solid fa-trash'></i></a>
                                        </td>
                                        </tr> ";
                            }

                            ?>
                            
                            

                            
                        </tbody>
                    </table>
                </div>
             
                

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>
<script>
    $('a.twitter').confirm({
    content: "Deleted product cannot be retreived, are you wish to continue?",
});
$('a.twitter').confirm({
    buttons: {
        hey: function(){
            location.href = this.$target.attr('href');
        }
    }
});
new DataTable('#example');
</script>
</body>
 
</html>
