<?php 
session_start();
session_unset();
echo "<script>window.open('admin_login.php','_self')</script>";
?>