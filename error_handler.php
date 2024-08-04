<?php
set_error_handler("customErrorHandler");

function customErrorHandler($errno, $errstr, $errfile, $errline) {
    if (!(error_reporting() & $errno)) {
        return;
    }
    http_response_code(404);
    echo "<script>window.open('404.php','_self')</script>";
    exit();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
