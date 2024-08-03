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
    <title>Admin - order list</title>
</head>
<body>
<div class="container-fluid p-0 mt-0">
        <div class="row">
            <div class="col-sm mt-4" style="text-align:center;">
                <h2 class="font1">Orders</h2>
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
                                <th>SI No.</th>
                                <th >Order ID</th>
                                <th>Invoice number</th>
                                <th width="15%">Total products</th>
                                <th >Status</th>
                                <th width="12%">Order date</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $get_products="Select * from `user_orders`";
                            $result=mysqli_query($con,$get_products);
                            while($row_result=mysqli_fetch_assoc($result)){
                                $order_id=$row_result['order_id'];
                                $user_id=$row_result['user_id'];
                                $order_date=$row_result['order_date'];
                                $invoice_number=$row_result['invoice_number'];
                                $status=$row_result['status'];
                                $total_products=$row_result['total_products'];
                                $get_count="Select * from `orders_pending` where product_id=$product_id";
                                $result_count=mysqli_query($con,$get_count);
                                $rows_count=mysqli_num_rows($result_count);
                                $number++;
                                echo "  <tr> 
                                        <td>$number</td>
                                        <td>$order_id</td>
                                        <td>$invoice_number</td>
                                        <td >$total_products</td>
                                        <td>$order_date</td>
                                        <td>$status</td>
                                        <td><a data-title='Delete?' href='index.php?delete_product=".$product_id."' class='text-dark twitter'><i class='fa-solid fa-trash'></i></a>
                                        </td>
                                        </tr> ";
                            }

                            ?>
                            
                            

                            
                        </tbody>
                    </table>
                </div>
             
                

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
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