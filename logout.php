<?php 
session_start();
session_unset();
echo "<script>window.open('index.php','_self')</script>";
?>