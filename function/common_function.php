<?php
include($_SERVER['DOCUMENT_ROOT'].'/E-commerce Test/includes/connect.php');
//get product
function mainshow(){
    if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){
            getcategory();
            getbrand();
            getproducts();
        }}

}

function getcategory(){
    global $con;
    $select_category="Select * from `categories` ";
    $result_categories = mysqli_query($con,$select_category);
    echo "<div class='bg-light'>
            <h3 class='text-center mt-3 mx-auto font1'>CATEGORIES</h3>
        </div>
        <div class='container p-0 mx-auto flex-fill gap-0' style='max-width:1600px;'>
            <div class='row gap-3'>
            <div class='col-md-10 mx-4' style='margin-right:15.4rem !important'>
            <!-- product -->
                <div class='row gap-3' >
                <div class='col-md-1 mt-2 m-auto' >
                    <div class='card' style='width: 12rem;'>
                    <a href='index.php?category=1'><img src='./img/category/loafers.png'  style='position:relative; bottom:-13px;' class='card-img-top' alt='formal'></a>
                    <div class='card-body' id='category_1'></div>
                    </div>
                </div>

                <div class='col-md-1 mt-2 m-auto' >
                    <div class='card' style='width: 12rem;'>
                    <a href='index.php?category=2'><img src='./img/category/lifestyle.png' style='position:relative; bottom:-14px;' class='card-img-top' alt='lifestyle'></a>
                    <div class='card-body' id='category_2'>
                    </div>
                    </div>
                </div>

                <div class='col-md-1 mt-2 m-auto' >
                    <div class='card' style='width: 12rem;'>
                    <a href='index.php?category=3'><img src='./img/category/running.png'  class='card-img-top' style='position:relative; bottom:-15px;' alt='running'></a>
                    <div class='card-body' id='category_3'>
                    </div>
                    </div>
                </div>

                <div class='col-md-1 mt-2 m-auto' >
                    <div class='card' style='width: 12rem;'>
                    <a href='index.php?category=4'><img src='./img/category/sandals.png'  class='card-img-top' style='position:relative; bottom:-20px;' alt='sandals'></a>
                    <div class='card-body' id='category_4'>
                    </div>
                    </div>
                </div>

                <div class='col-md-1 mt-2 m-auto' >
                    <div class='card' style='width: 12rem;'>
                    <a href='index.php?category=5'><img src='./img/category/sneakers.png' style='position:relative; bottom:-10px;' class='card-img-top' alt='sneakers'></a>
                    <div class='card-body' id='category_5'>
                    </div>
                    </div>
                </div>

                <div class='col-md-1 mt-2 m-auto ' >
                    <div class='card' style='width: 12rem;' href='#'>
                    <a href='index.php?category=6'><img src='./img/category/trekking.jpeg' style='scale:85% ;' class='card-img-top' alt='trekking'></a>
                    <div class='card-body ' id='category_6'>
                    </div>
                    </div>
                </div>

                </div>
            </div>
            </div>
        </div>";
    while($row_data=mysqli_fetch_assoc($result_categories)){
    $category_title=$row_data['category_title'];
    $category_id=$row_data['category_id'];
    echo "<script>
          document.getElementById('category_$category_id').innerHTML = '<a class=\"navbar-brand\" href=\"index.php?category=$category_id\"><p id=\"category_$category_id\" class=\"card-text text-center font1\"><b>$category_title</b></p></a>';
        </script>";
    }


}

