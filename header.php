<?php 
include "config.php";
$page = basename($_SERVER['PHP_SELF']);

switch ($page) {
    case "single.php":
        if (isset($_GET['cid'])) {
            $sql_title = "SELECT * FROM post WHERE post_id = {$_GET['cid']}";
            $result2 = mysqli_query($conn, $sql_title);
            $row_title = mysqli_fetch_assoc($result2);
            $title = $row_title['title'];
        }else {
            $title = "Not Post Found!"; 
        }
        break;
    case "category.php":
        $title = "Category Page";
        break;
    case "author.php":
        $title = "Author Page";
        break;
    case "search.php":
        $title = "Search Page";
        break;
    default:
        $title = "News Site";
        break;    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title;?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="images/news.jpg"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php 
                if(isset($_GET['cid'])){
                    $cat_id = $_GET['cid'];
                }

                $sql = "SELECT * FROM category WHERE post > 0 ";
                $result = mysqli_query($conn , $sql);

                if(mysqli_num_rows($result) > 0){
                  
                ?>
                <ul class='menu'>
                    
                    <li><a  href='index.php'>HOME</a></li>"; 
                    <?php 
                    while($row = mysqli_fetch_assoc($result)){

                        $active = "";

                        if(isset($_GET['cid'])){
                            if($row['category_id'] == $cat_id){
                                $active = "active";
                            }else{ 
                                $active = "";

                            }
                        }

                        echo"  <li><a class='{$active}' href='category.php?cid={$row['category_id']}'>{$row['category_name']}</a></li>"; 

                    }?>
                </ul>
                <?php 
                    
                }else{
                    echo "Data Not Found";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
