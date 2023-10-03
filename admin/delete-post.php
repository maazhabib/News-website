<?php 

include "config.php";
$post_id= $_GET['id'];
$cat_id = $_GET['cid'];

$Dlt_query = "DELETE FROM `post` WHERE post_id = {$post_id};";
$Dlt_query .= "UPDATE category SET post = post -1 WHERE category_id = {$cat_id}";
$Dlt_result = mysqli_multi_query($conn , $Dlt_query);

if($Dlt_result){
    header("location: post.php");
}

?>