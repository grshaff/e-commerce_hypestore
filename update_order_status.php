<?php
include '/includes/connection.php';

// Mengambil data JSON dari input
$data = json_decode(file_get_contents('php://input'), true);

// Logging data yang diterima untuk debugging
error_log(print_r($data, true));

if (isset($data['order_id']) && isset($data['status'])) {
    $order_id = $data['order_id'];
    $status = $data['status'];

    $query = "UPDATE user_orders SET status='$status' WHERE order_id='$order_id'";
    
    // Logging query untuk debugging
    error_log($query);

    if (mysqli_query($con, $query)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => mysqli_error($con)]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid parameters"]);
}
?>
