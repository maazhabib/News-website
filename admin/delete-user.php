<?php 
if($_SESSION['user_role'] == 0){
    header("location: post.php");
   }
include "config.php";
$id= $_GET['id'];

$Dlt_query = "DELETE FROM `category` WHERE category_id = $id";
$Dlt_result = mysqli_query($conn , $Dlt_query);

if($Dlt_result){
    header("location: users.php");
}

?>  