function getbrand(){
    echo "<div class='bg-light'>
    <h3 class='text-center mt-4 mx-auto font1'>TOP BRANDS</h3>
  </div>

  <div class='container' style='height:160px; margin-top:-30px;'>
        <div class='row justify-content-center mx-5 gap-0'>
            <div class='col-md-2'>
                <div class='hover01' style='width: 8rem;'>
                    <a href='index.php?brand=Nike'><img src='./img/brand/Nike-Logo.png' class='card-img-top' alt='formal'></a>
                </div>
            </div>

            <div class='col-md-2'>
                <div class='hover01' style='width: 8rem;'>
                    <a href='index.php?brand=Puma'><img src='./img/brand/onitsuka.png' class='card-img-top' alt='lifestyle'></a>
                </div>
            </div>

            <div class='col-md-2'>
                <div class='hover01' style='width: 8rem;'>
                    <a href='index.php?brand=Skechers'><img src='./img/brand/Skechers-Logo-Transparent-White.png' class='card-img-top' alt='running'></a>
                </div>
            </div>
        </div>
    </div>";

}

function getproducts(){
    global $con;
    // condition isset || !isset
    if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){
    $select_query="Select * from `products` where status='true' order by rand() LIMIT 8";
    $result_query=mysqli_query($con,$select_query);
    echo "<div class='bg-light'>
    <h3 class='text-center mt-0 mx-auto font1'>RECOMMENDATIONS</h3>
  </div>";
  echo "  <div class='container mt-4 mb-4'>
    <div class='row '>
      <div class='col-md-10' style='margin-right:7.5rem !important; margin-left:-15px;'>
      <!-- product -->
        <div class='row justify-content-center m-auto' style='row-gap: 7px !important; column-gap:3rem !important;'>
        <!-- fetch product -->";
    while($row=mysqli_fetch_assoc($result_query)){
      $product_id=$row['product_id'];
      $product_title=$row['product_title'];
      $product_desc=$row['product_desc'];
      $product_image1=$row['product_image1'];
      $product_price=$row['product_price'];
      $category_id=$row['category_id'];
      $brand_title=$row['brand_title'];
      $product_stock=$row['product_stock'];
      $product_status=$row['status'];
        if($product_stock==0){
          echo "<style>
          .overlay-text {
          position: absolute;
          top: 40%; 
          left: 50%; 
          transform: translate(-50%, -50%); 
          background-color: gray; 
          opacity: 70%;
          color: #fff; 
          padding: 10px 20px; 
          font-size: 20px; 
          text-align: center;
          border-radius:50%
          </style>
          
          <div class='col-md-2 m-auto' >
          
          <div class='card' style='width: 240px !important; height:378px !important;''>
            <img style='opacity:0.8' src='./admin/product_img/$product_image1' class='card-img-top' alt='...' >
            
            <div class='card-body'>
              <h5 class='card-title font1'>$brand_title</h5>
                <p class='card-text font1'>$product_title</p>
                <p class='card-text font1'><b>Rp. $product_price</b></p>
            </div>
            <div class='overlay-text'>Product not Available</div>
          </div>
        </div>";
        }
        else{
        echo "<div class='col-md-2 m-auto' >
          <div class='card' style='width: 240px !important; height:378px !important;'>
            <a href='product_detail.php?product_id=$product_id'><img src='./admin/product_img/$product_image1' class='card-img-top' alt='...' ></a>
            <div class='card-body'>
              <h5 class='card-title font1'><a class=navbar-brand href='product_detail.php?product_id=$product_id'>$brand_title</a></h5>
                <p class='card-text font1'><a href='product_detail.php?product_id=$product_id'>$product_title</a></p>
                <p class='card-text font1'><b>Rp. $product_price</b></p>
            </div>
          </div>
        </div>";
      }
          }
      echo "        </div>
        </div>
      </div>
    </div>";
      }
      }
  }

