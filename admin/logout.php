<?php 
include "config.php";
session_start();

session_unset();

session_destroy();

// header("location : {hostname}/admin/index.php");
header("location:index.php");
// echo"<script>wimdow.location.herf='index.php'</script>";
?>
