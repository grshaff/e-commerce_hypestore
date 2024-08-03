<?php
namespace Midtrans;
include('./function/common_function.php');
include("./order.php");

require_once dirname(__FILE__) . '/Midtrans/Midtrans.php';
// Set Your server key
// can find in Merchant Portal -> Settings -> Access keys
Config::$serverKey = '<enter ur own key>';
Config::$clientKey = '<enter ur own key>';

// non-relevant function only used for demo/example purpose
printExampleWarningMessage();



// Uncomment for production environment
// Config::$isProduction = true;
Config::$isSanitized = Config::$is3ds = true;

// Required
$transaction_details = array(
    'order_id' => $invoice_number,
    'gross_amount' => 94000, // no decimal allowed for creditcard
);
// Optional
$item_details = array (
    array(
        'id' => 'a1',
        'price' => $total_price_int,
        'quantity' => 1,
        'name' => "ALL PRODUCTS"
    ),
  );
// Optional
$customer_details = array(
    'username'    => 'Giri',
    'email'         => "andri@litani.com",
);
// Fill transaction details
$transaction = array(
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
);

$snap_token = '';
try {
    $snap_token = Snap::getSnapToken($transaction);
}
catch (\Exception $e) {
    echo $e->getMessage();
}
// echo "snapToken = ".$snap_token;

function printExampleWarningMessage() {
    if (strpos(Config::$serverKey, 'your ') != false ) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars('Config::$serverKey = \'<your server key>\';');
        die();
    } 
    global $con,$total_price_formatted,$product_price,$price_table,$total_price_int;
    global $product_summary,$product_stock; 
    $product_summary = '';
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
        $product_stock=$row_product_price['product_stock'];
        $total_price_formatted = number_format($total_price, 0, ',', '.');
        $total_price_int=intval($total_price);
        $product_summary .= "
            <div class='col-4'>
                <img style='width:150px; clip-path: inset(40px 15px 15px 10px); margin-top:-45px; margin-left:0px !important;' src='./Admin/product_img/{$product_image}' >
            </div>
            <div class='col-sm-8'>
                <h5 class='card-title' style='font-size:15px;'>{$brand_title}</h5>
                <p class='card-text font1' style='font-size:15px; margin-bottom:10px !important;'>{$product_title}</p>
                <p class='card-text font1' style='color: gray;font-size: 12px; margin-left:0px !important;'>Quantity: 1</p>
            </div>
            <br><hr style='width:95%; margin-left:10px;'>
        ";
        if (isset($_GET['user_id'])){
            $qty = 1;
            // Kurangi stok produk
            $new_stock = $product_stock - $qty;
            
            // Buat query untuk mengupdate stok produk di database
            $update_stock_query = "UPDATE `products` SET product_stock='$new_stock' WHERE product_id='$product_id'";
            
            // Eksekusi query
            $result_update_stock = mysqli_query($con, $update_stock_query);
            
            // Cek apakah update berhasil


        }
    }

}

}
?>

<!DOCTYPE html>
<html>
    <head>
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

    <body>
       
        <div class="col-sm-12 ">
                    <div class="card" style="width: 70rem; margin-left:70px !important; transition: none !important; border:none; box-shadow:none !important">
                        <div class="card-body ">
                            <h5 class="card-title">SHOPPING SUMMARY</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary"><hr></h6>
                                <div class="row">
                                    
                                                   
                                    <?php  
                                    
                                    echo $product_summary;             
                                ?>
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
                                <div class="row me-5"> 
                                <div class="col-sm-2 mb-2">
                                    <a href="cart.php" class="btn border-black mt-1 " style='width:150px; margin-left:70px !important;' >< Back to cart</a>
                                    </div>
                                    <div class="col-sm-6">                                    
                                    <button id="pay-button" class="btn border-black mt-1 bg-dark" style='width:800px; color:white;  margin-left:70px !important;' >Pay now</button>
                                    <div id="snap-container"></div>
                                    
                                    <?php 
                                        
                                        
                                        
                                    ?>
                                    </div> 
                                </div>
                                
                                

                                
                                
                                </div>
                        <?php
                         ?>
                                
                        </div>
                            
                            
                    </div>
                </div>
       
       
       
       
       
       
       
        <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey;?>"></script>
        <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            snap.pay('<?php echo $snap_token; ?>', {
                // Optional
                onSuccess: function(result) {
                    console.log(result); // Log the result
                    updateOrderStatus('Success');
                    <?php 
                    // empty cart
                    global $con, $get_ip_address;
                    $empty_cart="Delete from `cart_details` where ip_address='$get_ip_address'";
                    $result_delete=mysqli_query($con,$empty_cart);
                    
                    

                    




                    ?>;
                },
                // Optional
                onPending: function(result) {
                    console.log(result); // Log the result
                    updateOrderStatus('Pending');
                },
                // Optional
                onError: function(result) {
                    console.log(result); // Log the result
                    updateOrderStatus('Error');
                }
            });
        };

        function updateOrderStatus(status) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_order_status.php", true);
            xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    console.log(xhr.responseText); // Log the response from PHP
                }
            };
            xhr.send(JSON.stringify({
                order_id: '<?php echo $transaction_details['order_id']; ?>',
                status: status
            }));
        }
    </script>
         <script src="./script.js"></script>
        <!-- Fontawesome link -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Bootstrap JS link   -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