function get_unique_categories(){
    global $con;
    // condition isset || !isset
    if(isset($_GET['category'])){
    $category_id=$_GET['category'];
    $select_query="SELECT * from `products` WHERE category_id=$category_id AND status='true'";
    $result_query=mysqli_query($con,$select_query);
    $select_category_name="Select * from `categories` where category_id=$category_id";
    $result_category_query=mysqli_query($con,$select_category_name);
    $category_name_title=mysqli_fetch_assoc($result_category_query);
    $category_title=$category_name_title['category_title'];
    echo "<div class='bg-light'>
    <h3 class='text-center mt-3 mx-auto font1'>$category_title</h3>
  </div>";
        
    $num_rows=mysqli_num_rows($result_query);
    if($num_rows==0){
        echo "<div class='bg-light'>
    <h3 class='text-center mt-3 mx-auto font1' style='color: gray; font-size:15px;'>Sorry, Stock are not available in this category...</h3>
    <p class='text-center mx-auto font1'><a  href='index.php'>Go back</a></p>

  </div>";
    }

  echo "  <div class='container mt-4 mb-4'>
    <div class='row '>
      <div class='col-md-10' style='margin-right:7.5rem !important; margin-left:-15px;'>
      <!-- product -->
        <div class='row justify-content-center m-auto' style='row-gap: 7px !important; column-gap:3rem !important;'>
        <!-- fetch product -->";
        while($row=mysqli_fetch_assoc($result_query)){
          $product_id=$row['product_id'];
          $product_title=$row['product_title'];
          $product_desc=$row['product_desc'];
          $product_image1=$row['product_image1'];
          $product_price=$row['product_price'];
          $category_id=$row['category_id'];
          $brand_title=$row['brand_title'];
          $product_stock=$row['product_stock'];
          if($product_stock==0){
            echo "<style>
            .overlay-text {
            position: absolute;
            top: 40%; 
            left: 50%; 
            transform: translate(-50%, -50%); 
            background-color: gray; 
            opacity: 70%;
            color: #fff; 
            padding: 10px 20px; 
            font-size: 20px; 
            text-align: center;
            border-radius:50%
            </style>
            
            <div class='col-md-2 m-auto' >
            
            <div class='card' style='width: 240px !important; height:378px !important;'>
              <img style='opacity:0.8' src='./admin/product_img/$product_image1' class='card-img-top' alt='...' >
              
              <div class='card-body'>
                <h5 class='card-title font1'>$brand_title</h5>
                  <p class='card-text font1'>$product_title</p>
                  <p class='card-text font1'><b>Rp. $product_price</b></p>
              </div>
              <div class='overlay-text'>Product not Available</div>
            </div>
          </div>";
          }
          else{
          echo "<div class='col-md-2 m-auto' >
            <div class='card' style='width: 240px !important; height:378px !important;'>
              <a href='product_detail.php?product_id=$product_id'><img src='./admin/product_img/$product_image1' class='card-img-top' alt='...' ></a>
              <div class='card-body'>
                <h5 class='card-title font1'><a class=navbar-brand href='product_detail.php?product_id=$product_id'>$brand_title</a></h5>
                  <p class='card-text font1'><a href='product_detail.php?product_id=$product_id'>$product_title</a></p>
                  <p class='card-text font1'><b>Rp. $product_price</b></p>
              </div>
            </div>
          </div>";
        }
            }
    echo "        </div>
      </div>
    </div>
  </div>";
    }
    }

    function get_unique_brands(){
        global $con;
        
        // condition isset || !isset
        if(isset($_GET['brand'])){
            $brand_id=$_GET['brand'];
        
        $select_query="Select * from `products` where brand_title='$brand_id' AND status='true'";
        $result_query=mysqli_query($con, $select_query);

        $select_category_name="Select * from `brands` where brand_title='$brand_id'";
        $result_category_query=mysqli_query($con,$select_category_name);
        $category_name_title=mysqli_fetch_assoc($result_category_query);
        $brand_title=$category_name_title['brand_title'];
        echo "<div class='bg-light'>
        <h3 class='text-center mt-3 mx-auto font1'>$brand_title</h3>
      </div>";

        $num_rows=mysqli_num_rows($result_query);
        if($num_rows<1){
            echo "<div class='bg-light'>
        <h3 class='text-center mt-3 mx-auto font1' style='color: gray; font-size:15px;'>Sorry, Stock are not available in this brand...</h3>
        <p class='text-center mx-auto font1'><a  href='index.php'>Go back</a></p>
    
      </div>";
        }
    
      echo "<div class='container mt-4 mb-4'>
        <div class='row '>
          <div class='col-md-10' style='margin-right:7.5rem !important; margin-left:-15px;'>
          <!-- product -->
            <div class='row justify-content-center m-auto' style='row-gap: 7px !important; column-gap:3rem !important;'>
            <!-- fetch product -->";
            while($row=mysqli_fetch_assoc($result_query)){
              $product_id=$row['product_id'];
              $product_title=$row['product_title'];
              $product_desc=$row['product_desc'];
              $product_image1=$row['product_image1'];
              $product_price=$row['product_price'];
              $category_id=$row['category_id'];
              $brand_title=$row['brand_title'];
              $product_stock=$row['product_stock'];
              if($product_stock==0){
                echo "<style>
                .overlay-text {
                position: absolute;
                top: 40%; 
                left: 50%; 
                transform: translate(-50%, -50%); 
                background-color: gray; 
                opacity: 70%;
                color: #fff; 
                padding: 10px 20px; 
                font-size: 20px; 
                text-align: center;
                border-radius:50%
                </style>
                
                <div class='col-md-2 m-auto' >
                
                <div class='card' style='width: 240px !important; height:378px !important;'>
                  <img style='opacity:0.8' src='./admin/product_img/$product_image1' class='card-img-top' alt='...' >
                  
                  <div class='card-body'>
                    <h5 class='card-title font1'>$brand_title</h5>
                      <p class='card-text font1'>$product_title</p>
                      <p class='card-text font1'><b>Rp. $product_price</b></p>
                  </div>
                  <div class='overlay-text'>Product not Available</div>
                </div>
              </div>";
              }
              else{
              echo "<div class='col-md-2 m-auto' >
                <div class='card' style='width: 240px !important; height:378px !important;'>
                  <a href='product_detail.php?product_id=$product_id'><img src='./admin/product_img/$product_image1' class='card-img-top' alt='...' ></a>
                  <div class='card-body'>
                    <h5 class='card-title font1'><a class=navbar-brand href='product_detail.php?product_id=$product_id'>$brand_title</a></h5>
                      <p class='card-text font1'><a href='product_detail.php?product_id=$product_id'>$product_title</a></p>
                      <p class='card-text font1'><b>Rp. $product_price</b></p>
                  </div>
                </div>
              </div>";
            }
                }
        echo "        </div>
          </div>
        </div>
      </div>";
        }
        }

        function search_product(){
            global $con;
            if(isset($_GET['search_data_product'])){
            $search_data_value=$_GET['search_data'];
            $search_query="Select * from `products` where product_keyword like '%$search_data_value%'";
            $result_query=mysqli_query($con,$search_query);
            $status_test=mysqli_fetch_array($result_query);
            $status = $status_test['status'];
            echo "<div class='bg-light'>
        <h3 class='text-center mt-3 mx-auto font1'>Search result</h3>
      </div>";
            if ($status=='false'){
              echo "<div class='bg-light'>
            <h3 class='text-center mt-3 mx-auto font1' style='color: gray; font-size:15px;'>Sorry, Stock are not available or keywords does not found...</h3>
            <p class='text-center mx-auto font1'><a  href='index.php'>Go back</a></p>
          </div>";
            }
            else{
            echo "<div class='container mt-4 mb-4'>
                    <div class='row '>
                        <div class='col-md-10' style='margin-right:7.5rem !important; margin-left:-15px;'>
                    <!-- product -->
                    <div class='row justify-content-center m-auto' style='row-gap: 7px !important; column-gap:3rem !important;'>
                    <!-- fetch product -->";
                    while($row=mysqli_fetch_assoc($result_query)){
                      $product_id=$row['product_id'];
                      $product_title=$row['product_title'];
                      $product_desc=$row['product_desc'];
                      $product_image1=$row['product_image1'];
                      $product_price=$row['product_price'];
                      $category_id=$row['category_id'];
                      $brand_title=$row['brand_title'];
                      $product_stock=$row['product_stock'];
                      if($product_stock==0){
                        echo "<style>
                        .overlay-text {
                        position: absolute;
                        top: 40%; 
                        left: 50%; 
                        transform: translate(-50%, -50%); 
                        background-color: gray; 
                        opacity: 70%;
                        color: #fff; 
                        padding: 10px 20px; 
                        font-size: 20px; 
                        text-align: center;
                        border-radius:50%
                        </style>
                        
                        <div class='col-md-2 m-auto' >
                        
                        <div class='card' style='width: 240px !important; height:378px !important;'>
                          <img style='opacity:0.8' src='./admin/product_img/$product_image1' class='card-img-top' alt='...' >
                          
                          <div class='card-body'>
                            <h5 class='card-title font1'>$brand_title</h5>
                              <p class='card-text font1'>$product_title</p>
                              <p class='card-text font1'><b>Rp. $product_price</b></p>
                          </div>
                          <div class='overlay-text'>Product not Available</div>
                        </div>
                      </div>";
                      }
                      else{
                      echo "<div class='col-md-2 m-auto' >
                        <div class='card' style='width: 240px !important; height:378px !important;'>
                          <a href='product_detail.php?product_id=$product_id'><img src='./admin/product_img/$product_image1' class='card-img-top' alt='...' ></a>
                          <div class='card-body'>
                            <h5 class='card-title font1'><a class=navbar-brand href='product_detail.php?product_id=$product_id'>$brand_title</a></h5>
                              <p class='card-text font1'><a href='product_detail.php?product_id=$product_id'>$product_title</a></p>
                              <p class='card-text font1'><b>Rp. $product_price</b></p>
                          </div>
                        </div>
                      </div>";
                    }
                        }
                echo "</div>
                </div>
              </div>
            </div>";
                      }
        }}

        function getproducts1(){
          global $con;
          // condition isset || !isset
          if(!isset($_GET['category'])){
              if(!isset($_GET['brand'])){
          $select_query="Select * from `products` where status='true' order by rand() LIMIT 4";
          $result_query=mysqli_query($con,$select_query);
          echo "<div class='bg-white mt-5'>
          <h3 class='text-center mt-0 mx-auto font1 p-3'>YOU MIGHT ALSO LIKE</h3>
        </div>";
        echo "  <div class='container mt-4 mb-4'>
          <div class='row '>
            <div class='col-md-10' style='margin-right:7.5rem !important; margin-left:-15px;'>
            <!-- product -->
              <div class='row justify-content-center m-auto' style='row-gap: 7px !important; column-gap:3rem !important;'>
              <!-- fetch product -->";
              while($row=mysqli_fetch_assoc($result_query)){
                $product_id=$row['product_id'];
                $product_title=$row['product_title'];
                $product_desc=$row['product_desc'];
                $product_image1=$row['product_image1'];
                $product_price=$row['product_price'];
                $category_id=$row['category_id'];
                $brand_title=$row['brand_title'];
                $product_stock=$row['product_stock'];
                if($product_stock==0){
                  echo "<style>
                  .overlay-text {
                  position: absolute;
                  top: 40%; 
                  left: 50%; 
                  transform: translate(-50%, -50%); 
                  background-color: gray; 
                  opacity: 70%;
                  color: #fff; 
                  padding: 10px 20px; 
                  font-size: 20px; 
                  text-align: center;
                  border-radius:50%
                  </style>
                  
                  <div class='col-md-2 m-auto' >
                  
                  <div class='card' style='width: 240px !important; height:378px !important;'>
                    <img style='opacity:0.8' src='./admin/product_img/$product_image1' class='card-img-top' alt='...' >
                    
                    <div class='card-body'>
                      <h5 class='card-title font1'>$brand_title</h5>
                        <p class='card-text font1'>$product_title</p>
                        <p class='card-text font1'><b>Rp. $product_price</b></p>
                    </div>
                    <div class='overlay-text'>Product not Available</div>
                  </div>
                </div>";
                }
                else{
                echo "<div class='col-md-2 m-auto' >
                  <div class='card' style='width: 240px !important; height:378px !important;'>
                    <a href='product_detail.php?product_id=$product_id'><img src='./admin/product_img/$product_image1' class='card-img-top' alt='...' ></a>
                    <div class='card-body'>
                      <h5 class='card-title font1'><a class=navbar-brand href='product_detail.php?product_id=$product_id'>$brand_title</a></h5>
                        <p class='card-text font1'><a href='product_detail.php?product_id=$product_id'>$product_title</a></p>
                        <p class='card-text font1'><b>Rp. $product_price</b></p>
                    </div>
                  </div>
                </div>";
              }
                  }
          echo "        </div>
            </div>
          </div>
        </div>";
          }
          }
      }

      function getIPAddress() {  
          //whether ip is from the share internet  
          if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                      $ip = $_SERVER['HTTP_CLIENT_IP'];  
              }  
          //whether ip is from the proxy  
          elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
          }  
      //whether ip is from the remote address  
          else{  
                  $ip = $_SERVER['REMOTE_ADDR'];  
          }  
          return $ip;  
      }  
      // $ip = getIPAddress();  
      // echo 'User Real IP Address - '.$ip; 

      function cart(){
        if(isset($_GET['add_to_cart'])){
          global $con;
          $get_ip_add = getIPAddress(); 
          $get_product_id=$_GET['add_to_cart'];
          $select_query="Select * from `cart_details` where ip_address='$get_ip_add' and product_id=$get_product_id";
          $result_query=mysqli_query($con,$select_query);
          $num_rows=mysqli_num_rows($result_query);
          if ($num_rows>0){
            echo "<script>alert('This item already added to the cart!')</script>";
            echo "<script>window.open('index.php','_self')</script>";
          }
          else{
            $insert_query="insert into `cart_details` (product_id,ip_address,quantity) values ($get_product_id,'$get_ip_add',1)";
            $result_query=mysqli_query($con,$insert_query);
            
            echo "<script>alert('Item added to cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
                      }
        }
        elseif(isset($_GET['buy-now'])){
          global $con;
          $get_ip_add = getIPAddress(); 
          $get_product_id=$_GET['buy-now'];
          $select_query="Select * from `cart_details` where ip_address='$get_ip_add' and product_id=$get_product_id";
          $result_query=mysqli_query($con,$select_query);
          $num_rows=mysqli_num_rows($result_query);
          if ($num_rows>0){
            echo "<script>alert('This item already added to the cart!')</script>";
            echo "<script>window.open('cart.php','_self')</script>";
          }
          else{
            $insert_query="insert into `cart_details` (product_id,ip_address,quantity) values ($get_product_id,'$get_ip_add',1)";
            $result_query=mysqli_query($con,$insert_query);
            
            echo "<script>alert('Item added to cart')</script>";
            echo "<script>window.open('cart.php','_self')</script>";
                      }
        }

      }
      function cart_item(){
        if(isset($_GET['add_to_cart'])){
          global $con;
          $get_ip_add = getIPAddress(); 
          $select_query="Select * from `cart_details` where ip_address='$get_ip_add'";
          $result_query=mysqli_query($con,$select_query);
          $count_cart_items=mysqli_num_rows($result_query);
        }else{
          global $con;
          $get_ip_add = getIPAddress(); 
          $select_query="Select * from `cart_details` where ip_address='$get_ip_add'";
          $result_query=mysqli_query($con,$select_query);
          $count_cart_items=mysqli_num_rows($result_query);}
          echo $count_cart_items;
        }

        

        

        function total_cart_price(){
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
              $product_price=array($row_product_price['product_price']);
              $product_values=array_sum($product_price);
              $total_price+=$product_values;
            }
          }
          echo $total_price;
        }

        
        




      
?>