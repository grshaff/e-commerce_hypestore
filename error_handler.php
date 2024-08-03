<?php
// Mengatur custom error handler
set_error_handler("customErrorHandler");

// Fungsi custom error handler
function customErrorHandler($errno, $errstr, $errfile, $errline) {
    // Menangani error
    if (!(error_reporting() & $errno)) {
        return;
    }

    // Redirect ke halaman 404
    http_response_code(404);
    echo "<script>window.open('404.php','_self')</script>";
    exit();
}

// Mengaktifkan error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
